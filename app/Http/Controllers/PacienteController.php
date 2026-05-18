<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Propietario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PacienteController extends Controller
{
    /**
     * 📋 LISTADO
     */
    public function index()
    {
        $mascotas = Mascota::with('propietario')
            ->latest()
            ->paginate(10);

        return view('pacientes.index', compact('mascotas'));
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
                'edad'           => (int) $request->mascota_edad,
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
    public function edit(Mascota $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * 🔄 ACTUALIZAR
     */
    public function update(Request $request, Mascota $paciente)
    {
        DB::transaction(function () use ($request, $paciente) {

            // 🧍‍♂️ PROPIETARIO
            $propietario = $paciente->propietario;

            $propietario->update([
                'nombre'    => $request->propietario_nombre,
                'telefono'  => $request->propietario_telefono,
                'correo'    => $request->propietario_correo,
                'direccion' => $request->propietario_direccion,
            ]);

            // 🐶 IMAGEN
            $imagenPath = $paciente->imagen;

            if (
                $request->hasFile('mascota_imagen') &&
                $request->file('mascota_imagen')->isValid()
            ) {

                if ($paciente->imagen && Storage::disk('public')->exists($paciente->imagen)) {
                    Storage::disk('public')->delete($paciente->imagen);
                }

                $imagenPath = $request
                    ->file('mascota_imagen')
                    ->store('mascotas', 'public');
            }

            // 🐾 MASCOTA
            $paciente->update([
                'nombre'       => $request->mascota_nombre,
                'especie'      => $request->mascota_especie,
                'raza'         => $request->mascota_raza,
                'edad'         => (int) $request->mascota_edad,
                'peso'         => $request->mascota_peso,
                'imagen'       => $imagenPath,
                'esterilizado' => $request->boolean('mascota_esterilizado'),
            ]);
        });

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Paciente actualizado correctamente');
    }

    /**
     * 🗑️ ELIMINAR
     */
    public function destroy(Mascota $paciente)
    {
        DB::transaction(function () use ($paciente) {

            // 🧹 Eliminar imagen si existe
            if ($paciente->imagen && Storage::disk('public')->exists($paciente->imagen)) {
                Storage::disk('public')->delete($paciente->imagen);
            }

            // ❌ Eliminar mascota
            $paciente->delete();

            // 🧠 OPCIONAL: eliminar propietario si ya no tiene mascotas
            if ($paciente->propietario && $paciente->propietario->mascotas()->count() === 0) {
                $paciente->propietario->delete();
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