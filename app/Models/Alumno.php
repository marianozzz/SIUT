<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Alumno extends Model
{
use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'email',
        'telefono',
        'domicilio',
    ];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'alumno_curso');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->apellido . ', ' . $this->nombre;
    }

}
