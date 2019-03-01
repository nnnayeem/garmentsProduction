<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ManageQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
         
//        $schedule->command('report:hourly')->hourly();
        $jobs = DB::table('jobs')->select('id')->get();
        if(count($jobs) > 0){
             Artisan::call('queue:work',['--tries'=>3,'--stop-when-empty'=>true]);
        }
        /*else{
            Artisan::call('queue:restart');
        }*/
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
