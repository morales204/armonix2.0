<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken; // Asegúrate de importar el modelo
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Str; // Para generar un token aleatorio
use Illuminate\Support\Facades\Mail; // Para enviar correos

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request, $response)
    {
        if ($response == 'passwords.sent') {
            return back()->with('status', '✅ ¡Correo enviado con éxito! Revisa tu bandeja de entrada para restablecer tu contraseña.');
        } else {
            return back()->withErrors(['email' => 'Error al enviar el correo.']);
        }
    }

    public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Generar un nuevo token
    $token = Str::random(60);
    // Guardar el token en la base de datos
    PasswordResetToken::create(['email' => $request->email, 'token' => $token]);

    // Enviar el correo de restablecimiento de contraseña
    Mail::send('emails.password_reset', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Restablecer Contraseña');
    });

    return $this->sendResetLinkResponse($request, 'passwords.sent');
}

}
