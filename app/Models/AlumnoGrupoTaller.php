<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumnoGrupoTaller extends Model
{
    protected $table = 'alumno_grupo_taller'; // nombre real de la tabla

    protected $fillable = [
        'alumno_id',
        'grupo_taller_id',
    ];

    public function grupoTaller()
    {
        return $this->belongsTo(GrupoTaller::class, 'grupo_taller_id');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
}
