<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_completo' => ['required', 'string', 'max:60','regex:/^[a-zA-Z\s\p{L}]+$/u'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles_id_rol' => ['required'],
            // Validación del checkbox de privacidad
            'aviso-privacidad' => ['required', 'accepted'], // Asegurarse de que esté marcado
            'pregunta_secreta_1' => 'required|string',
            'respuesta_secreta_1' => 'required|string',
            'pregunta_secreta_2' => 'required|string',
            'respuesta_secreta_2' => 'required|string',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre_completo' => $data['nombre_completo'],
            'telefono' => $data['telefono'],
            'correo' => $data['correo'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'roles_id_rol' => $data['roles_id_rol'],
            'pregunta_secreta_1' => $data['pregunta_secreta_1'],
            'respuesta_secreta_1' => Hash::make($data['respuesta_secreta_1']),
            'pregunta_secreta_2' => $data['pregunta_secreta_2'],
            'respuesta_secreta_2' => Hash::make($data['respuesta_secreta_2']),
        ]);

        
    }
}
