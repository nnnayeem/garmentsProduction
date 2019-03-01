<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CountHourlyProduction;

class HourlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:HourlyReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger Count Hourly Production Event';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new CountHourlyProduction());
    }
}
