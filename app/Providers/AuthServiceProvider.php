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

        $this->registerPolicies();

        Gate::define('admin', function () {
            return Auth::user()->role === User::ADMIN;
         });
        Gate::define('no-role', function () {
            return Auth::user()->role === null;
         });


         Gate::define('staff', function ($user) {
            return $user->role === User::STAFF && $user->staff()->exists();
        });
         Gate::define('personnel', function ($user) {
            return $user->role === User::PERSONNEL && $user->personnel()->exists();
        });
         Gate::define('student', function ($user) {
            return $user->role === User::STUDENT && $user->student()->exists();
        });
        Gate::define('student-no-account', function ($user) {
            return $user->role === User::STUDENT && $user->student()->doesntExist();
        });
        Gate::define('personnel-no-account', function ($user) {
            return $user->role === User::PERSONNEL && $user->personnel()->doesntExist();
        });




         Gate::define('admin-and-staff', function () {
            $user = Auth::user();
            return $user && $user->hasRoleOf([User::ADMIN, User::STAFF]);
        });

        Gate::define('student-and-personnel', function ($user) {
            return ($user->role === User::STUDENT && $user->student()->exists()) ||
                   ($user->role === User::PERSONNEL && $user->personnel()->exists());
        });





        //
    }
}
