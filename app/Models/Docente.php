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
}
