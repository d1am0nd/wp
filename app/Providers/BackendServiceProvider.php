<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\CardRepositoryInterface', 'App\Repositories\CardRepository');
        $this->app->bind('App\Repositories\CardAttributeRepositoryInterface', 'App\Repositories\CardAttributeRepository');
    }
}
