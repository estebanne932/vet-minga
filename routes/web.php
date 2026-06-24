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



Route::resource('mascotas', MascotaController::class);


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

// Editar/actualizar propietario usando el mismo controlador
Route::get('/propietarios/{propietario}/edit', [PacienteController::class, 'editPropietario'])
    ->name('propietarios.edit');

Route::put('/propietarios/{propietario}', [PacienteController::class, 'updatePropietario'])
    ->name('propietarios.update');

Route::delete('/propietarios/{propietario}', [PacienteController::class, 'destroyPropietario'])
    ->name('propietarios.destroy');

    
use App\Models\Mascota;


Route::get('/propietarios/{id}/mascotas', function ($id) {
    return response()->json(
        Mascota::where('propietario_id', $id)->get()
    );
});

Route::get('/propietarios/{propietario}/mascotas/create',
    [PacienteController::class, 'createMascota'])
    ->name('propietarios.mascotas.create');

Route::post('/propietarios/{propietario}/mascotas',
    [PacienteController::class, 'storeMascota'])
    ->name('propietarios.mascotas.store');


use App\Http\Controllers\EutanasiaController;

Route::get('/eutanasias', [EutanasiaController::class, 'index'])
    ->name('eutanasias.index');

Route::get('/eutanasias/create', [EutanasiaController::class, 'create'])
    ->name('eutanasias.create');

Route::post('/eutanasias', [EutanasiaController::class, 'store'])
    ->name('eutanasias.store');

Route::get('/eutanasias/{eutanasia}/pdf', [EutanasiaController::class, 'pdf'])
    ->name('eutanasias.pdf');

Route::delete('/eutanasias/{eutanasia}', [EutanasiaController::class, 'destroy'])
    ->name('eutanasias.destroy');

Route::get('/eutanasias/buscar', [EutanasiaController::class, 'buscar'])
    ->name('eutanasias.buscar');

Route::get('/eutanasias/mascotas/{propietario}', [EutanasiaController::class, 'mascotas'])
    ->name('eutanasias.mascotas');

Route::get('/eutanasias/{eutanasia}', [EutanasiaController::class, 'show'])
    ->name('eutanasias.show');

Route::get('/eutanasias/create/{mascota}', [EutanasiaController::class, 'form'])
    ->name('eutanasias.form');

    
use App\Http\Controllers\CirugiaController;

Route::get('/cirugias', [CirugiaController::class, 'index'])
    ->name('cirugias.index');

Route::get('/cirugias/create', [CirugiaController::class, 'create'])
    ->name('cirugias.create');

Route::post('/cirugias', [CirugiaController::class, 'store'])
    ->name('cirugias.store');

Route::get('/cirugias/{cirugia}/pdf', [CirugiaController::class, 'pdf'])
    ->name('cirugias.pdf');

Route::delete('/cirugias/{cirugia}', [CirugiaController::class, 'destroy'])
    ->name('cirugias.destroy');

Route::get('/cirugias/buscar', [CirugiaController::class, 'buscar'])
    ->name('cirugias.buscar');

Route::get('/cirugias/mascotas/{propietario}', [CirugiaController::class, 'mascotas'])
    ->name('cirugias.mascotas');

Route::get('/cirugias/{cirugia}', [CirugiaController::class, 'show'])
    ->name('cirugias.show');

Route::get('/cirugias/create/{mascota}', [CirugiaController::class, 'form'])
    ->name('cirugias.form');

use App\Http\Controllers\OrinaExamenController;

Route::get('examenes_orina/{consulta}/examenes', [OrinaExamenController::class, 'create'])
    ->name('examenes.create');

Route::post('examenes_orina/{consulta}/examenes', [OrinaExamenController::class, 'store'])
    ->name('examenes.store');

Route::get('examenes_orina/{consulta}/examenes/ver', [OrinaExamenController::class, 'show'])
    ->name('examenes.show');

Route::get('examenes_orina/{consulta}/examenes/editar', [OrinaExamenController::class, 'edit'])
    ->name('examenes.edit');

Route::delete('examenes_orina/{consulta}/examenes', [OrinaExamenController::class, 'destroy'])
    ->name('examenes.destroy');

Route::put(
    'examenes_orina/{consulta}/examenes',
    [OrinaExamenController::class, 'update']
)->name('examenes.update');

Route::get(
    'examenes_orina/{consulta}/examenes/pdf',
    [OrinaExamenController::class, 'pdf']
)->name('examenes.pdf');

use App\Http\Controllers\PerfiltiroideController;

Route::get(
    'perfil_tiroideo/{consulta}/perfil',
    [PerfiltiroideController::class, 'create']
)->name('tiroides.create');

Route::post(
    'perfil_tiroideo/{consulta}/perfil',
    [PerfiltiroideController::class, 'store']
)->name('tiroides.store');

Route::get(
    'perfil_tiroideo/{consulta}/perfil/ver',
    [PerfiltiroideController::class, 'show']
)->name('tiroides.show');

Route::get(
    'perfil_tiroideo/{consulta}/perfil/editar',
    [PerfiltiroideController::class, 'edit']
)->name('tiroides.edit');

Route::put(
    'perfil_tiroideo/{consulta}/perfil',
    [PerfiltiroideController::class, 'update']
)->name('tiroides.update');

Route::delete(
    'perfil_tiroideo/{consulta}/perfil',
    [PerfiltiroideController::class, 'destroy']
)->name('tiroides.destroy');

Route::get(
    'perfil_tiroideo/{consulta}/perfil/pdf',
    [PerfiltiroideController::class, 'pdf']
)->name('tiroides.pdf');

use App\Http\Controllers\RadiografiaController;

Route::post(
    '/consultas/{consulta}/radiografias',
    [RadiografiaController::class, 'store']
)->name('radiografias.store');

Route::delete(
    '/radiografias/{radiografia}',
    [RadiografiaController::class, 'destroy']
)->name('radiografias.destroy');