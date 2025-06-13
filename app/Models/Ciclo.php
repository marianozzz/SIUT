<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    // Ejemplo de relación (opcional si usás Curso)
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
