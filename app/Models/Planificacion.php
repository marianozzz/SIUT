<?php

// app/Models/Planificacion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planificacion extends Model
{
    protected $fillable = [
    'asignatura_id',
    'curso_id',
    'docente_id',
    'fecha',
    'contenido',
];


    public function asignatura() {
        return $this->belongsTo(Asignatura::class);
    }

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function docente() {
        return $this->belongsTo(Docente::class);
    }
}
