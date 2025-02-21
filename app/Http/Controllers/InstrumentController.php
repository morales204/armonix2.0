<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instrument;
use App\Models\InstrumentType;
use App\Models\Curso;  // Asegúrate de importar el modelo Curso
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    // Método para cargar más cursos
    public function cargarMasCursos(Request $request)
    {
        $offset = $request->input('offset', 0);  // Obtener el valor del offset o 0 por defecto
        $limit = 4;  // Número de cursos a cargar por vez

        // Recuperar los cursos desde la base de datos con límite y desplazamiento
        $cursos = Course::skip($offset)->take($limit)->get();

        // Retornar los cursos en formato JSON
        return response()->json($cursos);
    }

    // Método index para mostrar los tipos de instrumentos
    public function index()
    {
        // Obtiene todos los tipos de instrumentos
        $instrumentTypes = InstrumentType::all();
        
        // Muestra la vista 'home' con los tipos de instrumentos
        return view('home', compact('instrumentTypes'));
    }

    // Método para mostrar un instrumento específico
    public function show($id)
    {
        $instrumentType = InstrumentType::findOrFail($id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)
            ->with('courses')  // Asegúrate de que el modelo Instrument tiene una relación con courses
            ->get();

        return view('admin.instrumentos.viento.viento', compact('instrumentType', 'instruments'));
    }

    // Método para mostrar los cursos de un instrumento específico
    public function courses($id)
    {
        $instrument = Instrument::findOrFail($id);

        $courses = $instrument->courses;  // Relación con cursos, asegúrate de que esté definida en el modelo Instrument

        $instrumentType = InstrumentType::findOrFail($instrument->instrument_type_id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)
            ->with('courses')
            ->get();

        // Retornar la vista con los datos necesarios
        return view('admin.instrumentos.viento.acordeon.acordeon', compact('instrument', 'courses', 'instrumentType', 'instruments'));
    }
}
