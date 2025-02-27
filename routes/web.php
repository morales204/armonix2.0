<?php

use App\Http\Controllers\AcordeonController;
use App\Http\Controllers\AddCursosListController;
use App\Http\Controllers\AddCursosController;
use App\Http\Controllers\AdminUsuariosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ReactivoController;
use App\Http\Controllers\InstrumentTypeController;
use App\Http\Controllers\InstrumentController;

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
use App\Http\Controllers\InstrumentosController;
use App\Http\Controllers\InstrumentosVientoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\MetronomoController;
use App\Http\Controllers\publicidadController;
use App\Http\Controllers\ServicioInstrumentoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TrompetaController;
use App\Http\Controllers\TubaController;
use App\Http\Controllers\XilofonoController;
use App\Http\Controllers\notasPremium;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MetronomoPremiumController;
use App\Http\Controllers\NotasPremiumController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CourseContentController;





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
Route::get('/notas-premium/{id}', [NotasPremiumController::class, 'show'])->name('notas-premium.show');


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

// Ruta Home (Protegida)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Rutas de Cursos (Protegidas por autenticación y roles)
Route::resource('cursos/miscursos', CursosController::class)->middleware(['auth', 'role:2|3']);
Route::resource('cursos/cursoslist', CursosListController::class)->middleware(['auth', 'role:2|3']);
Route::resource('cursos/instrumentos', InstrumentosController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/acordeon', InstrumentosVientoController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/idiofono', IdiofonosController::class)->middleware(['auth', 'role:1|2']);

// Rutas de herramientas (Protegidas por autenticación y roles)
Route::resource('herramientas/nota', NotaController::class)->middleware(['auth', 'role:2']);
Route::resource('herramientas/metronomo', MetronomoController::class)->middleware(['auth', 'role:2']);
Route::resource('userP/herramientas/metronomoP', MetronomoPremiumController::class)->middleware(['auth', 'role:1']);

// Rutas de Servicios (Protegidas por autenticación y roles)
Route::resource('servicios/rentaInstrumento', ServicioInstrumentoController::class)->middleware(['auth', 'role:2|3']);
Route::resource('servicios/rentaServicio', ServicioController::class)->middleware(['auth', 'role:2|3']);
Route::resource('servicios/publicidad', PublicidadController::class)->middleware(['auth', 'role:1']);
Route::resource('servicios/publicidad', PublicidadController::class)->middleware(['auth', 'role:2']);

// Rutas de Viento e Instrumentos (Protegidas por autenticación y roles)
Route::resource('viento/acordeon', AcordeonController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/trompeta', TrompetaController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/tuba', TubaController::class)->middleware(['auth', 'role:4']);

// Rutas de Idiófono (Protegidas por autenticación y roles)
Route::resource('idiofono/campana', CampanaController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/castañuela', CastañuelaController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/xilofono', XilofonoController::class)->middleware(['auth', 'role:1']);

// Rutas de Usuarios (Protegidas por autenticación y roles)
Route::resource('agregar/usuario', UsuariosController::class)->middleware(['auth', 'role:1']);
Route::resource('gestionar/usuario', AdminUsuariosController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/cursoslistAdd', AddCursosListController::class)->middleware(['auth', 'role:1']);

// Rutas Premium (Protegidas por autenticación y roles)
Route::resource('notaP', NotasPremiumController::class)->middleware(['auth', 'role:3']);
Route::resource('notas-premium', NotasPremiumController::class)->middleware('auth');

// Rutas de Cursos Agregar y Administración (Protegidas por autenticación y roles)
Route::get('/admin/cursos/agregar', [AddCursosController::class, 'index'])->name('cursos.agregar')->middleware(['auth', 'role:1']);
Route::post('/admin/cursos', [AddCursosController::class, 'store'])->name('cursos.store')->middleware(['auth', 'role:1']);
Route::get('/admin/cursos', [AddCursosController::class, 'cursosList'])->name('admin.cursos.cursoslist')->middleware(['auth', 'role:1']);

// Rutas de Contenido de Cursos (Protegidas por autenticación y roles)
Route::get('/courses/{courseId}/contents', [CourseContentController::class, 'index'])->middleware('auth');
Route::post('/contents', [CourseContentController::class, 'store'])->middleware('auth');
Route::get('/contents/{id}', [CourseContentController::class, 'show'])->middleware('auth');
Route::get('/cursos/{id}/edit', [CourseContentController::class, 'edit'])->name('cursos.edit')->middleware('auth');
Route::put('/cursos/{id}', [CourseContentController::class, 'update'])->name('cursos.update')->middleware('auth');
Route::delete('/cursos/{id}', [CourseContentController::class, 'destroy'])->name('cursos.destroy')->middleware('auth');

// Rutas de Instrumentos y Cursos (Protegidas por autenticación)
Route::get('/cursos/{courseId}/detalles', [CourseContentController::class, 'showContents'])->name('course.contents')->middleware('auth');
Route::get('/cursos/{id}/contents', [CourseContentController::class, 'showContents'])->name('cursos.contents')->middleware('auth');

// Otras Rutas Públicas
Route::get('/cursos/instrumentos', [InstrumentTypeController::class, 'index'])->name('instrumentos.index');
Route::get('/cursos/{id}', [InstrumentController::class, 'show'])->name('instrumento.detalles');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/instruments/{id}/courses', [InstrumentController::class, 'courses'])->name('instrument.courses');
Route::get('/cursos/instrumentos/viento/acordeon', [InstrumentController::class, 'showAcordeon'])->name('instrument.acordeon');
Route::get('/instrumentos', [InstrumentTypeController::class, 'index'])->name('instrument-types.index');
Route::get('/instrumentos/{slug}', [InstrumentTypeController::class, 'show'])->name('instrument-types.show');
Route::get('/buscar', [SearchController::class, 'search'])->name('buscar');
Route::get('/search', [SearchController::class, 'globalSearch'])->name('search.global');
Route::get('/dashboard', [CatalogController::class, 'index'])->name('dashboard');
Route::get('/catalog/{catalog}/instrument_types', [CatalogController::class, 'showInstrumentTypes'])->name('catalog.instrument_types');
Route::get('/course/contents/{courseId}', [CourseContentController::class, 'showContents'])->name('course.contents');
Route::get('/instrumentos/viento/{id}', [InstrumentController::class, 'show'])->name('instrumentos.viento');
Route::get('/cargar-mas-cursos', [InstrumentController::class, 'cargarMasCursos'])->name('cargar.mas.cursos');
Route::get('/instrumentos/{id}', [InstrumentController::class, 'show'])->name('instruments.show');