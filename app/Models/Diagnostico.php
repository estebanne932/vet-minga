<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'consulta_id',
        'diagnosticos_diferenciales',
        'diagnostico_definitivo',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
