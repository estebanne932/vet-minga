<?php


namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Quimica;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;




class QuimicaController extends Controller
{
    public function create(Consulta $consulta)
    {
        $parametros = config('quimica');

        return view('quimica.create', [
            'consulta'   => $consulta,
            'parametros' => $parametros,
        ]);
    }

    public function store(Request $request, Consulta $consulta)
    {
        foreach ($request->quimica as $key => $resultado) {

            $config = config("quimica.$key");

            Quimica::create([
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
            ->with('success', 'Quimica registrada correctamente');
    }

    public function show(Consulta $consulta)
    {
        $quimica = $consulta->quimica;

        if ($quimica->isEmpty()) {
            abort(404);
        }

        return view('quimica.show', [
            'consulta'   => $consulta,
            'quimica' => $quimica,
        ]);
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->quimica()->delete();

        return redirect()
            ->route('consultas.show', $consulta)
            ->with('success', 'Quimica eliminada correctamente.');
    }

    public function edit(Consulta $consulta)
    {
        $parametros = config('quimica');

        $quimica = Quimica::where('consulta_id', $consulta->id)->get();

        return view('quimica.edit', compact(
            'consulta',
            'parametros',
            'quimica'
        ));
    }

    public function update(Request $request, Consulta $consulta)
    {
        // Eliminamos lo anterior
        $consulta->quimica()->delete();

        // Guardamos lo nuevo
        foreach ($request->quimica as $item) {
            Quimica::create([
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
            ->route('quimica.show', $consulta->id)
            ->with('success', 'Quimica actualizada correctamente.');
    }

    public function pdf(Consulta $consulta)
    {
        $quimica = $consulta->quimica;

        if ($quimica->isEmpty()) {
            abort(404);
        }

        $pdf = Pdf::loadView('quimica.pdf', [
            'consulta'   => $consulta,
            'quimica'=> $quimica,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream(
            'quimica'.$consulta->expediente_num.'.pdf'
        );
    }

  


}
