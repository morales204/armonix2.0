<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;

class InstrumentTypeController extends Controller
{
    // Mostrar todos los tipos de instrumentos
    public function index()
    {
        $instrumentTypes = InstrumentType::all();
        return view('admin.instrumentos.cursos', compact('instrumentTypes'));
    }

    // Mostrar los instrumentos de un tipo específico
    public function show($slug)
    {
        // Busca el tipo de instrumento por el slug
        $instrumentType = InstrumentType::where('slug', $slug)->firstOrFail();

        // Aquí puedes cargar los instrumentos relacionados a este tipo, si es necesario
        $instruments = $instrumentType->instruments; // Asumiendo que hay una relación con los instrumentos

        return view('admin.instrumentos.cursos', compact('instrumentType', 'instruments'));
    }
}
