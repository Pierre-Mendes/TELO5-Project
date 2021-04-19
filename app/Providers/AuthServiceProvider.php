<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        

        Gate::define('admin', function ($user) {
            return $user->tipo_usuario == 0;
        });

        Gate::define('gerente', function ($user) {
            return $user->tipo_usuario == 1;
        });

        Gate::define('supervisor', function ($user) {
            return $user->tipo_usuario == 2;
        });
        
        Gate::define('consultor', function ($user) {
            return $user->tipo_usuario == 3;
        });

        Gate::define('assistente', function ($user) {
            return $user->tipo_usuario == 4;
        });

    }
}
