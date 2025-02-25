<?php

namespace App\Http\Controllers;

use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Usuario;

class PasswordRecoveryController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    // Mostrar la vista para recuperar la contraseña (con el número de teléfono)
    public function showRecoveryForm()
    {
        return view('auth.passwords.recover-password');
    }

    public function showValidateCodeForm()
    {
        return view('auth.passwords.validatex-code');
    }

    // Enviar el código de recuperación por SMS
    public function sendRecoveryCode(Request $request)
    {
        // Validar que el número de teléfono tenga el formato correcto sin el prefijo +52
        $request->validate([
            'phone' => 'required|numeric|regex:/^[0-9]{10}$/',  // Validamos que el teléfono tenga 10 dígitos sin el prefijo
        ]);
    
        // Obtener el teléfono ingresado sin el prefijo +52
        $phoneWithoutPrefix = $request->phone;
    
        // Crear el número completo agregando el prefijo +52
        $fullPhone = '+52' . $phoneWithoutPrefix;
    
        // Verificar si el número existe en la base de datos
        $usuario = DB::table('usuarios')->where('telefono', $fullPhone)->first();
    
        // Si no se encuentra el usuario, mostrar un mensaje de error
        if (!$usuario) {
            return redirect()->route('password.recover-password')->with('error', 'No existe ningún usuario registrado con ese número de teléfono.');
        }
    
        // Generar un código de recuperación aleatorio
        $recoveryCode = rand(100000, 999999);
    
        $expiresAt = now()->addMinutes(2);

        // Guardar el código de recuperación en la base de datos
        DB::table('password_recovery_codes')->insert([
            'usuario_id' => $usuario->id_usuario, // Usamos la columna id_usuario como la clave foránea
            'recovery_code' => $recoveryCode,
            'expires_at' => $expiresAt, // Guardamos la fecha de expiración
            'created_at' => now(),
        ]);
    
        // Enviar el mensaje por SMS utilizando el servicio de Twilio
        $message = "Tu código de recuperación es: $recoveryCode";
        try {
            $this->twilioService->sendSms($fullPhone, $message);
        } catch (\Exception $e) {
            // Registrar el error exacto
            \Log::error('Error al enviar SMS: ' . $e->getMessage());
            // En caso de error al enviar el SMS
            return redirect()->route('password.recover-password')->with('error', 'Hubo un error al enviar el código. Intenta nuevamente.');
        }
        
        // Redirigir con el mensaje de éxito
        return response()->redirectTo(route('password.show_verify_form', ['phone' => $request->phone]))
            ->with('message', 'Código de recuperación enviado. Ingresa el código para continuar.');

    }
    
    public function showVerifyForm($phone)
    {
        return view('auth.passwords.verify-code', compact('phone'));
    }
    

    // Validar el código de recuperación ingresado
    public function verifyRecoveryCode(Request $request)
    {
        // Validar el código de recuperación
        $request->validate([
            'recovery_code' => 'required|numeric|digits:6', // Asegurarse de que sea un código numérico de 6 dígitos
        ]);
    
        // Buscar el código de recuperación en la base de datos
        $recoveryCode = DB::table('password_recovery_codes')
                        ->where('recovery_code', $request->recovery_code)
                        ->first();
    
        // Verificar si el código es válido
        if (!$recoveryCode) {
            return redirect()->back()->with('error', 'Código de recuperación inválido.');
        }
        // Verificar si el código ha caducado
        if ($recoveryCode->expires_at && now()->greaterThan($recoveryCode->expires_at)) {
            // El código ha expirado, eliminarlo de la base de datos
            DB::table('password_recovery_codes')->where('recovery_code', $recoveryCode->recovery_code)->delete();

            return redirect()->back()->with('error', 'El código ha caducado. Por favor, solicita uno nuevo.');
        }

        // Si el código es válido, redirigir al usuario a la página de cambiar contraseña
        return redirect()->route('password.change-password', ['user_id' => $recoveryCode->usuario_id])->with('message', 'Código válido, puedes cambiar tu contraseña.');
    }
    

    // Mostrar la vista para cambiar la contraseña
    public function showChangePasswordForm($user_id)
    {
        return view('auth.passwords.change-password', compact('user_id'));
    }    

    // Cambiar la contraseña
    public function updatePassword(Request $request)
    {
        // Validar la nueva contraseña
        $request->validate([
            'password' => 'required|min:6|confirmed', // La contraseña debe tener al menos 6 caracteres y debe coincidir con la confirmación
        ]);
    
        // Buscar al usuario usando el ID proporcionado
        $usuario = Usuario::find($request->user_id); // Usamos el modelo 'Usuario' aquí
    
        // Verificar si el usuario existe
        if (!$usuario) {
            return redirect()->back()->with('error', 'No se encontró el usuario.');
        }
    
        // Actualizar la contraseña
        $usuario->password = bcrypt($request->password); // Cifra la nueva contraseña
        $usuario->save(); // Guarda los cambios en la base de datos
    
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('login')->with('message', 'Contraseña actualizada con éxito. Ahora puedes iniciar sesión.');
    }
    
}
