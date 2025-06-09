<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            Division::create([
                'nombre' => (string) $i, // Guarda como texto: "1", "2", ..., "12"
            ]);
        }
    }
}
