<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario; 
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
    $request->validate([
        'email' => 'required|email|exists:usuarios,email',
        'secret_answer' => 'required|string',
        'secret_answer_2' => 'required|string',
    ]);

    $user = Usuario::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    if (empty($user->secret_answer) || empty($user->secret_answer_2)) {
        return redirect()->back()->with('error', 'El usuario no tiene respuestas de seguridad registradas.');
    }

    $isFirstAnswerValid = Hash::check($request->secret_answer, $user->secret_answer);
    $isSecondAnswerValid = Hash::check($request->secret_answer_2, $user->secret_answer_2);

    if (!$isFirstAnswerValid || !$isSecondAnswerValid) {
        return redirect()->back()->with('error', 'Las respuestas no coinciden. Inténtalo de nuevo.');
    }

    return redirect()->route('password.reset.question', ['email' => $user->email]);
}

}

