<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de usar el modelo correcto
use Illuminate\Support\Facades\Hash;

class PasswordRecoveryController extends Controller
{
    public function showQuestions(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:usuarios,email',
    ]);

    $user = Usuario::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'El correo no está registrado.');
    }

    return view('auth.password_questions', compact('user'));
}

public function verifyAnswers(Request $request)
{
    // Validar las respuestas
    $request->validate([
        'email' => 'required|email|exists:usuarios,email',
        'secret_answer' => 'required|string',
        'secret_answer_2' => 'required|string',
    ]);

    // Buscar el usuario por su email
    $user = Usuario::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    // Verificar si las respuestas coinciden con las almacenadas en la base de datos
    if (!Hash::check($request->secret_answer, $user->secret_answer) || 
        !Hash::check($request->secret_answer_2, $user->secret_answer_2)) {
        return redirect()->back()->with('error', 'Las respuestas no coinciden. Inténtalo de nuevo.');
    }

    // Si las respuestas son correctas, redirigir al formulario para cambiar la contraseña
    return redirect()->route('password.reset.question', ['email' => $user->email]);
}
}

