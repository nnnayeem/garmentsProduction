<?php

namespace App\Http\Controllers;

use App\Events\CountHourlyProduction;
use App\Events\CountProduction;
use App\Target;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index($floor,$line){
        $target = Target::with(['order','order.buyer','targetHourlyDetails'])
            ->whereDate('day',date('Y-m-d'))
            ->where('floor_id',$floor)
            ->where('line',$line)->first();
        if(!empty($target))
            return view('production',compact('target'));
        return abort(404);

    }

    public function count(Request $request,$floor,$line){
        $type = $request->type;
        $day = date('Y-m-d');
        event(new CountProduction('RealTime',$floor,$line,$day,$type));
        return 201;
    }
    public function countget($floor,$line,$type){
        $day = date('Y-m-d');
        event(new CountProduction('RealTime',$floor,$line,$day,$type));
        return 201;
    }
    public function countpost(Request $request){
        $day = date('Y-m-d');
        $floor = $request->floor;
        $line = $request->line;
        $type = $request->type;
        if(!is_null($floor) && !is_null($line) && !is_null($type))
        {
            event(new CountProduction('RealTime',$floor,$line,$day,$type));
            return 201;
        }else{
            return 200;
        }

    }

    public function countHourly(){
        event(new CountHourlyProduction());
        return;
    }
    public function countHourlyPost(){
        event(new CountHourlyProduction());
        return;
    }
}

