<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['create', 'read', 'update', 'delete'] as $action) {
            Permission::firstOrCreate(['name' => $action]);
        }
    }
}
