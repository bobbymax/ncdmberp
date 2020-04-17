<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Application' => 'App\Policies\ApplicationPolicy',
        'App\Module' => 'App\Policies\ModulePolicy',
        'App\Page' => 'App\Policies\PagePolicy',
        'App\Training' => 'App\Policies\TrainingPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
