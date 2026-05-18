<?php

namespace App\Http\Controllers;

use App\Models\Esterilizacion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
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
        $mascotas = Mascota::with('propietario')
            ->latest()
            ->paginate(10);

        return view('esterilizaciones.buscar', compact('mascotas'));
    }

    public function show(Esterilizacion $esterilizacion)
    {
        return view('esterilizaciones.show', compact('esterilizacion'));
    }

    public function store(Request $request)
    {
        try {
            $imageName = null;

            if ($request->consentimiento_firmado) {
                $image = $request->consentimiento_firmado;

                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);

                $imageName = 'firma_' . time() . '.png';

                Storage::disk('public')->put("firmas/$imageName", base64_decode($image));
            }

            Esterilizacion::create([
                'mascota_id' => $request->mascota_id,
                'propietario_id' => $request->propietario_id,
                'tipo' => $request->tipo,
                'veterinario' => $request->veterinario,
                'peso' => $request->peso,
                'fecha' => $request->fecha,
                'observaciones' => $request->observaciones,
                'consentimiento_firmado' => $imageName,
            ]);

            return redirect()
                ->route('esterilizaciones.index')
                ->with('success', 'Esterilización guardada con éxito.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'No se pudo guardar la esterilización.');
        }
    }
    public function pdf(Esterilizacion $esterilizacion)
    {
        $pdf = Pdf::loadView('esterilizaciones.pdf', compact('esterilizacion'));

        return $pdf->stream('consentimiento.pdf');
    }

    public function destroy(Esterilizacion $esterilizacion)
    {
        try {
            $esterilizacion->delete();

            return redirect()
                ->route('esterilizaciones.index')
                ->with('success', 'Registro eliminado correctamente.');
        } catch (\Throwable $e) {
            return back()
                ->with('error', 'No se pudo eliminar el registro.');
        }
    }
    
    public function buscar(Request $request)
    {
        $mascotas = Mascota::with('propietario')
            ->where('nombre','like','%'.$request->buscar.'%')
            ->orWhereHas('propietario', function($q) use ($request) {
                $q->where('nombre','like','%'.$request->buscar.'%')
                ->orWhere('telefono','like','%'.$request->buscar.'%');
            })
            ->paginate(10)
            ->appends(['buscar' => $request->buscar]);

        return view('esterilizaciones.buscar', compact('mascotas'));
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
