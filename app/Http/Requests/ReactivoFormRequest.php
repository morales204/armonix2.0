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
            'nombre_reactivo' =>['required','max:50', 'string', 'regex:/^[a-zA-Z\s\-,.áéíóúÁÉÍÓÚñÑ]+$/'],
            'cantidad_disponible' =>'required|numeric|min:1',
            'hoja_seguridad' =>'mimes:pdf',
            'nomenclatura' => ['required', 'max:50', 'regex:/^[a-zA-Z0-9\s\-,.áéíóúÁÉÍÓÚñÑ]+$/'],
            'fecha_adquisicion' => 'required|date|before_or_equal:now', // Asegura que sea la fecha actual o anterior
            'fecha_caducidad' => 'required|date|after:fecha_adquisicion',
            'familias_id_familia' => 'required|not_in:1|exists:familias,id_familia',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_adquisicion' => 'La fecha de adquisicion no pude ser superior a la fecha actual',
            'familias_id_familia' => 'Por favor selecciona una opcion',
        ];
    }
}
