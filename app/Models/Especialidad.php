<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table ="especialidades";
    protected $fillable = ['nombre', 'descripcion'];


     public function getRouteKeyName()
    {
        return 'id'; // Asegura que use "id" para el enlace de modelo en rutas
    }

}
