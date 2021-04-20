<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BadluckProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Badluck::class, function($app) {
            $b1 = new \App\Badluck(2);
            $b1->setSecret("Ściśle tajne! Ktoś z kimś zrobił coś!\n");
            return $b1;
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
