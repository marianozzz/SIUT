<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        $especialidades = [
            'Informática',
            'Química',
            'Automotores',
            'Electromecánica',
            'Electrónica',
            'Construcciones',
        ];

        foreach ($especialidades as $nombre) {
            Especialidad::create([
                'nombre' => $nombre,
                'descripcion' => 'Especialidad en ' . $nombre,
            ]);
        }
    }
}
