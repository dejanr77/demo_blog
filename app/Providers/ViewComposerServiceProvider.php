<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tag;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeArticleForm();
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

    /**
     * Compose a Form for Article.
     */
    private function composeArticleForm()
    {
        view()->composer('public.articles.partials.form','App\Http\Composers\ArticleFormComposer');

    }
}
