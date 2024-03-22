<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Familia;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\FamiliaFormRequest;
use Illuminate\Support\Facades\DB;

class FamiliaController extends Controller
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
        if ($request){
        //Trim quita los espacios
            $query=trim($request->get('texto'));
            $familias = DB::table('familias')->where('tipo','LIKE','%'.$query.'%')
            ->where('estatus','=','1')
            ->orderBy('tipo','desc')
            ->paginate(5);
            return view ('reactivos.familia.index',["familia"=>$familias,"texto"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reactivos.familia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FamiliaFormRequest $request)
    {
        $familia= new Familia;
        $familia->tipo=$request->get('tipo');
        $familia->estatus='1';
        $familia->save();
        return Redirect::to('reactivos/familia');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_familia)
    {
        return view ("reactivos.familia.show",["familia"=>Familia::findOrFail($id_familia)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_familia)
    {
        return view ("reactivos.familia.edit",["familia"=>Familia::findOrFail($id_familia)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FamiliaFormRequest $request, $id_familia)
    {
        $familia=Familia::findOrFail($id_familia);
        $familia->tipo=$request->get('tipo');
        $familia->update();
        return Redirect::to('reactivos/familia');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_familia)
    {
        $familia=Familia::findOrFail($id_familia);
        $familia->estatus='0';
        $familia->update();
        return redirect()->route('familia.index')
        ->with('succes','Familia eliminada correctamente');

    }
}
