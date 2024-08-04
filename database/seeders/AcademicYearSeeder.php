<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
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

        AcademicYear::create([
            'name' => '2021-2022',
                 
        ]);
        AcademicYear::create([
            'name' => '2022-2023',  
        ]);
        AcademicYear::create([
            'name' => '2023-2024',
        ]);
        AcademicYear::create([
            'name' => '2024-2025',
        ]);
       
    }
}
