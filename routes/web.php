<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ReactivoController;

use App\Http\Controllers\VolumenController;
use App\Http\Controllers\MaterialController;

use App\Http\Controllers\PrestamoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('rol','RolController');

Route::resource('reactivos/familia', FamiliaController::class)->middleware('auth', 'role:Laboratorista');;
Route::resource('reactivos/reactivo', ReactivoController::class)->middleware('auth', 'role:Laboratorista');;


Route::resource('materiales/volumen', VolumenController::class)->middleware('auth', 'role:Laboratorista');;
Route::resource('materiales/material', MaterialController::class)->middleware('auth', 'role:Laboratorista');


Route::resource('prestamos/prestamo', PrestamoController::class);
// Ruta personalizada para aceptar un préstamo
Route::put('prestamos/prestamo/{prestamo}/aceptar', [PrestamoController::class, 'aceptarPrestamo'])->name('prestamo.aceptarPrestamo');
Route::put('prestamos/prestamo/{prestamo}/rechazar', [PrestamoController::class, 'rechazarPrestamo'])->name('prestamo.rechazarPrestamo');

Route::get('prestamos/pdf', [App\Http\Controllers\PrestamoController::class, 'pdf'])->name('prestamos.pdf');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
