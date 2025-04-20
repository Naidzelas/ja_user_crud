<?php

namespace Database\Seeders;

use App\Models\Replacables\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::firstOrCreate([
            'name' => 'Human Resources',
        ]);
        Department::firstOrCreate([
            'name' => 'Information Technology',
        ]);
        Department::firstOrCreate([
            'name' => 'Finance',
        ]);
    }
}
