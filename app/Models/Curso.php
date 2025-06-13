<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nivel', 'especialidad_id', 'division_id', 'ciclo_id'];


    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

 // Curso.php
public function alumnos()
{
    return $this->belongsToMany(Alumno::class)->withTimestamps();
}


    // ✅ Relación directa con AsignaturaCurso
    public function asignaturaCursos()
    {
        return $this->hasMany(AsignaturaCurso::class);
    }

    // ✅ Acceso a asignaturas a través de AsignaturaCurso
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_cursos')
                    ->withPivot(['tema', 'profesor_id'])
                    ->withTimestamps();
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }


    // ✅ Acceso a docentes a través de AsignaturaCurso
    public function docentes()
    {
        return $this->hasManyThrough(Docente::class, AsignaturaCurso::class, 'curso_id', 'id', 'id', 'profesor_id');
    }
}

