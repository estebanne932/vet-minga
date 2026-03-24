<?php


namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\BiometriaHematica;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;




class BiometriaHematicaController extends Controller
{
    public function create(Consulta $consulta)
    {
        $parametros = config('biometria_hematica');

        return view('biometrias.create', [
            'consulta'   => $consulta,
            'parametros' => $parametros,
        ]);
    }

    public function store(Request $request, Consulta $consulta)
    {
        foreach ($request->biometria as $key => $resultado) {

            $config = config("biometria_hematica.$key");

            BiometriaHematica::create([
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
            ->route('consultas.show', $consulta)
            ->with('success', 'Biometría hemática registrada correctamente');
    }

    public function show(Consulta $consulta)
    {
        $biometrias = $consulta->biometria;

        if ($biometrias->isEmpty()) {
            abort(404);
        }

        return view('biometrias.show', [
            'consulta'   => $consulta,
            'biometrias' => $biometrias,
        ]);
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->biometria()->delete();

        return redirect()
            ->route('consultas.show', $consulta)
            ->with('success', 'Biometría hemática eliminada correctamente.');
    }

    public function edit(Consulta $consulta)
    {
        $parametros = config('biometria_hematica');

        $biometrias = BiometriaHematica::where('consulta_id', $consulta->id)->get();

        return view('biometrias.edit', compact(
            'consulta',
            'parametros',
            'biometrias'
        ));
    }

    public function update(Request $request, Consulta $consulta)
    {
        // Eliminamos lo anterior
        $consulta->biometria()->delete();

        // Guardamos lo nuevo
        foreach ($request->biometria as $item) {
            BiometriaHematica::create([
                'consulta_id'       => $consulta->id,
                'paciente'          => $consulta->mascota->nombre,
                'especie'           => $consulta->mascota->especie,
                'veterinario'       => $consulta->veterinario,
                'fecha'             => now()->toDateString(),
                'parametro'         => $item['parametro'],
                'resultado'         => $item['resultado'] ?? null,
                'referencia_perro'  => $item['referencia_perro'],
                'referencia_gato'   => $item['referencia_gato'],
            ]);
        }

        return redirect()
            ->route('biometrias.show', $consulta->id)
            ->with('success', 'Biometría hemática actualizada correctamente.');
    }

    public function pdf(Consulta $consulta)
    {
        $biometrias = $consulta->biometria;

        if ($biometrias->isEmpty()) {
            abort(404);
        }

        $pdf = Pdf::loadView('biometrias.pdf', [
            'consulta'   => $consulta,
            'biometrias'=> $biometrias,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Biometria_Hematica_'.$consulta->expediente_num.'.pdf'
        );
    }

  


}
