<?php

namespace App\Http\Controllers;

use App\Models\Mascota;

class MascotaController extends Controller
{
    public function show(Mascota $mascota)
    {
        return view('mascotas.show', compact('mascota'));
    }
}
