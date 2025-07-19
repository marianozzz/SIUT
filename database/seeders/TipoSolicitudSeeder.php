<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoSolicitud;

class TipoSolicitudSeeder extends Seeder
{
    public function run()
    {
        TipoSolicitud::insert([
            [
                'nombre' => 'Cambio de curso',
                'descripcion' => 'El estudiante desea cambiarse a otro curso o división.'
            ],
            [
                'nombre' => 'Baja temporal',
                'descripcion' => 'El estudiante necesita ausentarse por un tiempo.'
            ],
            [
                'nombre' => 'Cambio de turno',
                'descripcion' => 'El estudiante desea cambiar de turno (mañana/tarde).'
            ],
            [
                'nombre' => 'Justificación de falta',
                'descripcion' => 'El estudiante presenta certificado para justificar su inasistencia.'
            ],
            [
                'nombre' => 'Inscripción tardía',
                'descripcion' => 'Ingreso al sistema fuera de término.'
            ],
        ]);
    }
}
