<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propietario;
use App\Models\Mascota;

class BusquedaController extends Controller
{
    public function propietarios(Request $request)
    {
        $q = $request->get('q');

        return Propietario::where('nombre', 'like', "%{$q}%")
            ->limit(5)
            ->get();
    }

    public function mascotas(Request $request)
    {
        return Mascota::where('propietario_id', $request->propietario_id)
            ->where('nombre', 'like', "%{$request->q}%")
            ->limit(5)
            ->get();
    }
}
