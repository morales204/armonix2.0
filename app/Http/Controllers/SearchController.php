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

    // Validar la consulta
    if (!$query) {
        return response()->json(['error' => 'Escribe algo para buscar.'], 400);
    }

    // Búsqueda de instrumentos
    $instruments = Instrument::where('name', 'LIKE', "%{$query}%")
        ->when($instrumentTypeId, function ($q) use ($instrumentTypeId) {
            return $q->where('instrument_type_id', $instrumentTypeId);
        })
        ->paginate(6);

    // Búsqueda de tipos de instrumentos
    $instrumentTypes = InstrumentType::where('name', 'LIKE', "%{$query}%")
        ->when($instrumentTypeId, function ($q) use ($instrumentTypeId) {
            return $q->where('id', $instrumentTypeId);
        })
        ->paginate(6);

    // Búsqueda de cursos
    $courses = Course::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%");
        })
        ->when($instrumentTypeId, function ($q) use ($instrumentTypeId) {
            return $q->whereHas('instrument', function ($subQuery) use ($instrumentTypeId) {
                $subQuery->where('instrument_type_id', $instrumentTypeId);
            });
        })
        ->paginate(6);

    // Respuesta JSON para AJAX
    if ($request->ajax()) {
        return response()->json([
            'data' => $courses->items(),
            'pagination' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
            ],
        ]);
    }

    // Retorno de vista, pasando las variables a la vista
    return view('admin.instrumentos.cursos', compact('query', 'instruments', 'instrumentTypes', 'courses'));
}

    

    public function pagination(Request $request)
{
    $courses = Course::paginate(6);

    if ($request->ajax()) {
        return view('partials.courses_list', compact('courses'))->render();
    }

    return view('admin.instrumentos.viento.acordeon.acordeon', compact('courses'));
}


}

