<?php

namespace App\Http\Controllers;

use App\Events\CountHourlyProduction;
use App\Events\CountProduction;
use App\Events\ProcessProductionPlatform;
use App\Target;
use App\TargetHourlyDetail;
use App\Floor;
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
    public function countInspectedProducts(Request $request){
        $day = date('Y-m-d');
        $floor = $request->floor;
        $line = $request->line;
        $type = $request->type;

//        event(new ProcessProductionPlatform($request->all()));

        if(!is_null($floor) && !is_null($line) && !is_null($type))
        {
            event(new CountProduction('RealTime',$floor,$line,$day,$type));
            return 201;
        }else{
            return 200;
        }

    }

    public function show(){
        $production = TargetHourlyDetail::with(['target'=>function($q){
            $q->orderBy('day','desc');
        },
        'target.order',
        'target.order.buyer'
        ])->get();
        $floors = Floor::all();
        return view('admin.production.show',compact('production','floors'));
    }

    public function SortProduction(Request $request){
        $floor  = $request->floor;
        $line   = $request->line;
        $date   = $request->date;

        $data = [];
        for($i=0;$i<=23;$i++){
            $data[$i] = [];
            for ($j=1; $j <= 8; $j++) {
                $data[$i][$j] = [];
            }
        }
        // $target = Target::whereDate('day',$date)->where('floor_id',$floor)->where('line',$line)->first();
        $records = Target::with(['targetHourlyDetails'=>function($q){
            $q->orderBy('start_time','asc');
        },'floor'])->orderBy('line','asc')->whereDate('day',$date)->get();
        // dd($targets);
        foreach ($records as $targets) {
            $items = $targets->targetHourlyDetails;
            $line = $targets->line;
            if(!empty($items)){
                foreach ($items as $item) {
                $start = $item->start_time;
                $split = explode(':', $start);
                $time = array_first($split);
                $data[$time][$line] = $item;
                }
            }

        }
        return view('admin.production.showDetails',compact('data','floor','line','date'));

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

