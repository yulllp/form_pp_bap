<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::all()->each(function ($department) {
            User::factory()
                ->count(3) // Create 3 users for each department
                ->create([
                    'department_id' => $department->id, // Set the department ID for users
                ]);
        });
    }
}
