<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;

class InstrumentTypeController extends Controller
{
    public function index()
    {
        $instrumentTypes = InstrumentType::with('instruments')->get();
        
        return view('admin.instrumentos.cursos', compact('instrumentTypes'));
    }

    public function show($slug)
    {
        $instrumentType = InstrumentType::where('slug', $slug)->firstOrFail();

        $instruments = $instrumentType->instruments;

        return view('admin.instrumentos.cursos', compact('instrumentType', 'instruments'));
    }
}

