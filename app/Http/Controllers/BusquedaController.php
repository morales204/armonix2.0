<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use App\Models\NotasPremium;
use App\Models\Usuario;

use Illuminate\Support\Facades\Log;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Buscar las notas y los usuarios
        $results = Search::new()
            ->add(NotasPremium::class, ['nombre_notaP', 'contenido_notaP'])
            ->add(Usuario::class, ['nombre_completo', 'username'])
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
                } elseif ($result instanceof Usuario) {
                    $formattedResults[] = [
                        'type' => 'usuario',
                        'nombre_completo' => $result->nombre_completo,
                        'username' => $result->username,
                    ];
                }
            }
    
            // Devuelve los resultados como JSON
            return response()->json(['results' => $formattedResults]);
        }
    
        // Si no es una solicitud AJAX, simplemente retorna la vista como antes
        return view('layouts.admin', compact('results'));
    }
    

    public function buscarUsuarios(Request $request)
    {
    $searchTerm = $request->input('search');
    $usuarios = Usuario::where('nombre_completo', 'like', "%{$searchTerm}%")
                        ->orWhere('username', 'like', "%{$searchTerm}%")
                        ->get();

    return view('usuarios.index', compact('usuarios', 'searchTerm'));
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
