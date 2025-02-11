<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;

class InstrumentTypeController extends Controller
{
    // Mostrar todos los tipos de instrumentos y Buscar tipos de instrumentos
    public function index(Request $request)
    {
        
        $query = trim($request->get('search', '')); 
    
        $instrumentTypes = InstrumentType::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', '%' . $query . '%');
        })->orderBy('id', 'asc')->get();
    
        return view('admin.instrumentos.cursos', compact('instrumentTypes', 'query'));
    }
    

    // Mostrar los instrumentos de un tipo específico
    public function show($slug)
    {
        $instrumentType = InstrumentType::where('slug', $slug)->firstOrFail();

        $instruments = $instrumentType->instruments; 

        return view('admin.instrumentos.cursos', compact('instrumentType', 'instruments'));
    }
}