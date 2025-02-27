<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
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

        $user = DB::table('usuarios')->where('telefono', $request->telefono)->first();

        if (!$user) {
            return back()->with('error', 'Número de teléfono no registrado.');
        }

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE');

        $client = new Client($sid, $token);

        $verificationCode = rand(100000, 999999);

        try {
            $client->messages->create(
                '+52' . $request->telefono,
                [
                    'from' => $twilioNumber,
                    'body' => "Tu código de verificación para recuperar la contraseña **Armonix** es: $verificationCode"
                ]
            );

            // **Eliminar cualquier token previo antes de insertar uno nuevo**
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();

            // **Insertar el nuevo código en la base de datos**
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $verificationCode,
                'telefono' => $request->telefono,
                'created_at' => now()
            ]);

            return redirect()->route('sms.verify')->with([
                'telefono' => $request->telefono,
                'success' => 'Código enviado. Ingresa el código para continuar.'
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

        // **Buscar el código en la base de datos**
        $tokenEntry = DB::table('password_reset_tokens')
            ->where('telefono', $request->telefono)
            ->where('token', $request->codigo)
            ->first();

        if (!$tokenEntry) {
            return redirect()->route('sms.verify')->with([
                'error' => 'Código incorrecto o expirado.',
                'telefono' => $request->telefono
            ]);
        }

        // **Generar un nuevo token de 60 caracteres**
        $secureToken = Str::random(60);

        // **Eliminar el código de 6 dígitos y actualizar con el token largo**
        DB::table('password_reset_tokens')
            ->where('telefono', $request->telefono)
            ->update([
                'token' => $secureToken,
                'created_at' => now()
            ]);

        // **Redirigir al formulario de restablecimiento de contraseña**
        return redirect()->route('password.reset', [
            'token' => $secureToken,
            'email' => $tokenEntry->email
        ])->with('success', 'Código verificado. Ahora puedes restablecer tu contraseña.');
    }
}
