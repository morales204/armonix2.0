<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:usuarios,email']);

        $token = Str::random(60);

        // Eliminar cualquier token previo para el mismo email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Guardar el nuevo token en la base de datos
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Enviar el correo de restablecimiento de contraseña
        Mail::send('emails.password_reset', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Restablecer Contraseña');
        });

        return back()->with('status', '✅ ¡Correo enviado con éxito! Revisa tu bandeja de entrada para restablecer tu contraseña.');
    }

    // Este método sigue igual, ya que es el encargado de mostrar el formulario
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
}