<?php

use App\Http\Controllers\AcordeonController;
use App\Http\Controllers\AddCursosController;
use App\Http\Controllers\AddCursosListController;
use App\Http\Controllers\AdminUsuariosController;
use App\Http\Controllers\SecretAnswer;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CampanaController;
use App\Http\Controllers\CastañuelaController;

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

use App\Http\Controllers\PasswordRecoveryController;


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
Route::get('/admin/usuarios', [App\Http\Controllers\BusquedaController::class, 'index'])->name('admin.usuarios');
Route::get('/curso/buscar', [BusquedaController::class, 'buscarCursos'])->middleware('auth')->name('curso.search');
Route::get('/notas/buscar', [BusquedaController::class, 'buscarNotas'])->middleware('auth')->name('notas.search');
Route::get('/notas-premium/show/{id}', [NotasPremiumController::class, 'show'])->middleware('auth')->name('notas-premium.show');
Route::get('/curso/show/{id}', [AddCursosListController::class, 'show'])->middleware('auth')->name('curso.show');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');




/*--------------*/
Route::resource('cursos/miscursos', CursosController::class)->middleware(['auth', 'role:2|3']);
Route::resource('cursos/cursoslist', CursosListController::class)->middleware(['auth', 'role:2|3']);
Route::resource('servicios/rentaInstrumento', ServicioInstrumentoController::class)->middleware(['auth', 'role:2|3']);
Route::resource('servicios/rentaServicio', ServicioController::class)->middleware(['auth', 'role:2|3']);

Route::resource('herramientas/nota', NotaController::class)->middleware(['auth', 'role:2']);
Route::resource('herramientas/metronomo', MetronomoController::class)->middleware(['auth', 'role:2']);

Route::resource('userP/herramientas/metronomoP', MetronomoPremiumController::class)->middleware(['auth', 'role:3']);
Route::resource('notas-premium', NotasPremiumController::class)->middleware(['auth', 'role:3']);
Route::resource('metronomo-p', MetronomoPremiumController::class)->middleware(['auth', 'role:3']);
// Route::resource('notaP', NotasPremiumController::class)->middleware(['auth', 'role:3']);


Route::resource('servicios/publicidad', publicidadController::class)->middleware(['auth', 'role:1']);

Route::resource('cursos/agregarcurso', AddCursosController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/cursoslistAdd', AddCursosListController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/acordeon', InstrumentosVientoController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/acordeon', AcordeonController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/trompeta', TrompetaController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/tuba', TubaController::class)->middleware(['auth', 'role:1']);


Route::resource('cursos/idiofono', IdiofonosController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/campana', CampanaController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/castañuela', CastañuelaController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/xilofono', XilofonoController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/instrumentos', InstrumentosController::class)->middleware(['auth', 'role:1']);

Route::resource('agregar/usuario', UsuariosController::class)->middleware(['auth', 'role:1']);
Route::resource('gestionar/usuario', AdminUsuariosController::class)->middleware(['auth', 'role:1']);

Route::resource('servicios/publicidad', publicidadController::class)->middleware(['auth', 'role:4']);

Route::resource('cursos/agregarcurso', AddCursosController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/cursoslistAdd', AddCursosListController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/acordeon', InstrumentosVientoController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/acordeon', AcordeonController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/trompeta', TrompetaController::class)->middleware(['auth', 'role:1']);
Route::resource('viento/tuba', TubaController::class)->middleware(['auth', 'role:1']);


Route::resource('cursos/idiofono', IdiofonosController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/campana', CampanaController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/castañuela', CastañuelaController::class)->middleware(['auth', 'role:1']);
Route::resource('idiofono/xilofono', XilofonoController::class)->middleware(['auth', 'role:1']);
Route::resource('cursos/instrumentos', InstrumentosController::class)->middleware(['auth', 'role:1']);

Route::resource('agregar/usuario', UsuariosController::class)->middleware(['auth', 'role:1']);
Route::resource('gestionar/usuario', AdminUsuariosController::class)->middleware(['auth', 'role:1']);



Route::get('/verificar-correo', function () {
    return view('auth.recover_password');
    })->name('verificarCorreo');

Route::post('/verificar-correo', [SecretAnswer::class, 'verificarCorreo']);

Route::get('/validar-respuesta', function () {
    return view('auth.answer_question');
    })->middleware('auth')->name('validarRespuesta');

Route::post('/validar-respuesta', [SecretAnswer::class, 'validarRespuesta']);
Route::post('/actualizar-password', [SecretAnswer::class, 'actualizarPassword'])->name('actualizar.password');




Route::get('password/recover-password', [PasswordRecoveryController::class, 'showRecoveryForm'])->name('password.recover-password');
Route::post('password/send-recovery-code', [PasswordRecoveryController::class, 'sendRecoveryCode'])->name('password.sendRecoveryCode');
// Ruta GET para mostrar el formulario de verificación
Route::get('password/verify/{phone}', [PasswordRecoveryController::class, 'showVerifyForm'])
    ->name('password.show_verify_form');

// Ruta POST para verificar el código de recuperación
Route::post('password/verify', [PasswordRecoveryController::class, 'verifyRecoveryCode'])
    ->name('password.verify_code');

Route::get('password/change-password/{user_id}', [PasswordRecoveryController::class, 'showChangePasswordForm'])->name('password.change-password');
Route::post('password/update', [PasswordRecoveryController::class, 'updatePassword'])->name('password.update');

