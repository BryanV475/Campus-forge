<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Llamada al seeder de cursos
        $this->call([
            CourseSeeder::class,
        ]);

        // Llamada al seeder de usuarios
        $this->call([
            UsersTableSeeder::class,
        ]);
    }
}
