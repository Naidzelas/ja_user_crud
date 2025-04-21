<?php

namespace Database\Seeders;

use App\Models\Replacables\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->count(10)->create()->each(function ($employee) {
            $employee->update(['role_id' => rand(1, 3)]);
        });
    }
}
