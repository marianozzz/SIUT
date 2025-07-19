<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table ="solicitudes";
    protected $fillable = [
        'tipo_solicitud_id',
        'alumno_id',
        'docente_id',
        'motivo',
        'estado',
        'respuesta',
        'archivo',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoSolicitud::class, 'tipo_solicitud_id');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
