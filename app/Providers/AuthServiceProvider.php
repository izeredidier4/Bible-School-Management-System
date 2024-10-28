<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
{
    $this->registerPolicies();

    Gate::define('view-classes', function ($user) {
        return true; // All users are allowed to view classes
    });

    Gate::define('add-class', function ($user) {
        return in_array($user->role, ['Admin', 'Teacher']);
    });

    Gate::define('edit-class', function ($user) {
        return in_array($user->role, ['Admin', 'Teacher']);
    });

    Gate::define('delete-class', function ($user) {
        return in_array($user->role, ['Admin', 'Teacher']);
    });
}
}
