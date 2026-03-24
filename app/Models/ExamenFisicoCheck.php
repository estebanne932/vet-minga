<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenFisicoCheck extends Model
{
    protected $fillable = [
        'consulta_id',
        'punto',
        'respuesta',
    ];

    protected $casts = [
        'respuesta' => 'boolean',
    ];
}
