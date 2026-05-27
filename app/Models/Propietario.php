<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'direccion',
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
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

    public function cirugias()
    {
        return $this->hasMany(Cirugia::class);
    }

}
