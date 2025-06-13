<?php

namespace App\Models;

use App\Models\Curso; 
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


// Alumno.php
public function cursos()
{
    return $this->belongsToMany(Curso::class)->withTimestamps();
}

    public function grupoTalleres()
    {
        return $this->belongsToMany(GrupoTaller::class, 'alumno_grupo_taller', 'alumno_id', 'grupo_taller_id')
                    ->withTimestamps();
    }

    public function getNombreCompletoAttribute()
    {
        return $this->apellido . ', ' . $this->nombre;
    }
}
