<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;

class InstrumentTypeController extends Controller
{
    public function index()
    {
        // Cargar los tipos de instrumentos con sus instrumentos relacionados
        $instrumentTypes = InstrumentType::with('instruments')->get();
        
        return view('admin.instrumentos.cursos', compact('instrumentTypes'));
    }

    public function show($slug)
    {
        // Busca el tipo de instrumento por el slug
        $instrumentType = InstrumentType::where('slug', $slug)->firstOrFail();

        // Aquí puedes cargar los instrumentos relacionados a este tipo
        $instruments = $instrumentType->instruments;

        return view('admin.instrumentos.cursos', compact('instrumentType', 'instruments'));
    }
}

