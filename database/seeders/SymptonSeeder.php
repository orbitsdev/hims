<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SymptonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('symptoms')->insert([
            [
                'name' => 'Pain',
                'description' => 'Unpleasant sensory and emotional experience.',
               
            ],
            [
                'name' => 'Swelling',
                'description' => 'Increase in the size or a change in the shape of an area of the body.',
               
            ],
            [
                'name' => 'Redness',
                'description' => 'Red coloring of the skin.',
               
            ],
        ]);
    }
}
