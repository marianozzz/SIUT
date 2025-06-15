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

    /**
     * Relación con la asignación específica de una asignatura a un curso.
     */
    public function asignaturaCurso()
    {
        return $this->belongsTo(AsignaturaCurso::class);
    }

    /**
     * Alumnos asignados a este grupo (relación muchos a muchos con pivot).
     */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_grupo_taller', 'grupo_taller_id', 'alumno_id')
                    ->withTimestamps();
    }

    /**
     * Acceso directo al curso mediante la asignaturaCurso.
     */
    public function curso()
    {
        return $this->hasOneThrough(
            Curso::class,
            AsignaturaCurso::class,
            'id',                 // Clave primaria en AsignaturaCurso
            'id',                 // Clave primaria en Curso
            'asignatura_curso_id',// Clave local en GrupoTaller
            'curso_id'            // Clave foránea en AsignaturaCurso
        );
    }

    /**
     * Acceso directo a la asignatura (opcional, para simplificar vistas).
     */
    public function asignatura()
    {
        return $this->hasOneThrough(
            Asignatura::class,
            AsignaturaCurso::class,
            'id',                 // Clave primaria en AsignaturaCurso
            'id',                 // Clave primaria en Asignatura
            'asignatura_curso_id',// Clave local en GrupoTaller
            'asignatura_id'       // Clave foránea en AsignaturaCurso
        );
    }

    /**
     * Acceso directo al profesor responsable de este grupo.
     */
    public function profesor()
    {
        return $this->hasOneThrough(
            Docente::class,
            AsignaturaCurso::class,
            'id',                 // Clave primaria en AsignaturaCurso
            'id',                 // Clave primaria en Docente
            'asignatura_curso_id',// Clave local en GrupoTaller
            'profesor_id'         // Clave foránea en AsignaturaCurso
        );
    }

    /**
     * Acceso directo a los horarios en los que se dicta este grupo.
     */
    public function horarios()
    {
        return $this->hasManyThrough(
            Horario::class,
            AsignaturaCurso::class,
            'id',                  // Clave primaria en AsignaturaCurso
            'asignatura_curso_id', // Clave foránea en Horario
            'asignatura_curso_id', // Clave local en GrupoTaller
            'id'                   // Clave primaria en AsignaturaCurso
        );
    }
}
