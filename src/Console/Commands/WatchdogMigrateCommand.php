<?php

namespace Luminee\Watchdog\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class WatchdogMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'watchdog:migrate';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate watchdog database';
    
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
        $this->call('migrate', ['--path' => __DIR__.'/../../Database/migrations']);
        $this->info('Watchdog Migrate Has Done! ^_^');
    }
    
}
