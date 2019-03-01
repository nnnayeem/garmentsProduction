<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CountHourlyProduction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $now,$lastHour;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->now = now('Asia/Dhaka');
        $this->lastHour = new Carbon('last hour', 'Asia/Dhaka');
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
