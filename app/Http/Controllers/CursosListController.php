<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursosListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cursosQuery = DB::table('cursos as c')
        ->join('usuarios as u', 'c.id','=','id_usuario')
        ->select('c.id','c.nombre','c.descripcion','c.fecha_inicio','c.fecha_fin','u.id_usuario')
        ->orderBy('c.nombre','desc');

        if (auth()->user()->roles_id_rol !== 1) {
            $userEmail = auth()->user()->correo;
            $cursosQuery->where('u.correo', '=', $userEmail);
        }

        $cursos=$cursosQuery->paginate(5);

        return view('userFree.cursos.index',['cursos'=>$cursosQuery]);
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
        //
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
