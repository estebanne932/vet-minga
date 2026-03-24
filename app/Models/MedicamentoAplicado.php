<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentoAplicado extends Model
{
    protected $table = 'medicamentos_aplicados';

    protected $fillable = [
        'consulta_id',
        'medicamento',
        'dosis',
        'frecuencia',
        'periodo',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
