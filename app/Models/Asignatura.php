<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
        
        protected $fillable = ['nombre', 'categoria_asignatura_id'];


       public function cursos()
        {
            return $this->belongsToMany(Curso::class)
                        ->withPivot('tema', 'profesor_id')
                        ->withTimestamps();
        }

                // app/Models/Asignatura.php
      public function categoria()
        {
        return $this->belongsTo(CategoriaAsignatura::class, 'categoria_asignatura_id');
        }

    
}
