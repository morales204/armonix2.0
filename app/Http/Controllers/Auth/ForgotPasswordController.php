<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    // Si deseas personalizar el mensaje de éxito o error, puedes hacerlo aquí
    protected function sendResetLinkResponse(Request $request, $response)
    {
        if ($response == 'passwords.sent') {
            return back()->with('status', '✅ ¡Correo enviado con éxito! Revisa tu bandeja de entrada para restablecer tu contraseña.');
        } else {
            return back()->withErrors(['correo' => 'Error al enviar el correo.']);
        }
    }

    // Si no quieres personalizar la respuesta, puedes eliminar este método.
}
