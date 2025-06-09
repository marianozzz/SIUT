<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $fillable = ['nombre', 'categoria_asignatura_id'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaAsignatura::class, 'categoria_asignatura_id');
    }

    public function asignaturaCursos()
    {
        return $this->hasMany(AsignaturaCurso::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'asignatura_cursos')
                    ->withPivot(['tema', 'profesor_id']) // corregido
                    ->withTimestamps();
    }
}

