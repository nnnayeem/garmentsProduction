<?php

namespace App\Events;

use App\Services\DevicePlatform;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProcessProductionPlatform implements shouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $extractedData;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($extractedData)
    {
        $this->extractedData = $extractedData;


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
