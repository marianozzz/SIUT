<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turno;

class TurnoSeeder extends Seeder
{
    public function run(): void
    {
        $turnos = ['Mañana', 'Tarde', 'Noche'];

        foreach ($turnos as $nombre) {
            Turno::create([
                'nombre' => $nombre,
            ]);
        }
    }
}
