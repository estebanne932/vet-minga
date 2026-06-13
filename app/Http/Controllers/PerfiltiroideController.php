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

        return view('examenes.create', [
            'consulta'   => $consulta,
            'parametros' => $parametros,
        ]);
    }

    public function store(Request $request, Consulta $consulta)
    {
        foreach ($request->examen as $key => $resultado) {

            $config = config("perfil_tiroide.$key");

            Tiroides::create([
                'consulta_id' => $consulta->id,
                'paciente'    => $consulta->mascota->nombre,
                'especie'     => $consulta->mascota->especie,
                'veterinario' => $consulta->veterinario,
                'fecha'       => now(),

                'color'       => $request->color,
                'aspecto'     => $request->aspecto,

                'parametro'   => $config['label'],
                'resultado'   => $resultado,
                'referencia_perro' => $config['perro'],
                'referencia_gato'  => $config['gato'],
            ]);
        }

        return redirect()
            ->route('examenes.show', $consulta)
            ->with('success', 'Perfil registrado correctamente');
    }

    public function show(Consulta $consulta)
    {
        $examenes = $consulta->perfilTiroides;

        if ($examenes->isEmpty()) {
            abort(404);
        }

        return view('examenes.show', [
            'consulta' => $consulta,
            'examenes' => $examenes,
        ]);
    }

    public function edit(Consulta $consulta)
    {
        $parametros = config('perfil_tiroide');
        $examenes = $consulta->perfilTiroides()->get();

        if ($examenes->isEmpty()) {
            abort(404);
        }

        return view('examenes.edit', [
            'consulta'   => $consulta,
            'parametros' => $parametros,
            'examenes'   => $examenes,
        ]);
    }

    public function update(Request $request, Consulta $consulta)
    {
        $request->validate([
            'color' => ['nullable', 'string', 'max:255'],
            'aspecto' => ['nullable', 'string', 'max:255'],
            'examen' => ['required', 'array'],
        ]);

        DB::transaction(function () use ($request, $consulta) {
            Tiroides::where('consulta_id', $consulta->id)->delete();

            foreach ($request->examen as $key => $dato) {
                if (!isset($dato['resultado']) || $dato['resultado'] === '') {
                    continue;
                }

                $config = config("perfil_tiroide.$key");

                if (!$config) {
                    continue;
                }

                Tiroides::create([
                    'consulta_id'       => $consulta->id,
                    'paciente'          => $consulta->mascota->nombre,
                    'especie'           => $consulta->mascota->especie,
                    'veterinario'       => $consulta->veterinario,
                    'fecha'             => now(),
                    'color'             => $request->color,
                    'aspecto'           => $request->aspecto,
                    'parametro'         => $config['label'],
                    'resultado'         => $dato['resultado'],
                    'referencia_perro'  => $config['perro'],
                    'referencia_gato'   => $config['gato'],
                ]);
            }
        });

        return redirect()
            ->route('examenes.show', $consulta->id)
            ->with('success', 'Perfil de tiroide actualizado correctamente');
    }

    public function pdf(Consulta $consulta)
    {
        $examenes = $consulta->perfilTiroides;

        if ($examenes->isEmpty()) {
            abort(404);
        }

        $pdf = Pdf::loadView('examenes.pdf', [
            'consulta' => $consulta,
            'examenes' => $examenes,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('tiroides_' . $consulta->expediente_num . '.pdf');
    }


    public function destroy(Consulta $consulta)
    {
        Tiroides::where('consulta_id', $consulta->id)->delete();

        return redirect()
            ->route('consultas.show', $consulta->id)
            ->with('success', 'Perfil tiroides eliminado correctamente');
    }
    
}
