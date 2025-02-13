<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
{
    $catalogs = Catalog::all(); // Asegúrate de usar 'all()' y no 'first()'
    return view('layouts.admin', compact('catalogs'));
}

}