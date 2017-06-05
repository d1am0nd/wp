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
        $this->app->bind('App\Repositories\TagRepositoryInterface', 'App\Repositories\TagRepository');
        $this->app->bind('App\Repositories\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\PageRepositoryInterface', 'App\Repositories\PageRepository');
        $this->app->bind('App\Repositories\CardRepositoryInterface', 'App\Repositories\Decorators\CardRepository');
        $this->app->bind('App\Repositories\VideoRepositoryInterface', 'App\Repositories\VideoRepository');
        $this->app->bind('App\Repositories\CommentRepositoryInterface', 'App\Repositories\CommentRepository');
        $this->app->bind('App\Repositories\PageTypeRepositoryInterface', 'App\Repositories\PageTypeRepository');
        $this->app->bind('App\Repositories\CardAttributeRepositoryInterface', 'App\Repositories\CardAttributeRepository');
    }
}
