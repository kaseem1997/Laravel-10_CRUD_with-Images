<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class showDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'showDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show my Current Database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info(DB::connection()->getDatabaseName());
    }
}
