<div class="container mx-auto py-6">
    <div class="bg-white p-6 shadow-md rounded-lg">

        <!-- Record Header -->
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl font-bold">Medical Record: {{ $medicalRecord->record_title ?? 'N/A' }}</h2>
                <p class="text-gray-500">Date of Examination: {{ $medicalRecord->date_of_examination ?? 'N/A' }}</p>
            </div>
            <div>
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Download PDF</button>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700">Patient Information</h3>
            <ul class="space-y-2 mt-2">
                <li><strong>Name:</strong> {{ $medicalRecord->first_name }} {{ $medicalRecord->last_name }}</li>
                <li><strong>Email:</strong> {{ $medicalRecord->email ?? 'N/A' }}</li>
                <li><strong>Age:</strong> {{ $medicalRecord->age ?? 'N/A' }}</li>
                <li><strong>Weight:</strong> {{ $medicalRecord->weight }} kg</li>
                <li><strong>Height:</strong> {{ $medicalRecord->height }} cm</li>
                <li><strong>Civil Status:</strong> {{ $medicalRecord->civil_status ?? 'N/A' }}</li>
            </ul>
        </div>

        <!-- Medical Information -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700">Medical Information</h3>
            <ul class="space-y-2 mt-2">
                <li><strong>Temperature:</strong> {{ $medicalRecord->temperature }} °C</li>
                <li><strong>Blood Pressure:</strong> {{ $medicalRecord->systolic_pressure }}/{{ $medicalRecord->diastolic_pressure }} mmHg</li>
                <li><strong>Heart Rate:</strong> {{ $medicalRecord->heart_rate }} bpm</li>
                <li><strong>Diagnoses:</strong> {{ $medicalRecord->diagnoses ?? 'N/A' }}</li>
                <li><strong>Remarks:</strong> {{ $medicalRecord->remarks ?? 'N/A' }}</li>
            </ul>
        </div>

        <!-- Physician Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-700">Physician Information</h3>
            <ul class="space-y-2 mt-2">
                <li><strong>Physician:</strong> {{ $medicalRecord->physician_name ?? 'N/A' }}</li>
                <li><strong>Release By:</strong> {{ $medicalRecord->release_by ?? 'N/A' }}</li>
            </ul>
        </div>
    </div>
</div>
