<?php

namespace App\Http\Controllers\Admin;

use App\Events\SwitchPressed;
use App\Machine;
use App\Platform;
use App\Switche;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function postRequest(Request $request)
    {
        /*$data = json_decode(array_first($request->all()),true);
        $floor  =$data['floor'];
        $switch =$data['switch'];
        $status =$data['status'];
        $data = Machine::all()->where('floor_id',$floor)->where('switch',$switch)->first();
        if(count($data) > 0)
        {
            $data->update(['status'=>$status,'checked'=>0]);
            event(new SwitchPressed($floor,$switch,$status));
        }*/
        return;

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
