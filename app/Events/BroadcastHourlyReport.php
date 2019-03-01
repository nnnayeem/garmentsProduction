<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastHourlyReport implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventType, $floor,$line,$red,$yellow,$start_time,$end_time,$green;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventType,$floor,$line,$red,$yellow,$green,$start_time,$end_time)
    {
        $this->floor = $floor;
        $this->line = $line;
        $this->red = $red;
        $this->yellow = $yellow;
        $this->green = $green;
        $this->eventType = $eventType;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
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
