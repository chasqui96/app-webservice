<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


///------ESPECIALIDADES--------------------------
Route::get('/Listar', [App\Http\Controllers\EspecialidadController::class, 'index'])->name('especialidades.index')->middleware('auth');
Route::get('/MostrarEspe', [App\Http\Controllers\EspecialidadController::class, 'create'])->name('especialidades.create');
Route::post('/GuardarEspe', [App\Http\Controllers\EspecialidadController::class, 'store'])->name('especialidades.store');
Route::get('/Editar/{id}', [App\Http\Controllers\EspecialidadController::class, 'edit'])->name('especialidades.edit');
Route::get('/EditarEspe/{id}', [App\Http\Controllers\EspecialidadController::class, 'update'])->name('especialidades.update');
Route::get('/EliminarEspe/{id}', [App\Http\Controllers\EspecialidadController::class, 'destroy'])->name('especialidades.destroy');

/// ------PACIENTES-----------------------------
Route::get('/ListarPacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('pacientes.index');
Route::get('/MostrarPacientes', [App\Http\Controllers\PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/GuardarPacientes', [App\Http\Controllers\PacienteController::class, 'store'])->name('pacientes.store');
Route::get('/FormularioEditarPaciente/{id}', [App\Http\Controllers\PacienteController::class, 'edit'])->name('pacientes.edit');
Route::get('/EditarPersonales/{id}', [App\Http\Controllers\PacienteController::class, 'update'])->name('pacientes.update');
Route::get('/EliminarPacientes/{id}', [App\Http\Controllers\PacienteController::class, 'destroy'])->name('pacientes.destroy');
Route::get('/CambiarEstadoPacientes/{id}', [App\Http\Controllers\PacienteController::class, 'cambiarEstado'])->name('pacientes.cambiar');


/// ------PERSONALES-----------------------------
Route::get('/ListarPersonales', [App\Http\Controllers\PersonalController::class, 'index'])->name('personales.index');
Route::get('/MostrarPersonales', [App\Http\Controllers\PersonalController::class, 'create'])->name('personales.create');
Route::post('/GuardarPersonales', [App\Http\Controllers\PersonalController::class, 'store'])->name('personales.store');
Route::get('/FormularioEditarPersonal/{id}', [App\Http\Controllers\PersonalController::class, 'edit'])->name('personales.edit');
Route::get('/EditarPersonales/{id}', [App\Http\Controllers\PersonalController::class, 'update'])->name('personales.update');
Route::get('/EliminarPersonales/{id}', [App\Http\Controllers\PersonalController::class, 'destroy'])->name('personales.destroy');
Route::get('/CambiarEstadoPersonales/{id}', [App\Http\Controllers\PersonalController::class, 'cambiarEstado'])->name('personales.cambiar');


///Route::resource('especialidades', App\Http\Controllers\EspecialidadController::class);


