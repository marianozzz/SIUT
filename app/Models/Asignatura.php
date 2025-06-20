<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',             // <-- Agregado para poder asignar este campo
        'categoria_asignatura_id',
    ];

    // Relación con categoría (muchos a uno)
    public function categoria()
    {
        return $this->belongsTo(CategoriaAsignatura::class, 'categoria_asignatura_id');
    }

    // Relación uno a muchos con asignatura_cursos
    public function asignaturaCursos()
    {
        return $this->hasMany(AsignaturaCurso::class);
    }

    // Relación muchos a muchos con cursos a través de asignatura_cursos
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'asignatura_cursos')
                    ->withPivot(['tema', 'profesor_id', 'turno_id'])
                    ->withTimestamps();
    }
}
