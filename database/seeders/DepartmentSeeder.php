<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Department::create([
        //     'name'=> 'ALL',
        //     'abbreviation'=> '',           
        //  ]);
        Department::create([
            'name'=> 'FACULTY',
            'abbreviation'=> '',           
         ]);
        Department::create([
            'name'=> 'COLLEGE OF COMPUTER STUDY',
            'abbreviation'=> 'CCS',           
            'role'=> User::STUDENT,           
        ]);
        Department::create([
            'name'=> 'COLLEGE OF INDUSTRIAL TECHNOLOGY',
            'abbreviation'=> 'NABA',           
            'role'=> User::STUDENT,           
        ]);
        Department::create([
            'name'=> 'ENGINEERING STUDENTS ORGANIZATION',
            'abbreviation'=> 'ESO',           
            'role'=> User::STUDENT,           
        ]);
    }
}
