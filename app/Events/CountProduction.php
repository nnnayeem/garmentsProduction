<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CountProduction implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventType,$floor,$line,$day,$type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventType,$floor,$line,$day,$type)
    {
        $this->floor = $floor;
        $this->line = $line;
        $this->eventType = $eventType;
        $this->day = $day;
        $this->type = $type;
        $this->eventType = $eventType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['production-'.$this->floor.'-'.$this->line];
    }
}