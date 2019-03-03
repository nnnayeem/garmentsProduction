<?php

namespace App\Handlers\Events;

use App\Events\BroadcastHourlyReport;
use App\Events\CountHourlyProduction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Floor;
use App\Target;
use App\TargetDetails;
use App\TargetHourlyDetail;
use Carbon\Carbon;

// class CountHourlyProductionHandler
class CountHourlyProductionHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CountHourlyProduction  $event
     * @return void
     */
    public function handle(CountHourlyProduction $event)
    {
        $now = $event->now;
        $last = $event->lastHour->format('H');
        $current = $now->format('H');

        $lastTime = Carbon::createFromTime($last, 0, 0)->format('H:m:s');
        $currentTime = Carbon::createFromTime($current, 0, 0, 'Asia/Dhaka')->format('H:m:s');

        $floors = Floor::with(['targets'=>function($query) use($now){
            $query->whereDate('created_at',$now->format('Y-m-d'));
        }])->get();


        foreach ($floors as $floor){
            $this->processTargets($floor->targets,$current,$lastTime,$currentTime);
        }

    }


    protected function processTargets($targets,$current,$lastTime,$currentTime){
        if(count($targets) > 0){
            foreach ($targets as $target){
                $floor = $target->floor_id;
                $line = $target->line;
                if($current != '00'){
                    $td = TargetDetails::where('target_id',$target->id)
                        ->whereTime('created_at','>=',$lastTime)
                        ->whereTime('created_at','<',$currentTime)->get();
                }else{
                    $td = TargetDetails::where('target_id',$target->id)
                        ->whereTime('created_at','>=',$lastTime)
                        ->get();
                }

                $red = 0;
                $yellow = 0;
                $green = 0;

                if(count($td)>0){

                    foreach ($td as $details){
                        if($details['type'] == "g"){
                            $green++;
                        }elseif ($details['type'] == "r")
                            $red++;
                        elseif ($details['type'] == "y")
                            $yellow++;
                    }
                }
                if($green >0 || $yellow>0 || $red >0 ){
                    $target->targetHourlyDetails()->create(['red'=>$red,'yellow'=>$yellow,'green'=>$green,'start_time'=>$lastTime,'end_time'=>$currentTime]);
                    event(new BroadcastHourlyReport("Hourly",$floor,$line,$red,$yellow,$green,$lastTime,$currentTime));
                }
            }
        }
    }



}
