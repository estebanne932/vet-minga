<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propietario;
use App\Models\Mascota;
use App\Models\Consulta;
use App\Models\ExamenFisico;
use App\Models\ExamenFisicoCheck;
use App\Models\Diagnostico;
use App\Models\MedicamentoAplicado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConsultaController extends Controller
{
    public function create()
    {
        return view('consultas.create', [
            'examen' => config('examen_fisico'),
            'checks' => config('examen_fisico_check'),
            'propietarios' => Propietario::orderBy('nombre')->get(),
        ]);
    }
        

    public function index()
    {
        $consultas = Consulta::with([
                'propietario',
                'mascota'
            ])
            ->orderBy('fecha', 'desc')
            ->paginate(10);
            

        return view('consultas.index', compact('consultas'));
    }

    public function updateEstatus(Request $request, Consulta $consulta)
    {
        $request->validate([
            'estatus' => 'required|in:abierta,en_proceso,cerrada,cancelada',
        ]);

        $consulta->update([
            'estatus' => $request->estatus,
        ]);

        return back();
    }

    public function show(Consulta $consulta)
    {
        $consulta->load([
            'propietario',
            'mascota',
            'examenFisico',        // texto
            'examenFisicoCheck',  
            'orinaExamenes', // si / no
        ]);

        return view('consultas.show', compact('consulta'));
    }

    public function destroy(Consulta $consulta)
    {
        DB::transaction(function () use ($consulta) {

            // 🧹 Eliminar firma si existe
            if ($consulta->firma && Storage::disk('public')->exists($consulta->firma)) {
                Storage::disk('public')->delete($consulta->firma);
            }

            // ❌ Eliminar consulta
            $consulta->delete();
        });

        return redirect()
            ->route('consultas.index')
            ->with('success', 'Consulta eliminada correctamente');
    }


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

            /* ==========================
            * 1️⃣ PROPIETARIO (CREATE / UPDATE)
            * ========================== */
            if ($request->propietario_id) {
                $propietario = Propietario::findOrFail($request->propietario_id);

                $propietario->update([
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

        /* ==========================
    * 2️⃣ MASCOTA (CREATE / UPDATE + IMAGEN)
    * ========================== */
    if ($request->mascota_id) {

        $mascota = Mascota::findOrFail($request->mascota_id);

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

        $mascota->update([
            'especie' => $request->mascota_especie,
            'raza'    => $request->mascota_raza,
            'edad'    => (int) $request->mascota_edad,
            'peso'    => $request->mascota_peso,
            'imagen'  => $imagenPath,
            'esterilizado' => $request->boolean('mascota_esterilizado'), // ✅ AQUÍ
        ]);

        
        $esNuevaMascota = false;

    } else {

        $imagenPath = null;

        if (
            $request->hasFile('mascota_imagen') &&
            $request->file('mascota_imagen')->isValid()
        ) {
            $imagenPath = $request
                ->file('mascota_imagen')
                ->store('mascotas', 'public');
        }

        $mascota = Mascota::create([
            'nombre'         => $request->mascota_nombre,
            'especie'        => $request->mascota_especie,
            'raza'           => $request->mascota_raza,
            'edad'           => (int) $request->mascota_edad,
            'peso'           => $request->mascota_peso,
            'imagen'         => $imagenPath,
            'propietario_id' => $propietario->id,
        ]);

        $esNuevaMascota = true;
    }


            /* ==========================
            * 📌 QR DE LA MASCOTA (solo nuevas)
            * ========================== */
            if ($esNuevaMascota) {

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
            }

            $ultimo = Consulta::latest('id')->first();

            if ($ultimo && $ultimo->expediente_num) {
                $numero = intval(substr($ultimo->expediente_num, 4)) + 1;
            } else {
                $numero = 1;
            }

            $expediente = 'EXP-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

            /* ==========================
            * 3️⃣ CONSULTA (SIEMPRE NUEVA)
            * ========================== */
            $consulta = Consulta::create([
                'propietario_id' => $propietario->id,
                'mascota_id'     => $mascota->id,
                'fecha'          => $request->fecha,
                'motivo'         => $request->motivo,
                'veterinario'    => $request->veterinario,
                'expediente_num' => $expediente,
                'estatus'        => 'abierta',
            ]);

            /* ==========================
            * 🩺 EXAMEN FÍSICO
            * ========================== */
            if ($request->has('examen_fisico') && is_array($request->examen_fisico)) {

                foreach ($request->examen_fisico as $punto => $respuesta) {

                    // Evitar guardar campos vacíos
                    if (trim($respuesta) === '') {
                        continue;
                    }

                    ExamenFisico::create([
                        'consulta_id' => $consulta->id,
                        'punto'       => $punto,
                        'respuesta'   => $respuesta,
                    ]);
                }
            }

            /* ==========================
            * ✅ EXAMEN FÍSICO CHECK (SI / NO)
            * ========================== */
            if ($request->has('examen_fisico_check') && is_array($request->examen_fisico_check)) {

                foreach ($request->examen_fisico_check as $punto => $valor) {

                    ExamenFisicoCheck::create([
                        'consulta_id' => $consulta->id,
                        'punto'       => $punto,
                        'respuesta'   => (bool) $valor, // true / false
                    ]);
                }
            }


            /* ==========================
            * 🧠 DIAGNÓSTICO
            * ========================== */
            Diagnostico::create([
                'consulta_id' => $consulta->id,
                'diagnosticos_diferenciales' => $request->diagnosticos_diferenciales,
                'diagnostico_definitivo'     => $request->diagnostico_definitivo,
            ]);


            /* ==========================
            * 💊 MEDICAMENTOS APLICADOS
            * ========================== */
            if ($request->has('medicamentos') && is_array($request->medicamentos)) {

                foreach ($request->medicamentos as $med) {

                    if (empty($med['medicamento'])) {
                        continue;
                    }

                    MedicamentoAplicado::create([
                        'consulta_id' => $consulta->id,
                        'medicamento' => $med['medicamento'],
                        'dosis'       => $med['dosis'] ?? null,
                        'frecuencia'  => $med['frecuencia'] ?? null,
                        'periodo'     => $med['periodo'] ?? null,
                    ]);
                }
            }


            /* ==========================
            * ✍️ FIRMA DIGITAL
            * ========================== */
            if ($request->filled('firma')) {

                $firmaBase64 = str_replace(
                    'data:image/png;base64,',
                    '',
                    $request->firma
                );

                $firmaBase64 = str_replace(' ', '+', $firmaBase64);
                $firmaImagen = base64_decode($firmaBase64);

                $firmaPath = "firmas/consulta_{$consulta->id}.png";

                Storage::disk('public')->put($firmaPath, $firmaImagen);

                $consulta->update([
                    'firma' => $firmaPath
                ]);
            }
        });

        
        return redirect()
            ->route('consultas.index')
            ->with('success', 'Consulta registrada correctamente');
    }

    public function edit(Consulta $consulta)
    {
        $consulta->load([
            'propietario',
            'mascota',
            'examenFisico',
            'examenFisicoCheck',
            'diagnostico',
            'medicamentosAplicados'
        ]);

        return view('consultas.edit', compact('consulta'));
    }

    public function update(Request $request, Consulta $consulta)
    {
        DB::transaction(function () use ($request, $consulta) {

            // 🧍‍♂️ PROPIETARIO
            $propietario = $consulta->propietario;

            $propietario->update([
                'nombre'    => $request->propietario_nombre,
                'telefono'  => $request->propietario_telefono,
                'correo'    => $request->propietario_correo,
                'direccion' => $request->propietario_direccion,
            ]);

            // 🐶 MASCOTA
            $mascota = $consulta->mascota;

            $imagenPath = $mascota->imagen;

            if ($request->hasFile('mascota_imagen')) {

                if ($mascota->imagen && Storage::disk('public')->exists($mascota->imagen)) {
                    Storage::disk('public')->delete($mascota->imagen);
                }

                $imagenPath = $request->file('mascota_imagen')->store('mascotas', 'public');
            }

            $mascota->update([
                'nombre'       => $request->mascota_nombre,
                'especie'      => $request->mascota_especie,
                'raza'         => $request->mascota_raza,
                'edad'         => (int) $request->mascota_edad,
                'peso'         => $request->mascota_peso,
                'imagen'       => $imagenPath,
                'esterilizado' => $request->boolean('mascota_esterilizado'),
            ]);

      
    

            // 📋 CONSULTA
            $consulta->update([
                'fecha'       => $request->fecha,
                'motivo'      => $request->motivo,
                'veterinario' => $request->veterinario,
            ]);

            // 🧹 BORRAR RELACIONES
            $consulta->examenFisico()->delete();
            $consulta->examenFisicoCheck()->delete();
            $consulta->diagnostico()->delete();
            $consulta->medicamentosAplicados()->delete();

            // 🩺 EXAMEN FÍSICO
            foreach ($request->examen_fisico ?? [] as $punto => $respuesta) {

                if (trim($respuesta) === '') continue;

                ExamenFisico::create([
                    'consulta_id' => $consulta->id,
                    'punto'       => $punto,
                    'respuesta'   => $respuesta,
                ]);
            }

            // ✅ CHECK
            foreach ($request->examen_fisico_check ?? [] as $punto => $valor) {

                ExamenFisicoCheck::create([
                    'consulta_id' => $consulta->id,
                    'punto'       => $punto,
                    'respuesta'   => (bool) $valor,
                ]);
            }

            // 🧠 DIAGNÓSTICO
            Diagnostico::create([
                'consulta_id' => $consulta->id,
                'diagnosticos_diferenciales' => $request->diagnosticos_diferenciales,
                'diagnostico_definitivo'     => $request->diagnostico_definitivo,
            ]);

            // 💊 MEDICAMENTOS
            foreach ($request->medicamentos ?? [] as $med) {

                if (empty($med['medicamento'])) continue;

                MedicamentoAplicado::create([
                    'consulta_id' => $consulta->id,
                    'medicamento' => $med['medicamento'],
                    'dosis'       => $med['dosis'] ?? null,
                    'frecuencia'  => $med['frecuencia'] ?? null,
                    'periodo'     => $med['periodo'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('consultas.show', $consulta)
            ->with('success', 'Consulta actualizada correctamente');
    }

}
