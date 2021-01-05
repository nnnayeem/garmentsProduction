<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\CountProduction::class => [
            \App\Handlers\Events\CountProductionHandle::class,
        ],
        \App\Events\CountHourlyProduction::class => [
            \App\Handlers\Events\CountHourlyProductionHandler::class,
        ],
        \App\Events\BroadcastHourlyReport::class => [
            \App\Handlers\Events\BroadcastHourlyReportHandler::class,
        ],
        \App\Events\ProcessProductionPlatform::class => [
            \App\Handlers\Events\ProcessIncomingProductionDataForPlatform::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
