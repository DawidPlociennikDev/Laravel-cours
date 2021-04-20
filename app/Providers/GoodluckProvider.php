<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoodluckProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Goodluck::class, function($app) {
            return new \App\Goodluck(3);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
