<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $fillable = [
        'planificacion_id',
        'eje_tematico',
        'unidad',
        'cuatrimestre',
        'contenidos',
        'actividades',
    ];

    public function planificacion()
    {
        return $this->belongsTo(Planificacion::class);
    }
}
