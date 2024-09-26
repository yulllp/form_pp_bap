<?php

namespace Database\Seeders;

use App\Models\PtTujuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PtTujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PtTujuan::factory()->count(5)->create();
    }
}
