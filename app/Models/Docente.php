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

public function cursos()
{
    return $this->belongsToMany(Curso::class, 'asignatura_curso')
        ->withPivot('asignatura_id', 'tema')
        ->wherePivot('profesor_id', $this->id);
}

}
