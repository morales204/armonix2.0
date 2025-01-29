<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ReactivoController;

use App\Http\Controllers\VolumenController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BackupController;

use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\CursosListController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\MetronomoController;
use App\Http\Controllers\publicidadController;
use App\Http\Controllers\ServicioInstrumentoController;
use App\Http\Controllers\ServicioController;


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


Route::resource('reactivos/familia', FamiliaController::class)->middleware('auth', 'role:Laboratorista');
Route::resource('reactivos/reactivo', ReactivoController::class)->middleware('auth', 'role:Laboratorista');


Route::resource('materiales/volumen', VolumenController::class)->middleware('auth', 'role:Laboratorista');
Route::resource('materiales/material', MaterialController::class)->middleware('auth', 'role:Laboratorista');

Route::resource('usuarios/usuario', UsuarioController::class)->middleware('auth', 'role:Laboratorista');

Route::resource('backup/respaldo', BackupController::class)->middleware('auth', 'role:Laboratorista');
Route::get('/respaldo/download/{filename}', [BackupController::class, 'download'])->name('download');

Route::resource('prestamos/prestamo', PrestamoController::class);
// Ruta personalizada para aceptar un préstamo
Route::put('prestamos/prestamo/{prestamo}/aceptar/{correo}', [PrestamoController::class, 'aceptarPrestamo'])->name('prestamo.aceptarPrestamo');
Route::put('prestamos/prestamo/{prestamo}/rechazar/{correo}', [PrestamoController::class, 'rechazarPrestamo'])->name('prestamo.rechazarPrestamo');

Route::get('prestamos/pdf', [App\Http\Controllers\PrestamoController::class, 'pdf'])->name('prestamos.pdf');
Route::get('prestamos/historial', [App\Http\Controllers\PrestamoController::class, 'historial'])->name('prestamo.historial');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cursos', function () {
    return view('cursos.cursos');
});

Route::get('/viento', function () {
    return view('instrumentos.viento.viento');
});

Route::get('/acordeon', function () {
    return view('instrumentos.viento.acordeon.acordeon');
});

Route::get('/trompeta', function () {
    return view('instrumentos.viento.trompeta.trompeta');
});

Route::get('/tuba', function () {
    return view('instrumentos.viento.tuba.tuba');
});

//idiofonos
Route::get('/idiofonos', function () {
    return view('instrumentos.idiofonos.idiofonos');
});

Route::get('/xilofono', function () {
    return view('instrumentos.idiofonos.xilofono.xilofono');
});

Route::get('/castañuela', function () {
    return view('instrumentos.idiofonos.castañuela.castañuela');
});

Route::get('/campana', function () {
    return view('instrumentos.idiofonos.campana.campana');
});


Route::resource('cursos/miscursos', CursosController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('cursos/cursoslist', CursosListController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('herramientas/nota', NotaController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('herramientas/metronomo', MetronomoController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('servicios/rentaInstrumento', ServicioInstrumentoController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('servicios/rentaServicio', ServicioController::class)->middleware('auth', 'role:ClienteFree');

Route::resource('servicios/publicidad', publicidadController::class)->middleware('auth', 'role:ClienteFree');

