<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function obtenerMenu()
    {
        // Obtener los módulos con sus submódulos
        $modulos = Modulo::with('submodulos')->get();
        
        // Pasar los módulos a la vista
        return view('menu', compact('modulos'));
    }
}
