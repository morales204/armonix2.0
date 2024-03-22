<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Volumen;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VolumenFormRequest;
use Illuminate\Support\Facades\DB;

class VolumenController extends Controller
{

    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){
            //Trim quita los espacios
                $query=trim($request->get('texto'));
                $volumenes = DB::table('volumenes')->where('volumen','LIKE','%'.$query.'%')
                ->where('estatus','=','1')
                ->orderBy('id_volumen','asc')
                ->paginate(5);
                return view ('materiales.volumen.index',["volumen"=>$volumenes,"texto"=>$query]);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materiales.volumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VolumenFormRequest $request)
    {
        $volumen= new Volumen;
        $volumen->volumen=$request->get('volumen');
        $volumen->estatus='1';
        $volumen->save();
        return Redirect::to('materiales/volumen');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_volumen)
    {
        return view ("materiales.volumen.show",["volumen"=>Volumen::findOrFail($id_volumen)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_volumen)
    {
        return view ("materiales.volumen.edit",["volumen"=>Volumen::findOrFail($id_volumen)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VolumenFormRequest $request, $id_volumen)
    {
        $volumen=Volumen::findOrFail($id_volumen);
        $volumen->volumen=$request->get('volumen');
        $volumen->update();
        return Redirect::to('materiales/volumen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_volumen)
    {
        $volumen=Volumen::findOrFail($id_volumen);
        $volumen->estatus='0';
        $volumen->update();
        return redirect()->route('volumen.index')
        ->with('succes','Volumen eliminado correctamente');

    }
}
