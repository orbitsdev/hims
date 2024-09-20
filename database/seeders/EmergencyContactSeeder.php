<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmergencyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('emergency_contacts')->insert([
            [
                'name' => 'School Clinic',
                'contact' => '09876544235',
                'image' => null, // Add an image path if available
                'address' => 'Isulan, Sultan Kudarat', // Add an image path if available
            ],
            [
                'name' => 'SKPH',
                'contact' => '(064) 201 3033',
                'image' => null, // Add an image path if available
                'address' => 'Isulan, Sultan Kudarat', // Add an image path if available
            ],
            [
                'name' => 'Matias Clinic and Hospital',
                'contact' => '09276046943',
                'image' => null, // Add an image path if available
                'address' => 'Isulan, Sultan Kudarat', // Add an image path if available
            ],
            [
                'name' => 'MDRRM/RESCUE',
                'contact' => '09658611541',
                'image' => null, // Add an image path if available
                'address' => 'Isulan, Sultan Kudarat', // Add an image path if available
            ],
            [
                'name' => 'Galinato Family Clinic and Hospital',
                'contact' => '(664) 565 120',
                'image' => null, // Add an image path if available
                'address' => 'Isulan, Sultan Kudarat', // Add an image path if available
            ],
        ]);
    }
}
