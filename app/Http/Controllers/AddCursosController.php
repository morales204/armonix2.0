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

        // Manejo de la imagen
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->move(public_path('img'), $imageName); 

            $imagePath = 'img/' . $imageName; 
        }

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'instrument_id' => $request->instrument_id,
            'image' => $imagePath 
        ]);


        return redirect()->route('admin.cursos.cursoslist')->with('success', 'Curso agregado correctamente');
    }

    public function cursosList(Request $request)
    {
        $query = Course::with('instrument'); 

        if ($request->filled('buscar') && $request->filled('tipo')) {
            $tipo = $request->input('tipo');
            $buscar = $request->input('buscar');

            // Aplicar filtros según el tipo seleccionado
            if ($tipo == 'nombre') {
                $query->where('name', 'LIKE', "%$buscar%");
            } elseif ($tipo == 'descripcion') {
                $query->where('description', 'LIKE', "%$buscar%");
            } elseif ($tipo == 'instrumento') {
                $query->whereHas('instrument', function ($q) use ($buscar) {
                    $q->where('name', 'LIKE', "%$buscar%");
                });
            }
        }

        $cursos = $query->paginate(5);

    if ($request->ajax()) {
        return view('admin.cursos.partials.cursos-table', compact('cursos'));
    }

        return view('admin.cursos.cursoslist', compact('cursos'));
    }
}
