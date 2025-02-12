<?php

namespace App\Providers;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class CustomPasswordResetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend('auth.password', function ($service, $app) {
            return new PasswordBrokerManager($app);
        });

        $this->app->extend('auth.password.broker', function ($service, $app) {
            $connection = DB::connection();
            $table = 'password_reset_tokens';  // Nombre correcto de la tabla
            $hashing = $app->make(Hasher::class); // Asegurar el uso del Hasher
            $key = $app['config']['app.key'];
            $expire = $app['config']['auth.passwords.usuarios.expire'];

            return new DatabaseTokenRepository($connection, $hashing, $table, 'email', $key, $expire);
        });
    }
}
