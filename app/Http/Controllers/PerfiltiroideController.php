<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Tiroides;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PerfiltiroideController extends Controller
{
    public function create(Consulta $consulta)
    {
        $parametros = config('perfil_tiroide');

        return view('tiroides.create', [
            'consulta'   => $consulta,
            'parametros' => $parametros,
        ]);
    }

    public function store(Request $request, Consulta $consulta)
    {
        foreach ($request->examen as $key => $resultado) {

            $config = config("perfil_tiroide.$key");

            if (!$config) {
                continue;
            }

            Tiroides::create([
                'consulta_id' => $consulta->id,
                'paciente'    => $consulta->mascota->nombre,
                'especie'     => $consulta->mascota->especie,
                'veterinario' => $consulta->veterinario,
                'fecha'       => now(),

                'parametro'   => $config['label'],
                'resultado'   => $resultado,
                'referencia_perro' => $config['perro'],
                'referencia_gato'  => $config['gato'],
            ]);
        }

        return redirect()
            ->route('tiroides.show', $consulta)
            ->with('success', 'Perfil tiroideo registrado correctamente');
    }

    public function show(Consulta $consulta)
    {
        $perfil = $consulta->perfilTiroides;

        if ($perfil->isEmpty()) {
            abort(404);
        }

        return view('tiroides.show', [
            'consulta' => $consulta,
            'perfil'   => $perfil,
        ]);
    }

    public function edit(Consulta $consulta)
    {
        $parametros = config('perfil_tiroide');
        $perfil = $consulta->perfilTiroides;

        if ($perfil->isEmpty()) {
            abort(404);
        }

        return view('tiroides.edit', [
            'consulta'   => $consulta,
            'parametros' => $parametros,
            'perfil'     => $perfil,
        ]);
    }

    public function update(Request $request, Consulta $consulta)
    {
        $request->validate([
            'examen' => ['required', 'array'],
        ]);

        DB::transaction(function () use ($request, $consulta) {

            Tiroides::where('consulta_id', $consulta->id)->delete();

            foreach ($request->examen as $key => $dato) {

                if (
                    !isset($dato['resultado']) ||
                    $dato['resultado'] === ''
                ) {
                    continue;
                }

                $config = config("perfil_tiroide.$key");

                if (!$config) {
                    continue;
                }

                Tiroides::create([
                    'consulta_id' => $consulta->id,
                    'paciente'    => $consulta->mascota->nombre,
                    'especie'     => $consulta->mascota->especie,
                    'veterinario' => $consulta->veterinario,
                    'fecha'       => now(),

                    'parametro'   => $config['label'],
                    'resultado'   => $dato['resultado'],
                    'referencia_perro' => $config['perro'],
                    'referencia_gato'  => $config['gato'],
                ]);
            }
        });

        return redirect()
            ->route('tiroides.show', $consulta->id)
            ->with('success', 'Perfil tiroideo actualizado correctamente');
    }

    public function pdf(Consulta $consulta)
    {
        $perfil = $consulta->perfilTiroides;

        if ($perfil->isEmpty()) {
            abort(404);
        }

        $pdf = Pdf::loadView('tiroides.pdf', [
            'consulta' => $consulta,
            'perfil'   => $perfil,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream(
            'perfil_tiroideo_' . $consulta->expediente_num . '.pdf'
        );
    }

    public function destroy(Consulta $consulta)
    {
        Tiroides::where('consulta_id', $consulta->id)->delete();

        return redirect()
            ->route('consultas.show', $consulta->id)
            ->with('success', 'Perfil tiroideo eliminado correctamente');
    }
}