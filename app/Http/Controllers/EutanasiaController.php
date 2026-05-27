<?php

namespace App\Http\Controllers;

use App\Models\Esterilizacion;
use App\Models\Eutanasia;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Propietario;
use App\Models\Mascota;


class EutanasiaController extends Controller
{
  
    public function index()
{
    $eutanasias = Eutanasia::latest()->paginate(10);

    return view('eutanasias.index', compact('eutanasias'));
}

    public function create()
    {
        $mascotas = Mascota::with('propietario')
            ->latest()
            ->paginate(10);

        return view('eutanasias.buscar', compact('mascotas'));
    }

   public function show(Eutanasia $eutanasia)
    {
        $eutanasia->load(['propietario', 'mascota']);

        return view('eutanasias.show', compact('eutanasia'));
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

            Eutanasia::create([
                'mascota_id' => $request->mascota_id,
                'propietario_id' => $request->propietario_id,
                'veterinario' => $request->veterinario,
                'peso' => $request->peso,
                'fecha' => $request->fecha,
                'observaciones' => $request->observaciones,
                'consentimiento_firmado' => $imageName,
            ]);

            return redirect()
                ->route('eutanasias.index')
                ->with('success', 'Eutanasia guardada con éxito.');
            } catch (\Throwable $e) {
                return back()
                    ->withInput()
                    ->with('error', 'No se pudo guardar la carta de eutanasia.');
            }
    }

    public function pdf(Eutanasia $eutanasia)
    {
        $pdf = Pdf::loadView('eutanasias.pdf', compact('eutanasia'));

        return $pdf->stream('consentimiento.pdf');
    }

    public function destroy(Eutanasia $eutanasia)
    {
        try {
            $eutanasia->delete();

            return redirect()
                ->route('eutanasias.index')
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

        return view('eutanasias.buscar', compact('mascotas'));
    }

    public function mascotas(Propietario $propietario)
    {
        $mascotas = $propietario->mascotas;

        return view('eutanasias.mascotas', compact('propietario','mascotas'));
    }

    public function form(Mascota $mascota)
    {
        $propietario = $mascota->propietario;

        return view('eutanasias.create', compact('mascota','propietario'));
    }


}