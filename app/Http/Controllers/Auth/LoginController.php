<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function username()
    {
        return 'email';  // Asegúrate de que este campo coincida con tu base de datos
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
