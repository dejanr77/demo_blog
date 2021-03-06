<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(
            'App\Repositories\Articles\ArticleRepositoryInterface',
            'App\Repositories\Articles\ArticleRepository'
        );

        $this->app->bind(
            'App\Repositories\Tags\TagRepositoryInterface',
            'App\Repositories\Tags\TagRepository'
        );

        $this->app->bind(
            'App\Repositories\Profiles\ProfileRepositoryInterface',
            'App\Repositories\Profiles\ProfileRepository'
        );

        $this->app->bind(
            'App\Repositories\Comments\CommentRepositoryInterface',
            'App\Repositories\Comments\CommentRepository'
        );
    }
}
