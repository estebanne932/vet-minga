<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenFisico extends Model
{
    protected $fillable = [
        'consulta_id',
        'punto',
        'respuesta',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
