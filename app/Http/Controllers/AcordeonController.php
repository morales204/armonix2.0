<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcordeonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Query = DB::table('instrumentoscursos as ci')
        ->select('ci.nombre','ci.imagen','ci.instrumento')
        ->orderBy('ci.nombre','desc')
        ->where('ci.instrumento', 'acordeon')
        ->paginate(5);

        return view('admin.instrumentos.viento.acordeon.acordeon',['cursos'=>$Query]);
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

