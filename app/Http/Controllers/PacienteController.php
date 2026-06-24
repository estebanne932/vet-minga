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
            'propietario_id' => 'nullable|exists:propietarios,id',
            'propietario_telefono' => 'nullable|string|max:255',
            'propietario_correo' => 'nullable|email|max:255',
            'propietario_direccion' => 'nullable|string|max:255',

            'mascota_nombre' => 'required|string|max:255',
            'mascota_especie' => 'nullable|string|max:255',
            'mascota_raza' => 'nullable|string|max:255',
            'mascota_edad' => 'nullable|string|max:255',
            'mascota_peso' => 'nullable|numeric|min:0',
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


    public function update(Request $request, Mascota $paciente)
    {
        DB::transaction(function () use ($request, $paciente) {

            $propietario = $paciente->propietario;

            if (! $propietario) {
                abort(404, 'Este paciente no tiene propietario asociado.');
            }

            $propietario->update([
                'nombre'    => $request->propietario_nombre,
                'telefono'  => $request->propietario_telefono,
                'correo'    => $request->propietario_correo,
                'direccion' => $request->propietario_direccion,
            ]);
        });

        return redirect()->route('pacientes.index')
            ->with('success', 'Actualizado correctamente');
    }
    
    public function destroyPropietario(Propietario $propietario)
    {
        DB::transaction(function () use ($propietario) {
            $propietario->load('mascotas');

            foreach ($propietario->mascotas as $mascota) {
                if ($mascota->imagen && Storage::disk('public')->exists($mascota->imagen)) {
                    Storage::disk('public')->delete($mascota->imagen);
                }

                if ($mascota->qr_code && Storage::disk('public')->exists($mascota->qr_code)) {
                    Storage::disk('public')->delete($mascota->qr_code);
                }

                $mascota->delete();
            }

            $propietario->delete();
        });

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Propietario y sus mascotas eliminados correctamente');
    }


    public function editPropietario(Propietario $propietario)
    {
        return view('pacientes.edit-propietario', compact('propietario'));
    }

    public function updatePropietario(Request $request, Propietario $propietario)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'telefono'  => 'nullable|string|max:255',
            'correo'    => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $propietario->update([
            'nombre'    => $request->nombre,
            'telefono'  => $request->telefono,
            'correo'    => $request->correo,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Propietario actualizado correctamente');
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



public function createMascota(Propietario $propietario)
{
    return view('pacientes.create-mascota', compact('propietario'));
}

public function storeMascota(Request $request, Propietario $propietario)
{
    $request->validate([
        'mascota_nombre' => 'required|string|max:255',
        'mascota_especie' => 'nullable|string|max:255',
        'mascota_raza' => 'nullable|string|max:255',
        'mascota_edad' => 'nullable|string|max:255',
        'mascota_peso' => 'nullable|numeric|min:0',
        'mascota_imagen' => 'nullable|image',
        'mascota_esterilizado' => 'nullable|boolean',
    ]);

    $imagenPath = null;

    if ($request->hasFile('mascota_imagen') && $request->file('mascota_imagen')->isValid()) {
        $imagenPath = $request->file('mascota_imagen')->store('mascotas', 'public');
    }

    Mascota::create([
        'nombre' => $request->mascota_nombre,
        'especie' => $request->mascota_especie,
        'raza' => $request->mascota_raza,
        'edad' => $request->mascota_edad,
        'peso' => $request->mascota_peso,
        'imagen' => $imagenPath,
        'esterilizado' => $request->boolean('mascota_esterilizado'),
        'propietario_id' => $propietario->id,
    ]);

    return redirect()->route('pacientes.index')->with('success', 'Mascota agregada correctamente');
}
}