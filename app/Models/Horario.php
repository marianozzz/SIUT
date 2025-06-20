<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
        protected $fillable = [
        'asignatura_curso_id',
        'dia',
        'hora_entrada',
        'hora_salida',
        'turno_id',
        'profesor_id',
    ];

    public function asignaturaCurso()
    {
        return $this->belongsTo(AsignaturaCurso::class);
    }
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    public function docente()
{
    return $this->belongsTo(\App\Models\Docente::class, 'profesor_id');
}


}

