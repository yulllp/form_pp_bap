<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()
            ->count(5)
            ->create()
            ->each(function ($department) {
                // Create a manager for each department
                $manager = User::factory()->create([
                    'department_id' => $department->id, // Set the department ID for the manager
                    'jabatan' => 'manager',
                    'role' => $department->nama === 'IT' ? 'admin' : 'user', // Set role to admin only if department is IT
                ]);

                // Update the department's pemimpin_id
                $department->update(['pemimpin_id' => $manager->id]);

                // Create other users for the department
                User::factory()
                    ->count(3) // Create 3 additional users
                    ->create([
                        'jabatan' => null, // Other users don't have a specific jabatan
                        'role' => 'user', // Set role for additional users to user
                    ]);
            });
    }
}
