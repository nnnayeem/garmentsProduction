<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\ManageQueue;

class ManageQueueRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check to start queue worker';

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
        event(new ManageQueue());
    }
}
