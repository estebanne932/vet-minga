<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiroides extends Model
{

    protected $table ='perfil_tiroides';
    protected $fillable = [
        'consulta_id',
        'paciente',
        'especie',
        'veterinario',
        'fecha',
        'color',
        'aspecto',
        'parametro',
        'resultado',
        'referencia_perro',
        'referencia_gato',
    ];

    protected $appends = ['esta_en _rango'];

    public function getEstaEnRangoAttribute() {

        if ($this->resultado === null){
            return null;
        }

        $resultado = floatval($this->resultado);
        $esFelino = in_array(strtolower($this->especie),[
            'felino',
            'gato',
            'felina'
        ]);

        $referencia = $esFelino
            ? $this->referencia_gato
            : $this->referencia_perro;
        
        if (!$referencia) {
            return null;
        }

         // normalizar guiones
        $referencia = str_replace(['–', '—'], '-', $referencia);
        $referencia = str_replace(',', '', $referencia);

        preg_match_all('/[\d.]+/', $referencia, $matches);

        if (count($matches[0]) < 2) {
            return null;
        }

        $min = floatval($matches[0][0]);
        $max = floatval($matches[0][1]);

        return $resultado >= $min && $resultado <= $max;
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
    
}