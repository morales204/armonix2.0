<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;

class InstrumentTypeController extends Controller
{
    // Mostrar todos los tipos de instrumentos y Buscar tipos de instrumentos
    public function index(Request $request)
    {
        $query = trim($request->get('search', '')); // Si no hay búsqueda, será una cadena vacía
    
        $instrumentTypes = InstrumentType::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', '%' . $query . '%');
        })->orderBy('id', 'asc')->get();
    
        return view('admin.instrumentos.cursos', compact('instrumentTypes', 'query'));
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
