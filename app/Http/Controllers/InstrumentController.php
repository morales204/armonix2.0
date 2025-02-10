<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\InstrumentType;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function show($id)
    {
        // Encuentra el tipo de instrumento usando el id
        $instrumentType = InstrumentType::findOrFail($id);

        // Obtén los instrumentos relacionados con este tipo
        $instruments = Instrument::where('type_id', $instrumentType->id)->get();

        return view('admin.instrumentos.viento.viento', compact('instrumentType', 'instruments'));
    }
}
