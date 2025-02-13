<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use App\Models\NotasPremium;
use App\Models\Usuario;
use App\Models\Cursos;

use Illuminate\Support\Facades\Log;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Buscar las notas y los usuarios
        $results = Search::new()
            ->add(NotasPremium::class, ['nombre_notaP', 'contenido_notaP'])
            ->add(Cursos::class, ['nombre', 'descripcion'])
            ->beginWithWildcard()
            ->search($searchTerm);
    
        // Si la solicitud es AJAX (por ejemplo, cuando se usa el modal)
        if ($request->ajax()) {
            // Prepara los resultados para enviarlos como JSON
            $formattedResults = [];
    
            foreach ($results as $result) {
                if ($result instanceof NotasPremium) {
                    $formattedResults[] = [
                        'type' => 'nota',
                        'nombre_nota' => $result->nombre_notaP,
                        'contenido_nota' => $result->contenido_notaP,
                        'id_notaP' => $result->id_notaP,  // Agregar el ID de la nota
                    ];
                } elseif ($result instanceof Cursos) {
                    $formattedResults[] = [
                        'type' => 'curso',
                        'nombre' => $result->nombre,
                        'descripcion' => $result->descripcion,
                        'id' => $result->id,
                    ];
                }
            }
    
            // Devuelve los resultados como JSON
            return response()->json(['results' => $formattedResults]);
        }
    
        // Si no es una solicitud AJAX, simplemente retorna la vista como antes
        return view('layouts.admin', compact('results'));
    }
    

    public function buscarCursos(Request $request)
    {
    $searchTerm = $request->input('search');
    $cursos = Cursos::where('nombre', 'like', "%{$searchTerm}%")
                        ->orWhere('descripcion', 'like', "%{$searchTerm}%")
                        ->get();

    return view('admin.cursos.cursoslist', compact('cursos', 'searchTerm'));
    }

    public function buscarNotas(Request $request)
    {
        $searchTerm = $request->input('search');
        $notasPremium = NotasPremium::where('nombre_notaP', 'like', "%{$searchTerm}%")
                            ->orWhere('contenido_notaP', 'like', "%{$searchTerm}%")
                            ->paginate(10); // Esto paginará las notas (10 elementos por página)

        return view('notas-premium.show', compact('notasPremium', 'searchTerm'));
    }

}
