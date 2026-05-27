<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    protected $table = 'cirugia'; 

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

