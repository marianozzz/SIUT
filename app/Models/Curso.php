<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nivel','especialidad_id','division_id'];

  public function division()
{
    return $this->belongsTo(Division::class);
}


public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class)
            ->withPivot(['tema', 'profesor_id'])
            ->withTimestamps();
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_curso');
    }
   public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function docentes()
{
    return $this->belongsToMany(Docente::class, 'asignatura_curso')
        ->withPivot('asignatura_id', 'tema', 'profesor_id');
}


}
