<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\InstrumentType; // Asegúrate de importar el modelo

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
        // Cargar tipos de instrumentos en el layout admin
        View::composer('layouts.admin', function ($view) {
            // Cargar tipos de instrumentos
            $instrumentTypes = InstrumentType::with('instruments')->get();
            $view->with('instrumentTypes', $instrumentTypes);
            
        });

        Paginator::useBootstrap();
    }
}