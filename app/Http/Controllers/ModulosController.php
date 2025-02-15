<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo; // Asegúrate de que el modelo esté bien referenciado

class ModulosController extends Controller
{
    public function index()
{
    $categories = Modulo::whereNull('parent_id')
        ->get(); // No necesitas cargar las subcategorías por ahora
    
    return view('layouts.admin', compact('categories'));
}
    
}