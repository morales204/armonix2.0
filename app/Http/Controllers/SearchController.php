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
        return response()->json(['error' => 'Escribe algo para buscar.'], 400);
    }

    if (!$instrumentTypeId) {
        $instruments = Instrument::where('name', 'LIKE', "%{$query}%")->get();
        $instrumentTypes = InstrumentType::where('name', 'LIKE', "%{$query}%")->get();
        $courses = Course::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
    } else {
        $instruments = Instrument::where('name', 'LIKE', "%{$query}%")
            ->where('instrument_type_id', $instrumentTypeId)
            ->get();

        $instrumentIds = Instrument::where('instrument_type_id', $instrumentTypeId)->pluck('id')->toArray();

        $courses = Course::whereHas('instrument', function ($q) use ($instrumentIds) {
                $q->whereIn('id', $instrumentIds);
            })
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->get();

        $instrumentTypes = InstrumentType::where('id', $instrumentTypeId)->get();
    }

    if ($request->ajax()) {
        return response()->json([
            'html' => view('admin.instrumentos.cursos', compact('query', 'instruments', 'instrumentTypes', 'courses'))->render()
        ]);
    }

    return view('admin.instrumentos.cursos', compact('query', 'instruments', 'instrumentTypes', 'courses'));
}


}