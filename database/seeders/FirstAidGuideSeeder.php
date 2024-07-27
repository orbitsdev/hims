<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FirstAidGuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('first_aid_guides')->insert([
            [
                'title' => 'Basic First Aid for Burns',
                'content' => 'Burns can be caused by heat, chemicals, or radiation. The first step is to cool the burn by running cool water over it for 10-15 minutes.',
                'condition_id' => 1, // Burn
               
            ],
            [
                'title' => 'First Aid for Fractures',
                'content' => 'Fractures are breaks or cracks in bones. Immobilize the limb with a splint or sling and seek medical attention immediately.',
                'condition_id' => 2, // Fracture
               
            ],
            [
                'title' => 'Treating Cuts and Scrapes',
                'content' => 'Clean the wound with running water and mild soap. Apply an antiseptic and cover with a sterile bandage.',
                'condition_id' => 3, // Cut
               
            ],
        ]);
    }
}
