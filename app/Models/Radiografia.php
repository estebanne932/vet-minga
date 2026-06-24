<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radiografia extends Model
{
    protected $fillable = [
        'consulta_id',
        'imagen',
        'observaciones',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}