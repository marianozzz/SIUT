<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaturaCurso extends Model
{
    protected $table = 'asignatura_cursos'; // Tabla explícita

    protected $fillable = [
        'tema',
        'profesor_id',
        'curso_id',
        'asignatura_id',
        'turno_id',
    ];

    // Curso al que pertenece esta asignatura_curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // Asignatura relacionada
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    // Docente que dicta esta asignatura en el curso
    public function profesor()
    {
        return $this->belongsTo(Docente::class, 'profesor_id');
    }

    // Horarios asociados a esta asignatura_curso
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    // Turno de la asignatura en el curso (mañana, tarde, etc.)
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
