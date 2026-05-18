<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\ConsultaController;

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/consultas/create', [ConsultaController::class, 'create'])->name('consultas.create');
    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
});

use App\Http\Controllers\MascotaController;


Route::get('/mascotas/{mascota}', [MascotaController::class, 'show'])
    ->name('mascotas.show');

use App\Http\Controllers\BusquedaController;

Route::get('/buscar/propietarios', [BusquedaController::class, 'propietarios']);
Route::get('/buscar/mascotas', [BusquedaController::class, 'mascotas']);

Route::middleware(['auth'])->group(function () {

    Route::resource('consultas', ConsultaController::class);

    Route::patch('/consultas/{consulta}/estatus', [ConsultaController::class, 'updateEstatus'])
        ->name('consultas.estatus');

});


use App\Http\Controllers\BiometriaHematicaController;

Route::get('consultas/{consulta}/biometria', [BiometriaHematicaController::class, 'create'])
    ->name('biometrias.create');

Route::post('consultas/{consulta}/biometria', [BiometriaHematicaController::class, 'store'])
    ->name('biometrias.store');

Route::get('consultas/{consulta}/biometria/ver', [BiometriaHematicaController::class, 'show'])
    ->name('biometrias.show');

Route::get('consultas/{consulta}/biometria/editar', [BiometriaHematicaController::class, 'edit'])
    ->name('biometrias.edit');

Route::delete('consultas/{consulta}/biometria', [BiometriaHematicaController::class, 'destroy'])
    ->name('biometrias.destroy');

Route::put(
    'consultas/{consulta}/biometria',
    [BiometriaHematicaController::class, 'update']
)->name('biometrias.update');

Route::get(
    'consultas/{consulta}/biometria/pdf',
    [BiometriaHematicaController::class, 'pdf']
)->name('biometrias.pdf');


use App\Http\Controllers\QuimicaController;

Route::get('consultas/{consulta}/quimica', [QuimicaController::class, 'create'])
    ->name('quimica.create');

Route::post('consultas/{consulta}/quimica', [QuimicaController::class, 'store'])
    ->name('quimica.store');

Route::get('consultas/{consulta}/quimica/ver', [QuimicaController::class, 'show'])
    ->name('quimica.show');

Route::get('consultas/{consulta}/quimica/editar', [QuimicaController::class, 'edit'])
    ->name('quimica.edit');

Route::delete('consultas/{consulta}/quimica', [QuimicaController::class, 'destroy'])
    ->name('quimica.destroy');

Route::put(
    'consultas/{consulta}/quimica',
    [QuimicaController::class, 'update']
)->name('quimica.update');

Route::get(
    'consultas/{consulta}/quimica/pdf',
    [QuimicaController::class, 'pdf']
)->name('quimica.pdf');


use App\Http\Controllers\EsterilizacionController;

Route::get('/esterilizaciones', [EsterilizacionController::class, 'index'])
    ->name('esterilizaciones.index');

Route::get('/esterilizaciones/create', [EsterilizacionController::class, 'create'])
    ->name('esterilizaciones.create');

Route::post('/esterilizaciones', [EsterilizacionController::class, 'store'])
    ->name('esterilizaciones.store');

Route::get('/esterilizaciones/{esterilizacion}/pdf', [EsterilizacionController::class, 'pdf'])
    ->name('esterilizaciones.pdf');

Route::delete('/esterilizaciones/{esterilizacion}', [EsterilizacionController::class, 'destroy'])
    ->name('esterilizaciones.destroy');

Route::get('/esterilizaciones/buscar', [EsterilizacionController::class, 'buscar'])
    ->name('esterilizaciones.buscar');

Route::get('/esterilizaciones/mascotas/{propietario}', [EsterilizacionController::class, 'mascotas'])
    ->name('esterilizaciones.mascotas');

Route::get('/esterilizaciones/{esterilizacion}', [EsterilizacionController::class, 'show'])
    ->name('esterilizaciones.show');


Route::get('/esterilizaciones/create/{mascota}', [EsterilizacionController::class, 'form'])
    ->name('esterilizaciones.form');

use App\Http\Controllers\PacienteController;

Route::resource('pacientes', PacienteController::class);

use App\Models\Mascota;

Route::get('/propietarios/{id}/mascotas', function ($id) {
    return response()->json(
        Mascota::where('propietario_id', $id)->get()
    );
});