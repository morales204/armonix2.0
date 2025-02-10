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
        // Realiza la búsqueda usando el valor de 'search' desde la solicitud
        $results = Search::new()
            ->add(NotasPremium::class, ['nombre_notaP', 'contenido_notaP'])
            ->add(Usuario::class, ['nombre_completo', 'username'])
            ->beginWithWildcard()
            ->search($request->input('search'));
    
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
}
