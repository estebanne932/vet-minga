<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Propietario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MascotaController extends Controller
{
     /**
     * 📋 LISTADO
     */
    public function index()
    {
        $mascotas = Mascota::with('propietario')
            ->orderBy('nombre')
            ->get();

        $propietarios = Propietario::withCount('mascotas')
            ->orderBy('nombre')
            ->get();

        return view('pacientes.index', compact(
            'mascotas',
            'propietarios'
        ));
    }

    /**
     * ➕ FORM CREAR
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * 💾 GUARDAR
     */
    public function store(Request $request)
    {

        $request->validate([
            'propietario_id' => 'required|exists:propietarios,id',
            'propietario_telefono' => 'nullable|string|max:255',
            'propietario_correo' => 'nullable|email|max:255',
            'propietario_direccion' => 'nullable|string|max:255',

            'mascota_id' => 'required|exists:mascotas,id',
            'mascota_especie' => 'nullable|string|max:255',
            'mascota_raza' => 'nullable|string|max:255',
            'mascota_edad' => 'nullable|string|max:255',
            'mascota_peso' => 'nullable|numeric|min:0',

            'motivo' => 'required|string',
            'fecha' => 'required|date',
            'veterinario' => 'required|string|max:255',
        ], [
            'propietario_id.required' => 'Debes seleccionar un propietario.',
            'mascota_id.required' => 'Debes seleccionar una mascota.',
            'motivo.required' => 'El motivo de consulta es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'veterinario.required' => 'El veterinario es obligatorio.',
        ]);

        DB::transaction(function () use ($request) {

            // 🧍‍♂️ PROPIETARIO
            if ($request->propietario_id) {

                $propietario = Propietario::findOrFail($request->propietario_id);

                $propietario->update([
                    'nombre'    => $request->propietario_nombre,
                    'telefono'  => $request->propietario_telefono,
                    'correo'    => $request->propietario_correo,
                    'direccion' => $request->propietario_direccion,
                ]);

            } else {

                $propietario = Propietario::create([
                    'nombre'    => $request->propietario_nombre,
                    'telefono'  => $request->propietario_telefono,
                    'correo'    => $request->propietario_correo,
                    'direccion' => $request->propietario_direccion,
                ]);
            }

            // 🐶 IMAGEN
            $imagenPath = null;

            if (
                $request->hasFile('mascota_imagen') &&
                $request->file('mascota_imagen')->isValid()
            ) {
                $imagenPath = $request
                    ->file('mascota_imagen')
                    ->store('mascotas', 'public');
            }

           // 🐾 MASCOTA
            $mascota = Mascota::create([
                'nombre'         => $request->mascota_nombre,
                'especie'        => $request->mascota_especie,
                'raza'           => $request->mascota_raza,
                'edad'           => $request->mascota_edad,
                'peso'           => $request->mascota_peso,
                'imagen'         => $imagenPath,
                'esterilizado'   => $request->boolean('mascota_esterilizado'),
                'propietario_id' => $propietario->id,
            ]);

            // 🔥 GENERAR QR
            $qrPath = "qr/mascotas/mascota_{$mascota->id}.svg";

            Storage::disk('public')->makeDirectory('qr/mascotas');

            QrCode::format('svg')
                ->size(300)
                ->generate(
                    url("/mascotas/{$mascota->id}"),
                    storage_path("app/public/{$qrPath}")
                );

            $mascota->update([
                'qr_code' => $qrPath
            ]);
        });

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente');
    }

    /**
     * ✏️ FORM EDITAR
     */

    public function edit(Mascota $mascota)
    {
        return view('mascotas.edit', compact('mascota'));
    }
    
        /**
     * 🔄 ACTUALIZAR
     */
    public function update(Request $request, Mascota $mascota)
    {
        DB::transaction(function () use ($request, $mascota) {


            // 🐶 IMAGEN
            $imagenPath = $mascota->imagen;

            if (
                $request->hasFile('mascota_imagen') &&
                $request->file('mascota_imagen')->isValid()
            ) {

                if ($mascota->imagen && Storage::disk('public')->exists($mascota->imagen)) {
                    Storage::disk('public')->delete($mascota->imagen);
                }

                $imagenPath = $request
                    ->file('mascota_imagen')
                    ->store('mascotas', 'public');
            }

            // 🐾 MASCOTA
            $mascota->update([
                'nombre'       => $request->mascota_nombre,
                'especie'      => $request->mascota_especie,
                'raza'         => $request->mascota_raza,
                'edad'         => $request->mascota_edad,
                'peso'         => $request->mascota_peso,
                'imagen'       => $imagenPath,
                'esterilizado' => $request->boolean('mascota_esterilizado'),
            ]);
        });

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Paciente actualizado correctamente');
    }

    public function destroy(Mascota $paciente)
{
    DB::transaction(function () use ($paciente) {

        $propietario = $paciente->propietario;

        if ($paciente->imagen && Storage::disk('public')->exists($paciente->imagen)) {
            Storage::disk('public')->delete($paciente->imagen);
        }

        $paciente->delete();

        if ($propietario && $propietario->mascotas()->count() === 0) {
            $propietario->delete();
        }
    });

    return redirect()
        ->route('pacientes.index')
        ->with('success', 'Paciente eliminado correctamente');
}

     /**
     * 👁️ VER DETALLE (opcional)
     */
   public function show(Mascota $paciente)
    {
        $paciente->load([
            'propietario',
            'consultas',
            'esterilizaciones' // 👈 ya integrado
        ]);

        return view('pacientes.show', compact('paciente'));
    }
}
