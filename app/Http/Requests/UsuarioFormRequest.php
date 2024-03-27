<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id_usuario = $this->route('usuario');
        return [
                'nombre_completo' => ['required', 'string','regex:/^[a-zA-ZáéíóúÁÉÍÓÚ-ñ\s]+$/u','min:10','max:80'],
                'telefono' => ['required', 'numeric', 'digits:10'],
                'correo' => ['required', 'string', 'email', 'max:100', Rule::unique('usuarios')->ignore($id_usuario, 'id_usuario')],
                'username' => ['required', 'string', 'max:30'],
                'roles_id_rol' => ['required'],
                'password' => ['required', 'string', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/' ,'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'El campo contraseña debe contener al menos una letra minúscula, una letra mayúscula, un número y un carácter especial.',
            'password.confirmed' => 'El campo confirmación de contraseña no coincide.',
        ];
    }
}
