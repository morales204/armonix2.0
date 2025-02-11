<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\InstrumentType;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function show($id)
    {
        $instrumentType = InstrumentType::findOrFail($id);

        $instruments = Instrument::where('instrument_type_id', $instrumentType->id)->get();

        return view('admin.instrumentos.viento.viento', compact('instrumentType', 'instruments'));
    }
}

