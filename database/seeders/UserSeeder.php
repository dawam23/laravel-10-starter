<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'password' => Hash::make('12345678')
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678')
        ]);

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678')
        ]);

        $superAdmin->assignRole('super admin');
        $admin->assignRole('admin');
        $user->assignRole('user');

        $userFactory = User::factory(20)->create();
        $role = Role::findByName('user');
        $role->users()->attach($userFactory);
    }
}