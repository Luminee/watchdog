<?php

namespace Luminee\Watchdog;

use Illuminate\Support\ServiceProvider;

class WatchdogServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
//        $this->publishes([realpath(__DIR__.'/../config/escalator.php') => config_path('escalator.php')]);
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.watchdog.migrate', function () {
            return new \Luminee\Watchdog\Console\Commands\WatchdogMigrateCommand();
        });
    
        $this->commands('command.watchdog.migrate');
        
//        $this->mergeConfigFrom(realpath(__DIR__.'/../config/escalator.php'), 'escalator');
    }
}
