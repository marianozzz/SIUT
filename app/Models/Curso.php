<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nivel',
        'especialidad_id',
        'division_id',
        'ciclo_id'
    ];

    // Relaciones básicas

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }

    // Relación con alumnos (muchos a muchos)
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class)->withTimestamps();
    }

    // Relación uno a muchos con asignatura_cursos
    public function asignaturaCursos()
    {
        return $this->hasMany(AsignaturaCurso::class);
    }

    // Relación muchos a muchos con asignaturas a través de asignatura_cursos
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_cursos')
                    ->withPivot(['tema', 'profesor_id', 'turno_id']) // agrega campos relevantes
                    ->withTimestamps();
    }

    // Relación para obtener docentes a través de asignatura_cursos
    public function docentes()
    {
        return $this->hasManyThrough(
            Docente::class,
            AsignaturaCurso::class,
            'curso_id',    // FK en asignatura_cursos hacia cursos
            'id',          // PK en docentes
            'id',          // PK en cursos
            'profesor_id'  // FK en asignatura_cursos hacia docentes
        );
    }
}
