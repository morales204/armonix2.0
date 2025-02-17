<?php

namespace App\Http\Controllers;

use App\Models\Catalog;

class CatalogController extends Controller
{
    public function index()
{
    $catalogs = Catalog::all(); 
    return view('layouts.admin', compact('catalogs'));
}

}
