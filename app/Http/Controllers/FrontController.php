<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Machine;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $floors = Floor::all();
        return view('floor',compact('floors'));
    }
    public function machineStatus(Request $request)
    {
        $room = $request->room;
        $data = Machine::select('switch','status')->where('floor_id',$room)->where('checked',0)->get();
        if(count($data) > 0){
            $machine_data = $data->first();
            $machine = $machine_data->switch;
            $status = $machine_data->status;
        }else{
            $machine = 0;
            $status = null;
        }
        return response()->json(['switch'=>$machine,'status'=>$status]);
    }

    public function checked(Request $request)
    {
        $floor = $request->floor;
        $switch = $request->s;
        $data = Machine::all()->where('floor_id',$floor)->where('switch',$switch)->take(1)->first();
        if(count($data) > 0){
            $data->update(['checked'=>1]);
        }

    }


    public function test($floor,$switch)
    {

        $data = Machine::all()->where('floor_id',$floor)->where('switch',$switch)->take(1)->first();
        if(count($data) > 0){
            $data->update(['checked'=>1]);
        }else{
            abort(500);
        }

    }
}
