<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('treatments')->insert([
            [
                'condition_id' => 1, // Burn
                'name' => 'Cool the burn',
                'description' => 'Run cool (not cold) water over the burn for 10-15 minutes.',
               
            ],
            [
                'condition_id' => 1, // Burn
                'name' => 'Cover the burn',
                'description' => 'Cover the burn with a sterile, non-adhesive bandage or clean cloth.',
               
            ],
            [
                'condition_id' => 2, // Fracture
                'name' => 'Immobilize the limb',
                'description' => 'Use a splint or sling to immobilize the limb.',
               
            ],
            [
                'condition_id' => 3, // Cut
                'name' => 'Clean the wound',
                'description' => 'Rinse the wound under running water and clean it with mild soap.',
               
            ],
        ]);
    }
}
