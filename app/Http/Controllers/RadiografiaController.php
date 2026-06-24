<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Radiografia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RadiografiaController extends Controller
{
    public function store(Request $request, Consulta $consulta)
    {
        foreach ($request->file('imagenes', []) as $imagen) {

            $ruta = $imagen->store(
                'radiografias',
                'public'
            );

            Radiografia::create([
                'consulta_id' => $consulta->id,
                'imagen' => $ruta,
            ]);
        }

        return back()->with('success', 'Radiografías agregadas correctamente');
    }

    public function destroy(Radiografia $radiografia)
    {
        Storage::disk('public')->delete($radiografia->imagen);

        $radiografia->delete();

        return back()->with('success', 'Radiografía eliminada');
    }
}