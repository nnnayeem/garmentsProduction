<?php

namespace App\Http\Controllers\Admin;

use App\Events\SwitchPressed;
use App\Machine;
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

//        dd($input);
        $data = $input['data'];

        foreach ($data as $factoryControllerData){
            $factoryControllerData = explode('>', $factoryControllerData);
            if(sizeof($factoryControllerData) == 2){
                $ip = $factoryControllerData[0];
                $message = $factoryControllerData[1];

                $ip = explode(':', $ip);

                if($ip[0] == '192.168.0.104'){
                    $floor = 1;
                    $switch = $message;
//                    dd(filter_var($switch, FILTER_VALIDATE_INT), $switch);
                    if(!filter_var($switch, FILTER_VALIDATE_INT)){
                        $switch = '2';
                    }
                    Platform::create(['floor' => $floor, 'switch' => $switch]);
                }
            }

        }
        return [
            "status" => 202
        ];

    }

    public function testPostRequest(Request $request){
        $datas = $request->all();
        Platform::create(['testing'=>serialize($datas['floor'])]);
        $floor  =$datas['floor'];
        $switch =$datas['switch'];
        $status =$datas['status'];
        $data = Switche::where('floor_id',$floor)->where('switch',$switch)->first();


        if($data)
        {
            if(!$data->status == 0)
            {
                if($status == 0)
                {
                    Platform::create(['floor'=>$floor,'switch'=>$switch]);
                }


            }elseif ($data->status == 0){
                if($status == 1){
                    $plaPlatform = Platform::where('floor',$floor)->where('switch',$switch)->orderBy('created_at','desc')->first();
                    if($plaPlatform){
                        $plaPlatform->update(['end_time'=>now()]);
                    }
                }

            }
            $data->update(['status'=>$status,'checked'=>0]);
            event(new SwitchPressed($floor,$switch,$status));

        }
        if(!empty($datas))
            return 201;
        return 200;
    }
    public function getRequest($floor,$switch,$status)
    {
        $data = Machine::all()->where('floor_id',$floor)->where('switch',$switch)->first();
        if(count($data) > 0)
        {
            $data->update(['status'=>$status,'checked'=>0]);
            event(new SwitchPressed($floor,$switch,$status));
        }
        return;

    }
    public function callMechanic($floor,$switch,$status)
    {
        return $this->callingMechanic($floor, $switch, $status);
    }

    public function callingMechanic($floor,$switch,$status)
    {
        $data = Switche::where('floor_id',$floor)->where('switch',$switch)->first();

        if($data)
        {
            if(!$data->status == 0)
            {
                if($status == 0)
                {
                    Platform::create(['floor'=>$floor,'switch'=>$switch]);
                }


            }elseif ($data->status == 0){
                if($status == 1){
                    $plaPlatform = Platform::where('floor',$floor)->where('switch',$switch)->orderBy('created_at','desc')->first();
                    if($plaPlatform){
                        $plaPlatform->update(['end_time'=>now()]);
                    }
                }

            }
            $data->update(['status'=>$status,'checked'=>0]);
            event(new SwitchPressed($floor,$switch,$status));

        }
        return;
    }

}
