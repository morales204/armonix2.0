<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentType;
use App\Models\Instrument;

class InstrumentTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->get('search', ''));

        // Buscar en InstrumentType por nombre
        $instrumentTypes = InstrumentType::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', '%' . $query . '%');
        })->orderBy('id', 'asc')->get();

        // Buscar en Instrument por nombre y cargar su tipo de instrumento
        $instruments = Instrument::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', '%' . $query . '%');
        })->with('instrumentType')->orderBy('id', 'asc')->get();

        return view('admin.instrumentos.cursos', compact('instrumentTypes', 'instruments', 'query'));
    }

    // Mostrar los instrumentos de un tipo específico
    public function show($slug)
    {
        $instrumentType = InstrumentType::where('slug', $slug)->firstOrFail();
        $instruments = $instrumentType->instruments;

        return view('admin.instrumentos.cursos', compact('instrumentType', 'instruments'));
    }

    // Crear tipo de instrumento
    public function create()
    {
        return view('admin.instrument_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:instrument_types',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('instrument_types', 'public') : null;

        InstrumentType::create([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect()->route('instrument-types.create')->with('success', 'Tipo de instrumento creado correctamente.');
    }
}
