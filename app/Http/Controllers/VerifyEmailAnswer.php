<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class VerifyEmailAnswer extends Controller
{
    public function index()
    {
        return view('auth.recover_password');
    }

    public function verificarCorreo(Request $request)
    {
        $request->validate(['correo' => 'required|email']);
    
        $usuario = Usuario::where('correo', $request->correo)->first();
    
        if (!$usuario) {
            return back()->with('error', 'Correo no encontrado.');
        }
    
        return view('auth.answer_question', ['usuario' => $usuario]);
    }
    

}

