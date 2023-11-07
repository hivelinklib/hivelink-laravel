<?php

namespace Hivelink\Laravel;

class ServiceProviderLaravel4 extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('hivelink/laravel', null, __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	$this->app['hivelink'] = $this->app->share(function ($app) {
            return new \Hivelink\HivelinkApi($app['config']->get('hivelink::apikey'));
        });
    }
}
