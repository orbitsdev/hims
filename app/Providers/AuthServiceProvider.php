<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {



        Gate::define('admin', function () {
            return Auth::user()->role === User::ADMIN;
         });
        Gate::define('staff', function () {
            return Auth::user()->role === User::STAFF;
         });
        Gate::define('personnel', function () {
            return Auth::user()->role === User::PERSONNEL;
         });

        Gate::define('student', function () {
            return Auth::user()->role === User::STUDENT;
         });
         
         Gate::define('admin-and-staff', function () {
            $user = Auth::user();
            return $user && $user->hasRoleOf([User::ADMIN, User::STAFF]);
        });





         $this->registerPolicies();
        //
    }
}
