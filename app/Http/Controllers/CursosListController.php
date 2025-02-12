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
        if($request){
            
            $tipo = $request->input('tipo');
            $buscar = trim($request->get('buscar'));

            $cursosQuery = DB::table('instrumentoscursos as c')
            ->select('c.id','c.nombre','c.descripcion','c.imagen','c.instrumento')
            ->orderBy('c.nombre','desc');

            if (($tipo)&& ($buscar)){
                $cursosQuery->where($tipo,'LIKE','%'.$buscar.'%');
            }
        }

        $cursos=$cursosQuery->paginate(5);

        return view('userFree.cursos.index',['cursos'=>$cursos]);
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
