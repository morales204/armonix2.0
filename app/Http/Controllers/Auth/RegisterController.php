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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'secret_question' => ['required', 'string', ],
            'secret_answer' => ['required', 'string', 'max:255'],
            'secret_question_2' => ['required', 'string', ],
            'secret_answer_2' => ['required', 'string', 'max:255'],
            'roles_id_rol' => ['required'],
            'aviso-privacidad' => ['required', 'accepted'], 
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
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'secret_question' => $data['secret_question'],
            'secret_answer' => Hash::make($data['secret_answer']),
            'secret_question_2' => $data['secret_question_2'],
            'secret_answer_2' => Hash::make($data['secret_answer_2']),
            'roles_id_rol' => $data['roles_id_rol']
        ]);
    }
}
