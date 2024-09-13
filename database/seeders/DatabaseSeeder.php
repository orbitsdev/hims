<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\BloodPressureLevelSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            AcademicYearSeeder::class,
            DepartmentSeeder::class,
            ConditionSeeder::class,
            SymptonSeeder::class,
            ConditionSymptomSeeder::class,
            TreatmentSeeder::class,
            FirstAidGuideSeeder::class,
            CourseSeeder::class,
            BloodPressureLevelSeeder::class,
            // SectionSeeder::class,
            
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
