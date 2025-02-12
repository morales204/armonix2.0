<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

         // Convierte los roles a un array si vienen en formato separado por comas
    $rolesArray = explode('|', $role);

    // Verifica si el usuario tiene al menos uno de los roles permitidos
    if (!in_array(Auth::user()->roles_id_rol, $rolesArray)) {
        return redirect('/home');
    }
        return $next($request);
    }
}
