<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialFormRequest extends FormRequest
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
            'nombre_material' => ['required', 'max:80', 'string', 'regex:/^[a-zA-Z\s\-,.áéíóúÁÉÍÓÚñÑ]+$/'],
            'cantidad_disponible' => 'required | max:5',
            'descripcion' => ['required', 'max:150', 'string', 'regex:/^[a-zA-Z\s\-,.áéíóúÁÉÍÓÚñÑ]+$/'],
            'volumenes_id_volumen' => 'required'
        ];
    }
}
