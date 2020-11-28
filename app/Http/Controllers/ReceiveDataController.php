<?php

namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;

class ReceiveDataController extends Controller
{
    public function getRequest($room,$switch_id)
    {
        $input = [];
        $room_no = (int)$room;
        $switch = (int)$switch_id;
        $input = ['switch'=>$switch,'room'=>$room_no];
        Platform::create($input);
        return;

    }

    public function postRequest(Request $request)
    {
//        dd(json_decode(array_first($request->all()),true));
        $input = $request->all();

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
                    if(!is_integer($switch)){
                        $switch = '2';
                    }
                    Platform::create(['room' => $floor, 'switch' => $switch]);
                }
            }

        }
        return;

    }
}
