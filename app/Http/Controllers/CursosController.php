<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

use App\Models\CursosUser;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request){
            
            $tipo = $request->input('tipo');
            $buscar = trim($request->get('buscar'));

            $cursosQuery = DB::table('cursos as c')
            ->join('usuarios as u', 'c.usuarios_id_usuario','=','u.id_usuario')
            ->select('c.id_curso','c.nombre','c.descripcion','c.fecha_inicio','c.fecha_fin','c.duracion','u.id_usuario')
            ->orderBy('c.nombre','desc');

            if (!empty($tipo)&& !empty($buscar)){
                $cursosQuery->where($tipo,'LIKE','%'.$buscar.'%');
            }
        }
        if (auth()->user()->roles_id_rol !== 1) {
            /* $userEmail = auth()->user()->correo; */
            $cursosQuery->where('u.id_usuario',auth()->user()->id_usuario);
        }

        $cursos=$cursosQuery->paginate(3);
        if ($request->ajax()) {
            return response()->json([
                'cursos' => $cursos
            ]);
        }

        return view('userFree.cursos.cursoslist',['cursos'=>$cursos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = CursosUser::find($id);
    if ($curso) {
        return response()->json([
            'success' => true,
            'curso' => $curso
        ]);
    } else {
        return response()->json(['success' => false]);
    }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
