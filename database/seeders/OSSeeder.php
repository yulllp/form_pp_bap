<?php

namespace Database\Seeders;

use App\Models\OS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OS::factory()->count(5)->create();
        
    }
}
