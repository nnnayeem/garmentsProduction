<?php

namespace App\Http\Controllers\Admin;

use App\Events\ProcessProductionPlatform;
use App\Events\SwitchPressed;
use App\Machine;
use App\MController;
use App\Platform;
use App\ProductionPlatform;
use App\Services\DevicePlatform;
use App\Switche;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Json;

class PlatformController extends Controller
{
    public function getRequest($floor, $switch, $status)
    {
        $data = Machine::all()->where('floor_id', $floor)->where('switch', $switch)->first();
        if (count($data) > 0) {
            $data->update(['status' => $status, 'checked' => 0]);
            event(new SwitchPressed($floor, $switch, $status));
        }
        return;

    }


    public function callMechanic(Request $request)
    {
        /*
         * Data Structure
         * device_ip:switch_status>device_switch_no
         * Example:
         * data:
         *[
         *      "device_ip:switch_status>device_switch_no",
         *      "device_ip:switch_status>device_switch_no",
         *      "device_ip:switch_status>device_switch_no",
         *      ..........................................
         * ]
        */


        $input = $request->all();

        $data = $input['data'];


        try{
            foreach ($data as $factoryControllerData) {
                $factoryControllerData = explode('>', $factoryControllerData);

                $extractedData = DevicePlatform::ExtractDataFromControllerIncomingData($factoryControllerData);
                if(!empty($extractedData) && !$extractedData['is_production_switch']){
                    $this->callingMechanic($extractedData['floor'], $extractedData['originalSwitchNo'], $extractedData['status']);
                }elseif(!empty($extractedData) && $extractedData['is_production_switch']){
                    $this->countProduction($extractedData);
                }

            }
            return [
                "status" => 202
            ];
        }catch (\Exception $e){
            return [
                "status" => 200,
                "meta" => [
                    'errorMessage' => config('app.env') == 'local'?$e->getMessage():"Unknown Error Occurred"
                ]
            ];
        }

    }


    public function callingMechanic($floor, $switch, $status)
    {
        $data = Switche::where('floor_id', $floor->id)->where('switch', $switch)->first();

        if (!empty($data)) {
            $switchStatus = $data->status;

        /*
            original status 1:
	            switch status 1: indicating something wrong		>call mechanic
	            switch status 0: indicating machine status fine	>no action needed

            original status 0:
	            switch status 1: indicating something wrong		>no action needed
	            switch status 0: indicating machine repaired	>call mechanic
        */

            switch($switchStatus){
                case 1:
                    if($status == 1){
                        Platform::create(['floor' => $floor->floor, 'switch' => $switch]);
                    }
                    break;

                default:
                    if($status == 0){
                        $plaPlatform = Platform::where('floor', $floor->floor)->where('switch', $switch)->orderBy('created_at', 'desc')->first();
                        if ($plaPlatform) {
                            $plaPlatform->update(['end_time' => now()]);
                        }
                    }
            }


            //Toggle the status of the switch
            $data->update(['status' => !$status, 'checked' => 0]);
            event(new SwitchPressed($floor->floor, $switch, !$status));

            return [
                'status' => 202
            ];

        }

        return [
            'status' => 200
        ];
    }

    public function countProduction($extractedData)
    {

        event(new ProcessProductionPlatform($extractedData));
    }

}
