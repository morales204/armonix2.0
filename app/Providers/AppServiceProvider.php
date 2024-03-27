<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

//SE AGREGARON ESTAS TRES CLASES
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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
        //SE MODIFICO ESTA LINEA PARA AGREGAR NOTIFICACIONES EN TODAS LAS VISTAS
        View::composer('layouts.admin', function ($view) {
            if (Auth::check()) {
                $correo = Auth::user()->correo;
                $notificaciones = DB::table('notificaciones')
                    ->select('mensaje','titulo','estado')
                    ->where('correo', '=', $correo)
                    ->get();
                $notificaciones->total = $notificaciones->count();

                $view->with('notificaciones', $notificaciones);
            }
        });
        Paginator::useBootstrap();
    }
}
