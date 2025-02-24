<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Asegúrate de usar el modelo correcto
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    // Método para manejar la lógica de restablecimiento de contraseña
    public function reset(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|string|min:8|confirmed', // Verifica que las contraseñas coincidan
            'token' => 'required|string' // Asegurar que el token sea obligatorio
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verificar que el token es válido en la base de datos
        $tokenEntry = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$tokenEntry) {
            return redirect()->back()->withErrors(['error' => 'El código de verificación es incorrecto o ha expirado.'])->withInput();
        }

        // Obtener el usuario por correo
        $user = Usuario::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'El usuario no existe.'])->withInput();
        }

        // Cifrar y actualizar la contraseña del usuario
        $user->password = Hash::make($request->password);
        $user->save();

        // Eliminar el token después de ser usado
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', '✅ ¡Contraseña restablecida con éxito! Ahora puedes iniciar sesión.');
    }

    // Método para mostrar el formulario de restablecimiento de contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }
}
