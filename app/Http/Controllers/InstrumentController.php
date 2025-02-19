<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\InstrumentType;

class InstrumentController extends Controller
{
 
    public function index()
    {
        // Obtiene todos los tipos de instrumentos
        $instrumentTypes = InstrumentType::all();
        
        // Muestra la vista 'home' con los tipos de instrumentos
        return view('home', compact('instrumentTypes'));

    }
    public function show($id)
    {

        $instrumentType = InstrumentType::findOrFail($id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)
            ->with('courses')
            ->get();

        return view('admin.instrumentos.viento.viento', compact('instrumentType', 'instruments'));
    }

    public function courses($id)
    {
        $instrument = Instrument::findOrFail($id);

        $courses = $instrument->courses;

        $instrumentType = InstrumentType::findOrFail($instrument->instrument_type_id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)
            ->with('courses')
            ->get();

        // Retornar la vista con los datos necesarios
        return view('admin.instrumentos.viento.acordeon.acordeon', compact('instrument', 'courses', 'instrumentType', 'instruments'));
    }
}
