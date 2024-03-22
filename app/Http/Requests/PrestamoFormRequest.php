<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            "datos_materia_id_datos_materia" => 'required',
            'fecha_hora_inicio' => 'required',
            'fecha_hora_fin' => 'required',
            'no_practica' => 'required|max:5',
            'titulo_practica'=> 'required|min:10|max:45',
            'fecha_prestamo'=> 'required',
            'status_id_status' => 'required',
            'laboratorios_id_laboratorio' => 'required',
            'usuarios_id_usuario' => 'required',
            'encargado_id_usuario' => 'required',
                
            //VALIDACIONES DE LA TABLA DETALLE PRESTAMO
            'cantidad_reactivo'=> 'max:10',
            'cantidad_material'=> 'max:10',
            'prestamos_id_prestamos' => 'required',
            'reactivos_id_reactivo' => 'required',
            'materiales_id_material' => 'required',

            //VALIDACIONES DE LA TABLA DATOS MATERIA
            'materias_id_materia' => 'required',
            'unidad_tematica' => 'max:45',
            'introduccion' => '',
            'objetivo' => '',
            'grado_grupo' => 'max:5',
            'carreras_id_carrera' => 'required',


        ];
    }
}
