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
                $q->where('instrument_type_id', $instrumentTypeId);
            })
            ->get();

        // Búsqueda de tipos de instrumentos
        $instrumentTypes = InstrumentType::where('name', 'LIKE', "%{$query}%")
            ->when($instrumentTypeId, function ($q) use ($instrumentTypeId) {
                $q->where('id', $instrumentTypeId);
            })
            ->get();

        // Obtener IDs de instrumentos si se filtró por tipo
        $instrumentIds = $instrumentTypeId ? Instrument::where('instrument_type_id', $instrumentTypeId)->pluck('id') : [];

        // Búsqueda de cursos
        $courses = Course::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->when($instrumentTypeId, function ($q) use ($instrumentIds) {
                $q->whereHas('instrument', function ($subQuery) use ($instrumentIds) {
                    $subQuery->whereIn('id', $instrumentIds);
                });
            })
            ->get();

        // Respuesta JSON para AJAX
        if ($request->ajax()) {
            return response()->json([
                'instruments' => $instruments,
                'instrumentTypes' => $instrumentTypes,
                'courses' => $courses,
            ]);
        }

        // Retorno de vista
        return view('admin.instrumentos.cursos', compact('query', 'instruments', 'instrumentTypes', 'courses'));
    }
}
