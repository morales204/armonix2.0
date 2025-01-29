<?php

use App\Http\Controllers\AcordeonController;
use App\Http\Controllers\AddCursosController;
use App\Http\Controllers\AddCursosListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ReactivoController;

use App\Http\Controllers\VolumenController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CampanaController;
use App\Http\Controllers\CastañuelaController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\CursosListController;
use App\Http\Controllers\IdiofonosController;
use App\Http\Controllers\InstrumentosVientoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\MetronomoController;
use App\Http\Controllers\ServicioInstrumentoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TrompetaController;
use App\Http\Controllers\TubaController;
use App\Http\Controllers\XilofonoController;
use Illuminate\Support\Facades\Auth;


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


Route::resource('cursos/miscursos', CursosController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('cursos/cursoslist', CursosListController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('herramientas/nota', NotaController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('herramientas/metronomo', MetronomoController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('servicios/rentaInstrumento', ServicioInstrumentoController::class)->middleware('auth', 'role:ClienteFree');
Route::resource('servicios/rentaServicio', ServicioController::class)->middleware('auth', 'role:ClienteFree');

Route::resource('cursos/agregarcurso', AddCursosController::class)->middleware('auth', 'role:Admin');
Route::resource('cursos/cursoslistAdd', AddCursosListController::class)->middleware('auth', 'role:Admin');
Route::resource('cursos/acordeon', InstrumentosVientoController::class)->middleware('auth', 'role:Admin');
Route::resource('viento/acordeon', AcordeonController::class)->middleware('auth', 'role:Admin');
Route::resource('viento/trompeta', TrompetaController::class)->middleware('auth', 'role:Admin');
Route::resource('viento/tuba', TubaController::class)->middleware('auth', 'role:Admin');


Route::resource('cursos/idiofono', IdiofonosController::class)->middleware('auth', 'role:Admin');
Route::resource('idiofono/campana', CampanaController::class)->middleware('auth', 'role:Admin');
Route::resource('idiofono/castañuela', CastañuelaController::class)->middleware('auth', 'role:Admin');
Route::resource('idiofono/xilofono', XilofonoController::class)->middleware('auth', 'role:Admin');

Route::get('/409', function () {
    return view('errors.409');
});