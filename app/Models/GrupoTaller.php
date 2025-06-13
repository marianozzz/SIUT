<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoTaller extends Model
{
    protected $table = 'grupo_talleres';

    protected $fillable = [
        'nombre',
        'asignatura_curso_id',
    ];

    public function asignaturaCurso()
    {
        return $this->belongsTo(AsignaturaCurso::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_grupo_taller', 'grupo_taller_id', 'alumno_id')
                    ->withTimestamps();
    }


// Si necesitás acceder al curso directamente desde el grupo:
public function curso()
{
    return $this->hasOneThrough(
        Curso::class,
        AsignaturaCurso::class,
        'id',          // foreign key en AsignaturaCurso
        'id',          // foreign key en Curso
        'asignatura_curso_id', // local key en GrupoTaller
        'curso_id'     // local key en AsignaturaCurso
    );
}

}
