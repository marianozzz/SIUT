<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['nombre', 'curso_id'];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
