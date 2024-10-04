<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Role;

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
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-access',function($user){
            return $user->hasRole('admin');
        });      

        
        Gate::define('user-access',function($user){
            return $user->hasRole('user');
        });      

        Gate::define('owner-access', function ($user) {
            return $user->hasRole('owner');
        });


    }
}
