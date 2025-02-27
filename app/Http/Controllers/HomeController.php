<?php

namespace App\Http\Controllers;

use App\Models\InstrumentType;  // Asegúrate de importar el modelo de InstrumentType
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtén los tipos de instrumentos
        $instrumentTypes = InstrumentType::all();  // O la consulta que necesites

        // Pasa la variable a la vista
        return view('home', compact('instrumentTypes'));
    }
}

