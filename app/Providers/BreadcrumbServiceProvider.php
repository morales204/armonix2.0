<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class BreadcrumbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $breadcrumbs = session('breadcrumbs', []);
            $view->with('breadcrumbs', $breadcrumbs);
        });
    }
}

