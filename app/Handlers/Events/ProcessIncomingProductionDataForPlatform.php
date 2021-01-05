<?php

namespace App\Handlers\Events;

use App\Services\DevicePlatform;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessIncomingProductionDataForPlatform implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        DevicePlatform::ProcessProductionPlatformData($event->extractedData);
    }
}
