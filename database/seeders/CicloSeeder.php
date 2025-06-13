<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ciclo;

class CicloSeeder extends Seeder
{
    public function run(): void
    {
        Ciclo::insert([
            ['nombre' => 'Ciclo Básico', 'descripcion' => 'Cursos de 1° a 3° año'],
            ['nombre' => 'Ciclo Superior', 'descripcion' => 'Cursos de 4° a 7° año'],
        ]);
    }
}
