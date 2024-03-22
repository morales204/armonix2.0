<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

use App\Http\Requests\MaterialFormRequest;
use App\Models\Material;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;



class MaterialController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->roles_id_rol !== 1) {
            return Redirect::route('home');
        }
        
        if($request){
            $query=trim($request->get('texto'));
            $materiales = DB::table('materiales as m')
            ->join('volumenes as v', 'm.volumenes_id_volumen','=','id_volumen')
            ->select('m.id_material','m.nombre_material','m.cantidad_disponible','m.descripcion','v.volumen')
            ->where('m.nombre_material' , 'LIKE',$query.'%')//modifique el '%' antes del query para que busque solo los iguales
            //->groupBy('m.id_material')
            ->orderBy('m.nombre_material','desc')
            ->paginate(5);
            return view('materiales.material.index',['material'=>$materiales,'texto'=>$query]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$volumenes=DB::table('volumenes')->get();
        $material=Material::all();
        $volumenes=DB::table('volumenes as v')
        ->select('id_volumen','v.volumen')
        ->where('v.estatus', '=','1')
        ->get();
        return view('materiales.material.create',["materiales"=>$material,"volumenes"=>$volumenes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $material= new Material;
            $material-> nombre_material=$request->get('nombre_material');
            $material-> cantidad_disponible=$request->get('cantidad_disponible');
            $material-> descripcion=$request->get('descripcion');
            $material-> volumenes_id_volumen=$request->get('volumenes_id_volumen');
            $material->save();

            return Redirect::to('materiales/material');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_material)
    {
        return view ("material.show",["material"=>Material::findAll($id_material)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_material)
    {
        $material=Material::findOrFail($id_material);
        $volumenes=DB::table('volumenes')->where('estatus','=','1')->get();
        return view ("materiales.material.edit",['material'=>$material,'volumenes'=>$volumenes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialFormRequest $request, $id_material)
    {
        $material = Material::findOrFail($id_material);
        $material->nombre_material=$request->input('nombre_material');
        $material->cantidad_disponible=$request->input('cantidad_disponible');
        $material->descripcion=$request->input('descripcion');
        $material->volumenes_id_volumen=$request->input('volumenes_id_volumen');
        $material->update();

        return redirect()->route('material.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_material)
    {
        $material = Material::findOrFail($id_material);
        $material->delete();
    
        return redirect()->route('material.index')->with('success', 'Material eliminado correctamente');
    }
}
