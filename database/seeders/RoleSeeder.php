<?php

namespace Database\Seeders;

use App\Models\Replacables\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'Admin',
            'description' => 'Administrator role with full access',
            'level' => 1,
            'permissions' => json_encode(['*']),
            'department_id' => 2,
        ]);
        Role::firstOrCreate([
            'name' => 'HR Manager',
            'description' => 'HR Manager role with limited access',
            'level' => 2,
            'permissions' => json_encode(['view', 'edit']),
            'department_id' => 1,
        ]);
        Role::firstOrCreate([
            'name' => 'IT Specialist',
            'description' => 'IT Specialist role with technical access',
            'level' => 3,
            'permissions' => json_encode(['view', 'edit', 'delete']),
            'department_id' => 2,
        ]);
    }
}
