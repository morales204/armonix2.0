<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;
use App\Models\Instrument;
use App\Models\Course;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->get('search', ''));

        // Buscar en InstrumentTypes
        $instrumentTypes = InstrumentType::where('name', 'LIKE', '%' . $query . '%')->get();

        // Buscar en Instruments
        $instruments = Instrument::where('name', 'LIKE', '%' . $query . '%')->orWhere('name', 'LIKE', '%' . $query . '%')->get();

        // Buscar en Courses
        $courses = Course::where('name', 'LIKE', '%' . $query . '%')->orWhere('name', 'LIKE', '%' . $query . '%')->get();

        return view('admin.instrumentos.cursos', compact('instrumentTypes', 'instruments', 'courses', 'query'));
    }
}
