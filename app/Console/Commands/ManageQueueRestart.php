<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ManageQueueRestart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:QueueRestart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restart Queue';

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
        $jobs = DB::table('jobs')->select('id')->get();
        if(count($jobs) < 1){
            Artisan::call('queue:restart');
        }
    }
}
