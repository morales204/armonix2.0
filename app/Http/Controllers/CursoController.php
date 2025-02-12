<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    // Mostrar los detalles de un curso específico
    public function show($id)
    {
        // Obtener el curso específico
        $curso = Course::findOrFail($id);

        // Retornar la vista con los datos del curso
        return view('admin.instrumentos.viento.acordeon.acordeon', compact('curso'));
    }
}
