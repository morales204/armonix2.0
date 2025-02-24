<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SecretAnswer extends Controller
{
    public function verificarCorreo(Request $request)
    {
        $request->validate(['correo' => 'required|email']);
    
        $usuario = Usuario::where('correo', $request->correo)->first();
    
        if (!$usuario) {
            return back()->with('error', 'Correo no encontrado.');
        }
    
        return view('auth.answer_question', ['usuario' => $usuario]);
    }
    
    public function validarRespuesta(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'respuesta_secreta' => 'required|string',
        ]);
    
        // Obtener intentos fallidos desde la sesión
        $intentos = Session::get('intentos_fallidos_' . $request->correo, 0);
        $bloqueo = Session::get('bloqueo_' . $request->correo);
    
        // Verificar si el usuario está bloqueado
        if ($bloqueo && Carbon::now()->lt(Carbon::parse($bloqueo))) {
            $tiempoRestante = Carbon::parse($bloqueo)->diffInSeconds(Carbon::now());
            return view('auth.answer_question', [
                'usuario' => Usuario::where('correo', $request->correo)->first(), // Intentamos obtener el usuario
                'error' => "Demasiados intentos. Intenta nuevamente en {$tiempoRestante} segundos."
            ]);
        }
    
        $usuario = Usuario::where('correo', $request->correo)->first();
    
        // Verificar la respuesta secreta
        if (!$usuario || !Hash::check($request->respuesta_secreta, $usuario->respuesta_secreta)) {
            $intentos++;
    
            // Si falló 3 veces, bloquear por 1 minuto
            if ($intentos >= 3) {
                Session::put('bloqueo_' . $request->correo, Carbon::now()->addMinutes(1));
                Session::forget('intentos_fallidos_' . $request->correo);
            } else {
                Session::put('intentos_fallidos_' . $request->correo, $intentos);
            }
    
            return view('auth.answer_question', [
                'usuario' => $usuario ?? (object) ['correo' => $request->correo, 'pregunta_secreta' => ''], // Evita el error
                'error' => "Respuesta incorrecta. Intentos restantes: " . (3 - $intentos),
            ]);
        }
    
        // Restablecer intentos en sesión
        Session::forget('intentos_fallidos_' . $request->correo);
        Session::forget('bloqueo_' . $request->correo);
    
        return view('auth.reset_my_password', ['correo' => $usuario->correo]);
    }
    

    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();
        $usuario->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')->with('success', 'Contraseña restablecida.');
    }



    
}

