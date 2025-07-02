<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = ['nombre', 'apellido', 'dni', 'telefono', 'direccion'];

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    // ✅ Relación con la tabla intermedia
    public function asignaturaCursos()
    {
        return $this->hasMany(AsignaturaCurso::class, 'profesor_id');
    }

    // ✅ Relación con cursos a través de AsignaturaCurso
    public function cursos()
    {
        return $this->hasManyThrough(Curso::class, AsignaturaCurso::class, 'profesor_id', 'id', 'id', 'curso_id');
    }

    // ✅ Relación con asignaturas a través de AsignaturaCurso
    public function asignaturas()
    {
        return $this->hasManyThrough(Asignatura::class, AsignaturaCurso::class, 'profesor_id', 'id', 'id', 'asignatura_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }


    
}
