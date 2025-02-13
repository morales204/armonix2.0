<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\InstrumentType;
use App\Models\Course;
use App\Models\User;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = trim($request->get('search', ''));

        if (!$query) {
            return redirect()->back()->with('error', 'Escribe algo para buscar.');
        }

        // Buscar en Instrumentos
        $instruments = Instrument::where('name', 'LIKE', "%{$query}%")
            ->get();

        // Buscar en Tipos de Instrumento
        $instrumentTypes = InstrumentType::where('name', 'LIKE', "%{$query}%")
            ->get();

        // Buscar en Cursos
        $courses = Course::where('name', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->get();

        return view('admin.instrumentos.cursos', compact('query', 'instruments', 'instrumentTypes', 'courses'));
    }
}
