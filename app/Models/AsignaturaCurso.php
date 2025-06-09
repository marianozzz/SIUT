<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaturaCurso extends Model
{
    protected $table = 'asignatura_cursos'; // nombre correcto de la tabla
    protected $fillable = ['tema', 'profesor_id', 'curso_id', 'asignatura_id', 'turno_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Docente::class, 'profesor_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
