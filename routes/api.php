<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/// ------LOGIN-----------------------------
Route::get('/login', [App\Http\Controllers\PersonalController::class, 'vistaLogin'])->name('login');

Route::post("/loguear", "App\Http\Controllers\PersonalController@loguear")->name('logueo');;
///------ESPECIALIDADES--------------------------
Route::get('/Listar', [App\Http\Controllers\EspecialidadController::class, 'index'])->name('especialidades.index');//->middleware('auth');
Route::get('/MostrarEspe', [App\Http\Controllers\EspecialidadController::class, 'create'])->name('especialidades.create');
Route::post('/GuardarEspe', [App\Http\Controllers\EspecialidadController::class, 'store'])->name('especialidades.store');
Route::get('/Editar/{id}', [App\Http\Controllers\EspecialidadController::class, 'edit'])->name('especialidades.edit');
Route::post('/EditarEspe/editar', [App\Http\Controllers\EspecialidadController::class, 'update'])->name('especialidades.update');
Route::post('/EliminarEspe/eliminar', [App\Http\Controllers\EspecialidadController::class, 'destroy'])->name('especialidades.destroy');


/// ------PACIENTES-----------------------------
Route::get('/ListarPacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('pacientes.index');
Route::get('/MostrarPacientes', [App\Http\Controllers\PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/GuardarPacientes', [App\Http\Controllers\PacienteController::class, 'store'])->name('pacientes.store');
Route::get('/FormularioEditarPaciente/{id}', [App\Http\Controllers\PacienteController::class, 'edit'])->name('pacientes.edit');
Route::post('/EditarPacientes/editar', [App\Http\Controllers\PacienteController::class, 'update'])->name('pacientes.update');
Route::get('/EliminarPacientes/{id}', [App\Http\Controllers\PacienteController::class, 'destroy'])->name('pacientes.destroy');
Route::post('/CambiarEstadoPacientes', [App\Http\Controllers\PacienteController::class, 'cambiarEstado'])->name('pacientes.cambiar');


/// ------PERSONALES-----------------------------
Route::get('/ListarPersonales', [App\Http\Controllers\PersonalController::class, 'index'])->name('personales.index');
Route::get('/MostrarPersonales', [App\Http\Controllers\PersonalController::class, 'create'])->name('personales.create');
Route::post('/GuardarPersonales', [App\Http\Controllers\PersonalController::class, 'store'])->name('personales.store');
Route::get('/FormularioEditarPersonal/{id}', [App\Http\Controllers\PersonalController::class, 'edit'])->name('personales.edit');
Route::post('/EditarPersonales/editar', [App\Http\Controllers\PersonalController::class, 'update'])->name('personales.update');
Route::delete('/EliminarPersonales/{id}', [App\Http\Controllers\PersonalController::class, 'destroy'])->name('personales.destroy');
Route::post('/CambiarEstadoPersonales', [App\Http\Controllers\PersonalController::class, 'cambiarEstado'])->name('personales.cambiar');

/// ------AGENDAMIENTO-CUPOS-----------------------------
Route::get('/ListarAgendamiento', [App\Http\Controllers\AgendamientoController::class, 'index'])->name('agendamientos.index');
Route::get('/ListarCupos', [App\Http\Controllers\AgendamientoController::class, 'listarCupos'])->name('agendamiento.index');
Route::get('/ListarDoctor', [App\Http\Controllers\PersonalController::class, 'listarDoctor'])->name('personals.doctor');
Route::post('/GuardarAgendamiento', [App\Http\Controllers\AgendamientoController::class, 'store'])->name('agendamiento.store');
Route::post('/GuardarReserva', [App\Http\Controllers\AgendamientoController::class, 'guardarReserva'])->name('reserva.store');
Route::get('/Agendamientos/cupos/{id}', [App\Http\Controllers\AgendamientoController::class, 'cupos'])->name('cupos.get');
Route::get('/ListarReservas', [App\Http\Controllers\AgendamientoController::class, 'listarReservas'])->name('reservas.get');
Route::post('/AnularReserva', [App\Http\Controllers\AgendamientoController::class, 'anularReservas'])->name('anular.get');