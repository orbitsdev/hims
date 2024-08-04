<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bsitId = DB::table('courses')->where('abbreviation', 'BSIT')->value('id');
        $bscsId = DB::table('courses')->where('abbreviation', 'BSCS')->value('id');

        DB::table('sections')->insert([
            ['name' => 'BSIT 1A', 'course_id' => $bsitId],
            ['name' => 'BSIT 1B', 'course_id' => $bsitId],
            ['name' => 'BSIT 1C', 'course_id' => $bsitId],
            ['name' => 'BSIT 1D', 'course_id' => $bsitId],
            ['name' => 'BSIT 2A', 'course_id' => $bsitId],
            ['name' => 'BSIT 2B', 'course_id' => $bsitId],
            ['name' => 'BSIT 2C', 'course_id' => $bsitId],
            ['name' => 'BSIT 2D', 'course_id' => $bsitId],
            ['name' => 'BSIT 3A', 'course_id' => $bsitId],
            ['name' => 'BSIT 3B', 'course_id' => $bsitId],
            ['name' => 'BSIT 3C', 'course_id' => $bsitId],
            ['name' => 'BSIT 3D', 'course_id' => $bsitId],
            ['name' => 'BSIT 4A', 'course_id' => $bsitId],
            ['name' => 'BSIT 4B', 'course_id' => $bsitId],
            ['name' => 'BSIT 4C', 'course_id' => $bsitId],
            ['name' => 'BSIT 4D', 'course_id' => $bsitId],
            ['name' => 'BSCS 1A', 'course_id' => $bscsId],
            ['name' => 'BSCS 1B', 'course_id' => $bscsId],
            ['name' => 'BSCS 1C', 'course_id' => $bscsId],
            ['name' => 'BSCS 1D', 'course_id' => $bscsId],
            // Add more sections as needed
        ]);
    }
}
