<?php

namespace App\Http\Controllers\Admin;

use App\Events\SwitchPressed;
use App\Machine;
use App\MController;
use App\Platform;
use App\Switche;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Json;

class PlatformController extends Controller
{
    public function postRequest(Request $request)
    {
        $input = $request->all();

        $data = $input['data'];

        try{
            foreach ($data as $factoryControllerData) {
                $factoryControllerData = explode('>', $factoryControllerData);
                if (sizeof($factoryControllerData) == 2) {
                    $controllerData = $factoryControllerData[0];
                    $switchNo = $factoryControllerData[1];

                    $controllerData = explode(':', $controllerData);
                    $ip = $controllerData[0];
                    $status = $controllerData[1];

                    $controller = MController::with('floor')->where('ip', $ip)->first();
                    if (!empty($controller)) {
                        $rowNo = $controller->line_no;
                        $floor = $controller->floor;
                        if (!empty($floor)) {
                            $machinePerRow = $floor->machinePerRow;
                            $originalSwitchNo = (int)$machinePerRow * ((int)$rowNo - 1) + $switchNo;
                            $this->callingMechanic($floor, $originalSwitchNo, $status);
                        }
                    }


                }

            }
            return [
                "status" => 202
            ];
        }catch (\Exception $e){
            return [
                "status" => 200
            ];
        }

    }

    public function testPostRequest(Request $request)
    {
        $datas = $request->all();
        Platform::create(['testing' => serialize($datas['floor'])]);
        $floor = $datas['floor'];
        $switch = $datas['switch'];
        $status = $datas['status'];
        $data = Switche::where('floor_id', $floor)->where('switch', $switch)->first();


        if ($data) {
            if (!$data->status == 0) {
                if ($status == 0) {
                    Platform::create(['floor' => $floor, 'switch' => $switch]);
                }


            } elseif ($data->status == 0) {
                if ($status == 1) {
                    $plaPlatform = Platform::where('floor', $floor)->where('switch', $switch)->orderBy('created_at', 'desc')->first();
                    if ($plaPlatform) {
                        $plaPlatform->update(['end_time' => now()]);
                    }
                }

            }
            $data->update(['status' => $status, 'checked' => 0]);
            event(new SwitchPressed($floor, $switch, $status));

        }
        if (!empty($datas))
            return 201;
        return 200;
    }

    public function getRequest($floor, $switch, $status)
    {
        $data = Machine::all()->where('floor_id', $floor)->where('switch', $switch)->first();
        if (count($data) > 0) {
            $data->update(['status' => $status, 'checked' => 0]);
            event(new SwitchPressed($floor, $switch, $status));
        }
        return;

    }

    public function callMechanic($floor, $switch, $status)
    {
        $data = Switche::where('floor_id', $floor)->where('switch', $switch)->first();

        if ($data) {
            if (!$data->status == 0) {
                if ($status == 0) {
                    Platform::create(['floor' => $floor, 'switch' => $switch]);
                }


            } elseif ($data->status == 0) {
                if ($status == 1) {
                    $plaPlatform = Platform::where('floor', $floor)->where('switch', $switch)->orderBy('created_at', 'desc')->first();
                    if ($plaPlatform) {
                        $plaPlatform->update(['end_time' => now()]);
                    }
                }

            }
            $data->update(['status' => $status, 'checked' => 0]);
            event(new SwitchPressed($floor, $switch, $status));

        }
        return;
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


//            Toggle the status of the switch
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

}
