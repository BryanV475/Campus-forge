<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        // Create permissions
        $permissions = [
            'view courses',
            'search courses',
            'rate courses',
            'view ratings',
            'create course',
            'edit course',
            'delete course',
            'manage users', // Admin specific
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Student role and assign permissions
        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo(['view courses', 'search courses', 'rate courses', 'view ratings']);

        // Create Instructor role and inherit student permissions, plus more
        $instructorRole = Role::create(['name' => 'instructor']);
        $instructorRole->givePermissionTo(['create course', 'edit course']);

        // Admin role with all permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
