<?php

namespace Database\Seeders;

use App\Models\Suggestion;
use Illuminate\Database\Seeder;
use App\Models\BloodPressureLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodPressureLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Hypotension' => [
                'Drink more fluids.',
                'Wear compression stockings.',
                'Consult a doctor if symptoms persist (dizziness, fainting).',
            ],
            'Normal' => [
                'Maintain a balanced diet with plenty of fruits and vegetables.',
                'Exercise regularly (at least 150 minutes per week).',
                'Avoid smoking and limit alcohol intake.'
            ],
            'Elevated' => [
                'Reduce sodium (salt) intake.',
                'Monitor your blood pressure regularly.',
                'Stay physically active and manage stress.'
            ],
            'Hypertension Stage 1' => [
                'Consider lifestyle changes, including dietary modifications.',
                'Consult with your doctor for possible medication.',
                'Regularly monitor your blood pressure.'
            ],
            'Hypertension Stage 2' => [
                'Consult a doctor immediately to discuss medication options.',
                'Follow a strict heart-healthy diet.',
                'Avoid alcohol, and quit smoking if you haven’t already.'
            ],
            'Hypertensive Crisis' => [
                'Seek emergency medical attention immediately.',
                'Avoid stress and follow your doctor’s instructions for emergency care.',
                'Hospitalization may be required, do not delay.'
            ],
        ];

        // Insert each blood pressure level and corresponding suggestions
        foreach ($levels as $status => $suggestions) {
            // Create the blood pressure level
            $level = BloodPressureLevel::create([
                'status' => $status
            ]);

            // Create each suggestion related to the blood pressure level
            foreach ($suggestions as $suggestion) {
                Suggestion::create([
                    'blood_pressure_level_id' => $level->id, // Assuming 'status_id' is the foreign key in the suggestions table
                    'suggestion' => $suggestion
                ]);
            }
        }
    }
}
