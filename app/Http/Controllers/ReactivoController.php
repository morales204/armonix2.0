<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

//Invocamos al modelo
use App\Models\Reactivo;
use App\Http\Requests\ReactivoFormRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;




class ReactivoController extends Controller
{

    public function __construct(){

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
            //Trim quita los espacios
            $query=trim($request->get('texto'));
            $reactivos = DB::table('reactivos as r')
            ->join('familias as f', 'r.familias_id_familia','=','id_familia')
            ->join('nivel_peligrosidad as n', 'r.nivel_peligrosidad_id_nivel_peligrosidad','=','id_nivel_peligrosidad')
            ->join('condiciones_almacenamiento as c', 'r.condiciones_almacenamiento_id_condiciones_almacenamiento','=','id_condiciones_almacenamiento')
            ->select('r.id_reactivo','r.nombre_reactivo','r.cantidad_disponible','r.hoja_seguridad','r.nomenclatura',
            'r.fecha_adquisicion','r.fecha_caducidad','f.tipo','n.descripcion','c.condiciones','r.estatus')
            ->where('nombre_reactivo','LIKE','%'.$query.'%')
/*             ->where ('cantidad_disponible','>','0') */
            ->where('r.estatus','=','1')
            ->orderBy('id_reactivo','desc')
            ->paginate(7);
            return view ('reactivos.reactivo.index',["reactivo"=>$reactivos,"texto"=>$query]);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reactivo=Reactivo::all();

        $familias=DB::table('familias as f')
        ->select('id_familia','f.tipo')
        ->where('f.estatus', '=','1')
        ->get();

        $nivel_peligrosidad=DB::table('nivel_peligrosidad as n')
        ->select('id_nivel_peligrosidad','n.descripcion')
        ->get();

        $condiciones_almacenamiento=DB::table('condiciones_almacenamiento as c')
        ->select('id_condiciones_almacenamiento','c.condiciones')
        ->get();

        return view('reactivos.reactivo.create',["reactivo"=>$reactivo,"familias"=>$familias,"nivel_peligrosidad"=>$nivel_peligrosidad,"condiciones_almacenamiento"=>$condiciones_almacenamiento]);

    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(ReactivoFormRequest $request)
    {
        $reactivo= new Reactivo;
        $reactivo->nombre_reactivo=$request->get('nombre_reactivo');
        $reactivo->cantidad_disponible=$request->get('cantidad_disponible');
        $reactivo->nomenclatura=$request->get('nomenclatura');
        $reactivo->fecha_adquisicion=$request->get('fecha_adquisicion');
        $reactivo->fecha_caducidad=$request->get('fecha_caducidad');
        $reactivo->familias_id_familia=$request->get('familias_id_familia');
        $reactivo->nivel_peligrosidad_id_nivel_peligrosidad=$request->get('nivel_peligrosidad_id_nivel_peligrosidad');
        $reactivo->condiciones_almacenamiento_id_condiciones_almacenamiento=$request->get('condiciones_almacenamiento_id_condiciones_almacenamiento');
        $reactivo->estatus='1';

        //Script para subir la imagen

        if ($request->hasFile("hoja_seguridad")) {
            $hoja_seguridad = $request->file("hoja_seguridad");
            $nombreHoja = Str::slug($request->nombre_reactivo) . "." . $hoja_seguridad->getClientOriginalExtension();
            $ruta = public_path("/pdf/reactivos/");
    
            // Mueve el archivo PDF a la ubicación deseada
            $hoja_seguridad->move($ruta, $nombreHoja);
    
            // Guarda el nombre del archivo en la base de datos
            $reactivo->hoja_seguridad = $nombreHoja;
        }
    
        
        $reactivo->save();
        return redirect()->route('reactivo.index')->with('success', 'Reactivo agregado exitosamente');
        /* return Redirect::to('reactivo'); */
    }

    /**
     * Display the specified resource.
     */
    public function show($id_reactivo)
    {
        return view ("reactivo.show",["reactivo"=>Reactivo::findAll($id_reactivo)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_reactivo)
    {
        $reactivo = Reactivo::findOrFail($id_reactivo);
        $familias=DB::table('familias as f')
        ->select('id_familia','f.tipo')
        ->where('f.estatus', '=','1')
        ->get();

        $nivel_peligrosidad=DB::table('nivel_peligrosidad as n')
        ->select('id_nivel_peligrosidad','n.descripcion')
        ->get();

        $condiciones_almacenamiento=DB::table('condiciones_almacenamiento as c')
        ->select('id_condiciones_almacenamiento','c.condiciones')
        ->get();
    
        return view ("reactivos.reactivo.edit",[
        "reactivo"=>$reactivo,
        "familias"=>$familias,
        "nivel_peligrosidad"=>$nivel_peligrosidad,
        'condiciones_almacenamiento'=>$condiciones_almacenamiento]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReactivoFormRequest $request, $id_reactivo)
    {
        
        $reactivo= Reactivo::findOrFail($id_reactivo);
        $reactivo->nombre_reactivo=$request->input('nombre_reactivo');
        $reactivo->cantidad_disponible=$request->input('cantidad_disponible');
        $reactivo->nomenclatura=$request->input('nomenclatura');
        $reactivo->fecha_adquisicion=$request->input('fecha_adquisicion');
        $reactivo->fecha_caducidad=$request->input('fecha_caducidad');
        $reactivo->familias_id_familia=$request->input('familias_id_familia');
        $reactivo->nivel_peligrosidad_id_nivel_peligrosidad=$request->input('nivel_peligrosidad_id_nivel_peligrosidad');
        $reactivo->condiciones_almacenamiento_id_condiciones_almacenamiento=$request->input('condiciones_almacenamiento_id_condiciones_almacenamiento');

        if ($request->hasFile("hoja_seguridad")) {
            $hoja_seguridad = $request->file("hoja_seguridad");
            $nombreHoja = Str::slug($request->nombre_reactivo) . "." . $hoja_seguridad->getClientOriginalExtension();
            $ruta = public_path("/pdf/reactivos/");
    
            // Mueve el archivo PDF a la ubicación deseada
            $hoja_seguridad->move($ruta, $nombreHoja);
    
            // Guarda el nombre del archivo en la base de datos
            $reactivo->hoja_seguridad = $nombreHoja;
        }

        $reactivo->update();
        return redirect()->route('reactivo.index')->with('success', 'Reactivo modificado exitosamente');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_reactivo)
    {
        try {
            $reactivo=Reactivo::findOrFail($id_reactivo);
            $reactivo->estatus='0';
            $reactivo->update();
            return redirect()->route('reactivo.index')->with('success', 'Reactivo eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('reactivo.index')->with('error', 'Ocurrió un error al intentar eliminar el reactivo');
        }
    }
}
