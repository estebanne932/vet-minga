<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eutanasia extends Model
{
    protected $table = 'eutanasias'; 

    protected $fillable = [
        'mascota_id',
        'propietario_id',
        'fecha',
        'veterinario',
        'peso',
        'observaciones',
        'consentimiento_firmado',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }
}

