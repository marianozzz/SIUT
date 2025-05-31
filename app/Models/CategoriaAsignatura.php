<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaAsignatura extends Model
{
    protected $table = 'categorias_asignaturas';
    protected $fillable = ['nombre'];

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'categoria_asignatura_id');
    }
}
