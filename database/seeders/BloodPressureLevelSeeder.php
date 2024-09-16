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
            // Levels for children (age 1-12)
            [
                'level_name' => 'Normal (Child)',
                'systolic_min' => 90,
                'systolic_max' => 110,
                'diastolic_min' => 60,
                'diastolic_max' => 75,
                'age_min' => 1,
                'age_max' => 12,
                'suggestions' => [
                    'Encourage a healthy diet rich in fruits and vegetables',
                    'Maintain regular physical activity',
                    'Monitor blood pressure periodically'
                ]
            ],
            [
                'level_name' => 'Elevated (Child)',
                'systolic_min' => 111,
                'systolic_max' => 120,
                'diastolic_min' => 76,
                'diastolic_max' => 80,
                'age_min' => 1,
                'age_max' => 12,
                'suggestions' => [
                    'Reduce salt intake in the child’s diet',
                    'Increase physical activity',
                    'Consult a pediatrician if levels persist'
                ]
            ],
            [
                'level_name' => 'Hypertension (Child)',
                'systolic_min' => 121,
                'systolic_max' => null, // No upper limit specified
                'diastolic_min' => 81,
                'diastolic_max' => null, // No upper limit specified
                'age_min' => 1,
                'age_max' => 12,
                'suggestions' => [
                    'Seek immediate medical attention',
                    'Limit sugar and salt intake significantly',
                    'Ensure proper medication if prescribed by a doctor'
                ]
            ],

            // Levels for adolescents (age 13-17)
            [
                'level_name' => 'Normal (Adolescent)',
                'systolic_min' => 90,
                'systolic_max' => 120,
                'diastolic_min' => 60,
                'diastolic_max' => 80,
                'age_min' => 13,
                'age_max' => 17,
                'suggestions' => [
                    'Encourage healthy lifestyle choices',
                    'Limit junk food and ensure balanced nutrition',
                    'Regular physical checkups to monitor blood pressure'
                ]
            ],
            [
                'level_name' => 'Elevated (Adolescent)',
                'systolic_min' => 121,
                'systolic_max' => 130,
                'diastolic_min' => 61,
                'diastolic_max' => 80,
                'age_min' => 13,
                'age_max' => 17,
                'suggestions' => [
                    'Encourage exercise and sports activities',
                    'Reduce consumption of salty and sugary snacks',
                    'Consult a healthcare provider if pressure remains high'
                ]
            ],
            [
                'level_name' => 'Hypertension Stage 1 (Adolescent)',
                'systolic_min' => 131,
                'systolic_max' => 139,
                'diastolic_min' => 81,
                'diastolic_max' => 89,
                'age_min' => 13,
                'age_max' => 17,
                'suggestions' => [
                    'Follow a low-sodium diet',
                    'Increase physical activity under medical supervision',
                    'Medication may be necessary; follow the doctor’s advice'
                ]
            ],
            [
                'level_name' => 'Hypertension Stage 2 (Adolescent)',
                'systolic_min' => 140,
                'systolic_max' => null, // No upper limit specified
                'diastolic_min' => 90,
                'diastolic_max' => null, // No upper limit specified
                'age_min' => 13,
                'age_max' => 17,
                'suggestions' => [
                    'Seek immediate medical care',
                    'Strictly follow prescribed medication regimen',
                    'Avoid processed foods and maintain a strict diet'
                ]
            ],

            // Levels for adults (age 18 and above)
            [
                'level_name' => 'Normal (Adult)',
                'systolic_min' => 90,
                'systolic_max' => 120,
                'diastolic_min' => 60,
                'diastolic_max' => 80,
                'age_min' => 18,
                'age_max' => null, // No upper limit for adults
                'suggestions' => [
                    'Maintain a balanced diet and regular exercise',
                    'Routine blood pressure checks',
                    'Avoid excessive stress'
                ]
            ],
            [
                'level_name' => 'Elevated (Adult)',
                'systolic_min' => 121,
                'systolic_max' => 129,
                'diastolic_min' => 61,
                'diastolic_max' => 80,
                'age_min' => 18,
                'age_max' => null,
                'suggestions' => [
                    'Reduce salt and sugar intake',
                    'Increase physical activity',
                    'Monitor blood pressure regularly'
                ]
            ],
            [
                'level_name' => 'Hypertension Stage 1 (Adult)',
                'systolic_min' => 130,
                'systolic_max' => 139,
                'diastolic_min' => 80,
                'diastolic_max' => 89,
                'age_min' => 18,
                'age_max' => null,
                'suggestions' => [
                    'Take prescribed medication',
                    'Follow a low-sodium, heart-healthy diet',
                    'Regular checkups with a healthcare provider'
                ]
            ],
            [
                'level_name' => 'Hypertension Stage 2 (Adult)',
                'systolic_min' => 140,
                'systolic_max' => null, // No upper limit specified
                'diastolic_min' => 90,
                'diastolic_max' => null, // No upper limit specified
                'age_min' => 18,
                'age_max' => null,
                'suggestions' => [
                    'Seek urgent medical advice',
                    'Strictly follow prescribed medications',
                    'Avoid fatty and salty foods completely'
                ]
            ],
            [
                'level_name' => 'Hypertensive Crisis (Adult)',
                'systolic_min' => 180,
                'systolic_max' => null, // No upper limit specified for crisis
                'diastolic_min' => 120,
                'diastolic_max' => null, // No upper limit specified for crisis
                'age_min' => 18,
                'age_max' => null,
                'suggestions' => [
                    'Seek emergency medical care immediately',
                    'Do not ignore symptoms such as chest pain or shortness of breath',
                    'Strictly adhere to prescribed emergency treatments'
                ]
            ]
        ];
        
        // Insert the blood pressure levels and suggestions
        foreach ($levels as $level) {
            // Create the blood pressure level
            $bloodPressureLevel = BloodPressureLevel::create([
                'level_name' => $level['level_name'],
                'systolic_min' => $level['systolic_min'],
                'systolic_max' => $level['systolic_max'],
                'diastolic_min' => $level['diastolic_min'],
                'diastolic_max' => $level['diastolic_max'],
                'age_min' => $level['age_min'],
                'age_max' => $level['age_max'],
            ]);

            // Add suggestions related to the blood pressure level
            foreach ($level['suggestions'] as $suggestionText) {
                Suggestion::create([
                    'blood_pressure_level_id' => $bloodPressureLevel->id,
                    'suggestion' => $suggestionText,
                ]);
            }
        }
    }
}
