<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Tus políticas si las tienes
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
{
    $this->registerPolicies();

    $this->app->bind('auth.password.tokens', function ($app) {
        return new DatabaseTokenRepository(
            $app['db']->connection(),
            $app['hash'],
            'password_reset_tokens',
            'correo', // 🔹 Especificamos que use "correo"
            now()->addMinutes(60)
        );
    });
}
}
