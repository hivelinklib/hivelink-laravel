<?php

namespace Hivelink\Laravel;

use Hivelink\HivelinkApi as HivelinkApi;
use Illuminate\Support\Facades\Notification;
use Hivelink\Laravel\Channel\HivelinkChannel;

class ServiceProviderLaravel11 extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/config.php' => config_path('hivelink.php')],'config');
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
        Notification::resolved(function ($service) {
            $service->extend('hivelink', function ($app) {
                return new HivelinkChannel($app->make('hivelink'));
            });
        });
    }
}
