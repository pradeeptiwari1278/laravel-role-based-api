<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@123'),
            ]
        );

        // Attach role to admin user
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}
