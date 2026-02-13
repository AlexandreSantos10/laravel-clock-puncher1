<?php

namespace App\Providers;

// AS IMPORTAÇÕES TÊM DE ESTAR AQUI (FORA DA CLASS)
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Agora o Gate e o User já vão ser encontrados corretamente
        Gate::define('admin-access', function (User $user) {
            return $user->tipo === 'admin';
        });
    }
}