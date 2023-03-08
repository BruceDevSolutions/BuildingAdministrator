<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('administrar_anuncios', function($user){
            return $user->user_type === '1';
        });

        Gate::define('administrar_usuarios', function($user){
            return $user->user_type === '1';
        });

        Gate::define('administrar_ajustes', function($user){
            return $user->user_type === '1';
        });

        Gate::define('registrar_egreso', function($user){
            return $user->user_type === '1';
        });

        Gate::define('registrar_ingreso', function($user){
            return $user->user_type === '1';
        });

        Gate::define('eliminar_ingreso', function($user){
            return $user->user_type === '1';
        });

        Gate::define('eliminar_egreso', function($user){
            return $user->user_type === '1';
        });

        Gate::define('registrar_inmueble', function($user){
            return $user->user_type === '1';
        });

        Gate::define('editar_inmueble', function($user){
            return $user->user_type === '1';
        });

        Gate::define('eliminar_inmueble', function($user){
            return $user->user_type === '1';
        });

        Gate::define('crear_multa', function($user){
            return $user->user_type === '1';
        });

        Gate::define('eliminar_multa', function($user){
            return $user->user_type === '1';
        });

        Gate::define('cambiar_estado_multa', function($user){
            return $user->user_type === '1';
        });

        Gate::define('crear_cuota', function($user){
            return $user->user_type === '1';
        });

        Gate::define('eliminar_cuota', function($user){
            return $user->user_type === '1';
        });

    }
}
