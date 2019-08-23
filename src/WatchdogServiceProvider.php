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
        $this->publishes([realpath(__DIR__.'/../config/watchdog.php') => config_path('watchdog.php')]);
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/watchdog.php'), 'watchdog');
    }
}
