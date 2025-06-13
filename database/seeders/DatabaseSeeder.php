<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar otros seeders
        $this->call([
            DivisionSeeder::class,
            RolesAndPermissionsSeeder::class,
            EspecialidadSeeder::class,
            CategoriaAsignaturaSeeder::class,
            TurnoSeeder::class,
            CicloSeeder::class,
        ]);

        // Crear el usuario admin y asignar rol
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'), // Asegurate de encriptar la contraseña
        ]);

        $admin->assignRole('admin');
    }
}
