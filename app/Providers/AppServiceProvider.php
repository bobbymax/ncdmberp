<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.aside', function($view) {
            $view->with('modules', \App\Module::where('active', 1)->latest()->get());
        });

        view()->composer('partials.aside', function($view) {
            $view->with('resources', \App\ApiResource::where('published', 1)->latest()->get());
        });

        view()->composer('partials.top-navigation', function($view) {
            $view->with('applications', \App\Application::where('active', 1)->latest()->get());
        });

        view()->composer('pages.index', function($view) {
            $view->with('nominations', \App\Nomination::where('state', 'approved')->latest()->get());
        });
    }
}
