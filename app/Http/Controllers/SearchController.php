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

        // Lógica de búsqueda
        $instruments = Instrument::where('name', 'LIKE', "%{$query}%");
        $instrumentTypes = InstrumentType::where('name', 'LIKE', "%{$query}%");
        $courses = Course::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%");

        if ($instrumentTypeId) {
            $instruments = $instruments->where('instrument_type_id', $instrumentTypeId);
            $instrumentIds = Instrument::where('instrument_type_id', $instrumentTypeId)->pluck('id')->toArray();
            $courses = $courses->whereHas('instrument', function ($q) use ($instrumentIds) {
                $q->whereIn('id', $instrumentIds);
            });
            $instrumentTypes = $instrumentTypes->where('id', $instrumentTypeId);
        }

        // Obtener los resultados
        $instruments = $instruments->get();
        $instrumentTypes = $instrumentTypes->get();
        $courses = $courses->get();

        // Estructura de la respuesta
        $response = [
            'instruments' => $instruments,
            'instrumentTypes' => $instrumentTypes,
            'courses' => $courses,
        ];

        // Respuesta JSON
        if ($request->ajax()) {
            return response()->json($response);
        }

        return view('admin.instrumentos.cursos', [
            'query' => $query,
            'instruments' => $instruments,
            'instrumentTypes' => $instrumentTypes,
            'courses' => $courses,
        ]);
    }
}
