<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConditionSymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('condition_symptom')->insert([
            [
                'condition_id' => 1,
                'symptom_id' => 1,
               
            ],
            [
                'condition_id' => 1,
                'symptom_id' => 2,
               
            ],
            [
                'condition_id' => 2,
                'symptom_id' => 1,
               
            ],
            [
                'condition_id' => 3,
                'symptom_id' => 1,
               
            ],
            [
                'condition_id' => 3,
                'symptom_id' => 3,
               
            ],
        ]);
    }
}
