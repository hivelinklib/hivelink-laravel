<?php

namespace Hivelink\Laravel;

use Hivelink\HivelinkApi as HivelinkApi;

class ServiceProviderLaravel8 extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/config.php' => config_path('hivelink.php')]);
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'hivelink');
        $this->app->singleton('hivelink', function ($app) {
            return new HivelinkApi($app['config']->get('hivelink.apikey'));
        });
    }
}
