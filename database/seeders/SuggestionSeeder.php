<?php

namespace Database\Seeders;

use App\Models\Suggestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suggestions')->truncate();
        $suggestions = [
            // Suggestions for children
            [
                'status' => 'Normal',
                'age_group' => 'child',
                'suggestion' => 'Maintain a balanced diet, stay active, and ensure regular checkups with a pediatrician.',
            ],
            [
                'status' => 'Elevated',
                'age_group' => 'child',
                'suggestion' => 'Encourage regular physical activity and a balanced diet. Reduce salt intake.',
            ],
            [
                'status' => 'Hypertension Stage 1',
                'age_group' => 'child',
                'suggestion' => 'Consult with a pediatrician. Consider lifestyle changes such as reducing salt and sugar.',
            ],
            [
                'status' => 'Hypertension Stage 2',
                'age_group' => 'child',
                'suggestion' => 'Consult a pediatrician immediately. Medication and lifestyle changes may be required.',
            ],
            [
                'status' => 'Hypertensive Crisis',
                'age_group' => 'child',
                'suggestion' => 'This is a medical emergency. Seek immediate medical attention to prevent serious complications.',
            ],

            // Suggestions for adolescents
            [
                'status' => 'Normal',
                'age_group' => 'adolescent',
                'suggestion' => 'Maintain a healthy diet, stay physically active, and monitor blood pressure regularly.',
            ],
            [
                'status' => 'Elevated',
                'age_group' => 'adolescent',
                'suggestion' => 'Reduce salt intake, increase exercise, and monitor blood pressure regularly.',
            ],
            [
                'status' => 'Hypertension Stage 1',
                'age_group' => 'adolescent',
                'suggestion' => 'Consult a doctor and consider medication if necessary. Maintain a healthy lifestyle.',
            ],
            [
                'status' => 'Hypertension Stage 2',
                'age_group' => 'adolescent',
                'suggestion' => 'Seek medical advice. Medication and significant lifestyle changes may be required.',
            ],
            [
                'status' => 'Hypertensive Crisis',
                'age_group' => 'adolescent',
                'suggestion' => 'This is a medical emergency. Seek immediate medical attention to avoid severe complications.',
            ],

            // Suggestions for adults
            [
                'status' => 'Normal',
                'age_group' => 'adult',
                'suggestion' => 'Continue to maintain a healthy lifestyle. Monitor your blood pressure regularly.',
            ],
            [
                'status' => 'Elevated',
                'age_group' => 'adult',
                'suggestion' => 'Monitor your blood pressure regularly, reduce stress, and consult a doctor if needed.',
            ],
            [
                'status' => 'Hypertension Stage 1',
                'age_group' => 'adult',
                'suggestion' => 'Consider lifestyle changes such as reducing salt and increasing physical activity. Consult a doctor.',
            ],
            [
                'status' => 'Hypertension Stage 2',
                'age_group' => 'adult',
                'suggestion' => 'Seek medical advice. Medications may be necessary along with lifestyle adjustments.',
            ],
            [
                'status' => 'Hypertensive Crisis',
                'age_group' => 'adult',
                'suggestion' => 'This is a medical emergency. Seek immediate medical attention to avoid life-threatening complications.',
            ],
        ];

        foreach ($suggestions as $suggestion) {
            Suggestion::create($suggestion);
        }
    }
}
