<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\InstrumentType;
use App\Models\Course;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = trim($request->get('search', ''));
        $instrumentTypeId = $request->get('instrument_type'); 

        if (!$query) {
            return redirect()->back()->with('error', 'Escribe algo para buscar.');
        }

        if (!$instrumentTypeId) {
            // Buscar en Instrumentos
            $instruments = Instrument::where('name', 'LIKE', "%{$query}%")->get();

            // Buscar en Tipos de Instrumento
            $instrumentTypes = InstrumentType::where('name', 'LIKE', "%{$query}%")->get();

            // Buscar en Cursos
            $courses = Course::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%") 
                ->get();
        } else {
            // Si se seleccionó un tipo de instrumento, hacer búsqueda filtrada
            $instruments = Instrument::where('name', 'LIKE', "%{$query}%")
                ->where('instrument_type_id', $instrumentTypeId)
                ->get();

            // Filtrar cursos por el instrumento encontrado
            $courses = Course::whereHas('instrument', function ($query) use ($instruments) {
                $instrumentIds = $instruments->pluck('id')->toArray(); 
                $query->whereIn('id', $instrumentIds);
            })->get();

            $instrumentTypes = InstrumentType::where('id', $instrumentTypeId)->get(); 
        }

        return view('admin.instrumentos.cursos', compact('query', 'instruments', 'instrumentTypes', 'courses'));
    }
}
