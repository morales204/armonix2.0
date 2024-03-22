<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReactivoFormRequest extends FormRequest
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
        return [
            //Estos nombres que esta dentro de las reglas no son el nombre de las tablas de la bd
            //sino son del formulario
            'nombre_reactivo' =>'required|max:50',
            'cantidad_disponible' =>'required',
            'hoja_seguridad' =>'',
            'nomenclatura' =>'required | max:50',
            'fecha_adquisicion' => 'required',
            'fecha_caducidad' => 'required',

        ];
    }
}
