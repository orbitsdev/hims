<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('academic_years')->insert([
            [
                'name' => '2021-2022',
                
            ],
            [
                'name' => '2022-2023',
                
            ],
            [
                'name' => '2023-2024',
                
            ],
            [
                'name' => '2024-2025',
                
            ],
        ]);
    }
}
