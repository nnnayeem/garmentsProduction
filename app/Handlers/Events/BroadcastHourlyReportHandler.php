<?php

namespace App\Handlers\Events;

use App\Events\BroadcastHourlyReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastHourlyReportHandler
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
     * @param  BroadcastHourlyReport  $event
     * @return void
     */
    public function handle(BroadcastHourlyReport $event)
    {
        //
    }
}
