<?php

namespace App\Handlers\Events;

use App\Events\CountProduction;
use App\Order;
use App\Target;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CountProductionHandle
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
     * @param  CountProduction  $event
     * @return void
     */
    public function handle(CountProduction $event)
    {
        $type = $event->type;
        $floor = $event->floor;
        $line = $event->line;
        $target = Target::whereDate('day',$event->day)->where('floor_id',$event->floor)->where('line',$event->line);
        $tgt = $target->first();
        if(!empty($tgt)){
            if($type == 'g')
            {
                $target->increment('green');
                $order = $tgt->order;
                $production = $order->production;
                $orderId = $order->id;
                $order_u = Order::find($orderId);
                if(!empty($order_u)){
                    $order_u->update(['production'=>$production+1]);
                }
            }
            elseif($type == 'y')
                $target->increment('yellow');
            elseif($type == 'r')
                $target->increment('red');
            $tgt->details()->create(['type'=>$type,'floor_id'=>$floor,'line'=>$line]);
        }

    }
}
