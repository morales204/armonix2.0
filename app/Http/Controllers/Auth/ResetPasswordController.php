<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; // Importa Hash
use App\Models\PasswordResetToken;
use App\Models\Usuario; // Importar el modelo Usuario

class ResetPasswordController extends Controller
{
    // Método para mostrar el formulario de restablecimiento de contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Método para manejar la actualización de la contraseña
    public function reset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Realizar el proceso de restablecimiento de contraseña
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password); // Usar Hash::make aquí
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Contraseña restablecida con éxito.');
        } else {
            return back()->withErrors(['email' => [trans($response)]]);
        }
    }

    // Método para re-hashear contraseñas existentes en la base de datos
    public function rehashPasswords()
    {
        $usuarios = Usuario::all();

        foreach ($usuarios as $usuario) {
            if (!Hash::needsRehash($usuario->password)) {
                $usuario->password = Hash::make($usuario->password); // Re-hashear la contraseña
                $usuario->save(); // Guardar el usuario con la nueva contraseña
            }
        }
    }
}
