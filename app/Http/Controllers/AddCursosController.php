<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddCursosController extends Controller
{
    public function index()
    {
        $instruments = Instrument::all();
        return view('admin.cursos.agregarCurso', compact('instruments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instrument_id' => 'required|exists:instruments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('img', $request->file('image')->getClientOriginalName(), 'public');
        }

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'instrument_id' => $request->instrument_id,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.cursos.cursoslist')->with('success', 'Curso agregado correctamente');
    }

    public function cursosList()
    {
        $cursos = Course::with('instrument')->get();
        return view('admin.cursos.cursoslist', compact('cursos'));
    }
}
