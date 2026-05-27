<?php

namespace App\Http\Controllers;

use App\Models\Cirugia;
use App\Models\Eutanasia;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Propietario;
use App\Models\Mascota;


class CirugiaController extends Controller
{
  
    public function index()
{
    $cirugias = Cirugia::latest()->paginate(10);

    return view('cirugias.index', compact('cirugias'));
}

    public function create()
    {
        $mascotas = Mascota::with('propietario')
            ->latest()
            ->paginate(10);

        return view('cirugias.buscar', compact('mascotas'));
    }



  public function show(Cirugia $cirugia)
{
    $cirugia->load(['propietario', 'mascota']);

    return view('cirugias.show', compact('cirugia'));
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

            Cirugia::create([
                'mascota_id' => $request->mascota_id,
                'propietario_id' => $request->propietario_id,
                'veterinario' => $request->veterinario,
                'peso' => $request->peso,
                'fecha' => $request->fecha,
                'observaciones' => $request->observaciones,
                'consentimiento_firmado' => $imageName,
            ]);

            return redirect()
                ->route('cirugias.index')
                ->with('success', 'Cirugia guardada con éxito.');
            } catch (\Throwable $e) {

    dd($e->getMessage());

}
    }

    public function pdf(Cirugia $cirugia)
    {
        $pdf = Pdf::loadView('cirugias.pdf', compact('cirugias'));

        return $pdf->stream('consentimiento.pdf');
    }

    public function destroy(Cirugia $cirugia)
    {
        try {
            $cirugia->delete();

            return redirect()
                ->route('cirugias.index')
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

        return view('cirugias.buscar', compact('mascotas'));
    }

    public function mascotas(Propietario $propietario)
    {
        $mascotas = $propietario->mascotas;

        return view('cirugias.mascotas', compact('cirugias','mascotas'));
    }

    public function form(Mascota $mascota)
    {
        $propietario = $mascota->propietario;

        return view('cirugias.create', compact('mascota','propietario'));
    }


}