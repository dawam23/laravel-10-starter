<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $data = [
            'create users',
            'read users',
            'update users',
            'delete users',

            'create permissions',
            'read permissions',
            'update permissions',
            'delete permissions',

            'create roles',
            'read roles',
            'update roles',
            'delete roles',
        ];
        foreach ($data as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
