<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrestamoFormRequest extends FormRequest
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
            //VALIDACIONES DE LA TABLA PRESTAMOS
            'numero_practica' => 'required|max:2',
            'titulo_practica'=> 'required|min:10|max:45',

            //VALIDACIONES DE LA TABLA DETALLE PRESTAMO
            'cantidad_reactivo'=> 'max:10',
            'cantidad_material'=> 'max:10',
            'idMaterialOrReactivo' => 'required_without_all:idReactivo,idMaterial',

            //VALIDACIONES DE LA TABLA DATOS MATERIA
            'unidad_tematica' => 'max:40',
            'introduccion' => 'required',
            'objetivo' => 'required',
            'grado_grupo' => 'max:5',

        ];
    }

    public function messages(): array
    {
        return [
            'idMaterialOrReactivo.required_without_all' => 'Por favor selecciona al menos un material o reactivo.',
        ];
    }
}
