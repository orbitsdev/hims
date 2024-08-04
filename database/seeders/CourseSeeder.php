<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'name' => 'Bachelor of Science in Information Technology (BSIT)',
                'abbreviation' => 'BSIT',
                'department_id'=> 3,
                
            ],
            [
                'name' => 'Bachelor of Science in Computer Science (BSCS)',
                'abbreviation' => 'BSCS',
                'department_id'=> 3,
                
            ],
            [
                'name' => 'Bachelor of Science in Information Systems (BSIS)',
                'abbreviation' => 'BSIS',
                'department_id'=> 3,
                
            ],
            [
                'name' => 'Bachelor of Science in Software Engineering (BSSE)',
                'abbreviation' => 'BSSE',
                'department_id'=> 3,
                
            ],
            [
                'name' => 'Bachelor of Science in Cyber Security (BSCS)',
                'abbreviation' => 'BSCS',
                'department_id'=> 3,
                
            ],
            
        ]);
    }
}
