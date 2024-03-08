<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que los roles 'admin' y 'student' existen.
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        // Crea el usuario administrador
        $admin = User::create([
            'name' => 'Elias Telleria',
            'email' => 'admin@campusforge.com',
            'password' => Hash::make('123456789'), // Usar una contraseña segura en producción
        ]);
        $admin->assignRole($adminRole);

        // Crea el usuario estudiante
        $student = User::create([
            'name' => 'Bryan Vega',
            'email' => 'student@campusforge.com',
            'password' => Hash::make('123456789'), // Usar una contraseña segura en producción
        ]);
        $student->assignRole($studentRole);
    }
}
