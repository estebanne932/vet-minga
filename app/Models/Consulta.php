<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'propietario_id',
        'mascota_id',
        'expediente_num',
        'fecha',
        'motivo',
        'veterinario',
        'firma',
        'estatus',
        'autorizacion_emergencia',
    ];


    


    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function examenFisico()
    {
        return $this->hasMany(ExamenFisico::class);
    }

    public function examenFisicoCheck()
    {
        return $this->hasMany(ExamenFisicoCheck::class);
    }

    public function diagnostico()
    {
        return $this->hasOne(Diagnostico::class);
    }

    public function medicamentosAplicados()
    {
        return $this->hasMany(MedicamentoAplicado::class);
    }

    public function biometria()
    {
        return $this->hasMany(BiometriaHematica::class);
    }

    public function quimica()
    {
        return $this->hasMany(Quimica::class);
    }

    public function orinaExamenes()
    {
        return $this->hasMany(OrinaExamen::class, 'consulta_id');
    }

    public function perfilTiroides()
    {
        return $this->hasMany(Tiroides::class, 'consulta_id');
    }

    public function radiografias()
    {
        return $this->hasMany(Radiografia::class);
    }


}
