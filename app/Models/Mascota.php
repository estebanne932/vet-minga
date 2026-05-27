<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'peso',
        'esterilizado',
        'propietario_id',
        'qr_code',
        'imagen',
    ];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function esterilizaciones()
    {
        return $this->hasMany(Esterilizacion::class);
    }

    public function eutanasias()
    {
        return $this->hasMany(Eutanasia::class);
    }

}
