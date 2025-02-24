<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
{
    public function index()
    {
        return view('sms.form');
    }

    public function sendSms(Request $request)
{
    $request->validate([
        'telefono' => 'required|regex:/^[0-9]{10}$/'
    ]);

    // Buscar el correo electrónico asociado al número de teléfono
    $user = DB::table('usuarios')->where('telefono', $request->telefono)->first(); // Cambiado a 'usuarios'

    if (!$user) {
        return back()->with('error', 'Número de teléfono no registrado.');
    }

    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_PHONE');

    $client = new Client($sid, $token);

    // Generar código de verificación de 6 dígitos
    $verificationCode = rand(100000, 999999);

    try {
        $client->messages->create(
            '+52' . $request->telefono,
            [
                'from' => $twilioNumber,
                'body' => "Tu código de verificación es: $verificationCode"
            ]
        );

        // Guardar en la base de datos
        DB::table('password_reset_tokens')->updateOrInsert(
            ['telefono' => $request->telefono], // Evita duplicados
            [
                'token' => $verificationCode,
                'created_at' => now(),
                'email' => $user->email // Guardar el correo electrónico del usuario
            ]
        );

        // Redirigir automáticamente a la vista de verificación con el teléfono
        return redirect()->route('sms.verify')->with([
            'telefono' => $request->telefono,
            'success' => 'Código enviado correctamente. Ingresa el código para continuar.'
        ]);

    } catch (\Exception $e) {
        return back()->with('error', 'Error al enviar SMS: ' . $e->getMessage());
    }
}


    public function showVerificationForm()
    {
        return view('sms.verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'telefono' => 'required|regex:/^[0-9]{10}$/',
            'codigo' => 'required|digits:6'
        ]);
    
        // Buscar el código en la base de datos
        $tokenEntry = DB::table('password_reset_tokens')
            ->where('telefono', $request->telefono)
            ->where('token', $request->codigo)
            ->first();
    
        if ($tokenEntry) {
            // **Eliminamos el código una vez validado**
            DB::table('password_reset_tokens')->where('telefono', $request->telefono)->delete();
    
            // Redirigir al formulario de restablecimiento de contraseña
            return redirect()->route('password.reset.form', ['email' => $tokenEntry->email])
                ->with('success', 'Código verificado. Ahora puedes restablecer tu contraseña.');
        } else {
            // **Mantener el número de teléfono en la sesión para el próximo intento**
            return redirect()->route('sms.verify')->with([
                'error' => 'Código incorrecto o expirado.',
                'telefono' => $request->telefono // Se mantiene en la sesión
            ]);
        }
    }
    
    

}
