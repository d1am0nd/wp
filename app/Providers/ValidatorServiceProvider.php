<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('youtube', function ($attribute, $value, $parameters)
        {
            $rx = '~
                ^(?:https?://)?              # Optional protocol
                 (?:www\.)?                  # Optional subdomain
                 (?:youtube\.com|youtu\.be)  # Mandatory domain name' .
                 // /watch\?v=([^&]+)           # URI with video id as capture group 1
                 '~x';
            $has_match = preg_match($rx, $value, $matches);
            return $has_match;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
