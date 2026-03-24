<?php

namespace App\Http\Controllers;

use App\Models\Esterilizacion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Propietario;
use App\Models\Mascota;


class EsterilizacionController extends Controller
{
    public function index()
    {
        $esterilizaciones = Esterilizacion::latest()->paginate(10);

        return view('esterilizaciones.index', compact('esterilizaciones'));
    }

    public function create()
    {
        return view('esterilizaciones.buscar');
    }

    public function store(Request $request)
    {
        $esterilizacion = Esterilizacion::create([
            'mascota_id' => $request->mascota_id,
            'propietario_id' => $request->propietario_id,
            'tipo' => $request->tipo,
            'veterinario' => $request->veterinario,
            'peso' => $request->peso,
            'fecha' => $request->fecha,
            'observaciones' => $request->observaciones
        ]);

        return redirect()->route('esterilizaciones.pdf', $esterilizacion);
    }

    public function pdf(Esterilizacion $esterilizacion)
    {
        $pdf = Pdf::loadView('esterilizaciones.pdf', compact('esterilizacion'));

        return $pdf->stream('consentimiento.pdf');
    }

    public function destroy(Esterilizacion $esterilizacion)
    {
        $esterilizacion->delete();

        return redirect()->route('esterilizaciones.index');
    }

    public function buscar(Request $request)
    {
        $propietarios = Propietario::with('mascotas')
            ->where('nombre','like','%'.$request->buscar.'%')
            ->orWhere('telefono','like','%'.$request->buscar.'%')
            ->get();

        return view('esterilizaciones.buscar', compact('propietarios'));
    }


    public function mascotas(Propietario $propietario)
    {
        $mascotas = $propietario->mascotas;

        return view('esterilizaciones.mascotas', compact('propietario','mascotas'));
    }

    public function form(Mascota $mascota)
    {
        $propietario = $mascota->propietario;

        return view('esterilizaciones.create', compact('mascota','propietario'));
    }


}
