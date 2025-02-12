<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Asegúrate de importar el modelo User
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    // Este método maneja la lógica de restablecimiento de contraseña
    public function reset(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|string|min:8|confirmed', // Asegúrate de que tenga confirmación
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obtener el usuario por correo
        $user = Usuario::where('email', $request->email)->first();

        // Cifrar la nueva contraseña
        $newPassword = Hash::make($request->password);

        // Actualizar la contraseña del usuario
        $user->password = $newPassword;
        $user->save();

        return redirect()->route('login')->with('status', '✅ ¡Contraseña restablecida con éxito! Ahora puedes iniciar sesión.');
    }

    // Método que muestra el formulario para restablecer la contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
