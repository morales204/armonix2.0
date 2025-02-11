<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioFormRequest;
use App\Models\DatosMateria;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VolumenFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->roles_id_rol !== 1) {
            return Redirect::route('home');
        }
        
        if($request){
            $query=trim($request->get('texto'));
            $usuarios = DB::table('usuarios as u')
            ->join('roles as r', 'u.roles_id_rol','=','id_rol')
            ->select('u.id_usuario','u.nombre_completo','u.telefono','u.correo','u.username','r.rol')
            ->where('u.nombre_completo' , 'LIKE',$query.'%')//modifique el '%' antes del query para que busque solo los iguales
            //->groupBy('m.id_material')
            ->orderBy('u.nombre_completo','desc')
            ->paginate(10);
            return view('usuarios.index',['usuarios'=>$usuarios,'texto'=>$query]);
        }
    
    }

    public function create()
    {
        //$volumenes=DB::table('volumenes')->get();
        $usuario=Usuario::all();
        $roles=DB::table('roles as r')
        ->select('r.id_rol','r.rol')
        ->get();
        return view('usuarios.create',["usuarios"=>$usuario,"roles"=>$roles]);
    }

    public function store(Request $request){
        $request->validate([
            'nombre_completo' => ['required', 'string','regex:/^[a-zA-ZáéíóúÁÉÍÓÚ-ñ\s]+$/u','min:10','max:80'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'correo' => ['required', 'string', 'email', 'max:100', 'unique:usuarios'],
            'username' => ['required', 'string', 'max:30'],
            'roles_id_rol' => ['required'],
            'password' => ['required', 'string', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/' ,'confirmed'],
        ],[
            'password.regex' => 'El campo contraseña debe contener al menos: un caracter especial, una letra mayuscula, una letra minuscula y un numero',
            // se pueden agregar mensajes personalizafos de esta manera
        ]);

        Usuario::create([
            'nombre_completo' => $request->nombre_completo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'username' => $request->username,
            'roles_id_rol' => $request->roles_id_rol,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario registrado exitosamente');
    }
    
    //Funcion para editar un usuario
    public function edit($id_usuario)
    {
        $usuario=Usuario::findOrFail($id_usuario);
        $roles=DB::table('roles as r')
        ->select('r.id_rol','r.rol')
        ->get();
        return view ("usuarios.edit",['usuario'=>$usuario,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioFormRequest $request, $id_usuario)
    {
        
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->nombre_completo=$request->input('nombre_completo');
        $usuario->telefono=$request->input('telefono');
        $usuario->correo=$request->input('correo');
        $usuario->username=$request->input('username');
        $usuario->roles_id_rol=$request->input('roles_id_rol');
        $usuario->password=Hash::make($request->input('password'));
        $usuario->update();

        return redirect()->route('usuario.index')->with('success', 'Usuario modificado exitosamente');

    }


    public function destroy($id_usuario)
    {
        $datos_materia_ids = DB::table('datos_materia as dm')
        ->join('prestamos as p', 'p.datos_materia_id_datos_materia', '=', 'dm.id_datos_materia')
        ->where('p.usuarios_id_usuario', '=', $id_usuario)
        ->pluck('dm.id_datos_materia'); // Utiliza pluck() para obtener una matriz de IDs

        DB::table('datos_materia')->whereIn('id_datos_materia', $datos_materia_ids)->delete();
        
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente');
    }


}
