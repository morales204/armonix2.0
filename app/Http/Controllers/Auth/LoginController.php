<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // Sobrescribir el método para cambiar el nombre del campo de autenticación
    public function username()
    {
        return 'correo';  // Cambia 'correo' por el nombre del campo de correo en tu base de datos
    }

    // Eliminar el método sendFailedLoginResponse si no necesitas personalización
    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     throw ValidationException::withMessages([
    //         $this->username() => [trans('auth.failed')],
    //         'password' => [trans('auth.password')],
    //     ]);
    // }

    // Constructor para aplicar el middleware de autenticación
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
