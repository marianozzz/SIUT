<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos generales (podés agregar más luego)
        $permisos = [
            'ver cursos',
            'ver perfil',
            'ver calendario',
            'crear planificación',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $docente = Role::firstOrCreate(['name' => 'docente']);
        $alumno = Role::firstOrCreate(['name' => 'alumno']);
        $directivo = Role::firstOrCreate(['name' => 'directivo']);
        $admin = Role::firstOrCreate(['name' => 'admin']);

        // Asignar permisos a roles
        $docente->syncPermissions(['ver cursos', 'ver perfil', 'ver calendario', 'crear planificación']);
        $alumno->syncPermissions(['ver cursos', 'ver perfil', 'ver calendario']);
        $directivo->syncPermissions(['ver cursos', 'ver perfil']);
        $admin->syncPermissions(Permission::all());

        // Asignar un rol a un usuario de prueba
        $user = User::first(); // o User::find(1)
        if ($user && !$user->hasRole('docente')) {
            $user->assignRole('docente');
        }
    }
}
