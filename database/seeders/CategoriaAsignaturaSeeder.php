<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaAsignatura;

class CategoriaAsignaturaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = ['Aula', 'Taller'];

        foreach ($categorias as $nombre) {
            CategoriaAsignatura::create([
                'nombre' => $nombre,
            ]);
        }
    }
}
