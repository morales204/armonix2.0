<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instrument;
use App\Models\InstrumentType;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    // Método para cargar más cursos
    public function cargarMasCursos(Request $request)
{
    $offset = $request->input('offset', 0);
    $limit = 4; // Mismo valor que en el frontend
    $instrumentId = $request->input('instrument_id'); // Recibir el ID del instrumento

    // Filtrar cursos por el instrumento específico
    $cursos = Course::where('instrument_id', $instrumentId)
        ->skip($offset)
        ->take($limit)
        ->get();

    return response()->json($cursos);
}


    // Método index para mostrar los tipos de instrumentos
    public function index()
    {
        // Obtiene todos los tipos de instrumentos
        $instrumentTypes = InstrumentType::all();
        
        // Muestra la vista 'home' con los tipos de instrumentos
        return view('home', compact('instrumentTypes'));
    }

    // Método para mostrar un instrumento específico
    public function show($id)
    {
        $instrumentType = InstrumentType::findOrFail($id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)
            ->with('courses')  
            ->get();

        return view('admin.instrumentos.viento.viento', compact('instrumentType', 'instruments'));
    }

    // Método para mostrar los cursos de un instrumento específico
    public function courses($id)
    {
        $instrument = Instrument::findOrFail($id);

        $courses = $instrument->courses;  // Relación con cursos, asegúrate de que esté definida en el modelo Instrument

        $instrumentType = InstrumentType::findOrFail($instrument->instrument_type_id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)
            ->with('courses')
            ->get();

        // Retornar la vista con los datos necesarios
        return view('admin.instrumentos.viento.acordeon.acordeon', compact('instrument', 'courses', 'instrumentType', 'instruments'));
    }
}