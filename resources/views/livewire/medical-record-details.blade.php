<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<x-student-layout>
<div class="container mx-auto ">
    <div class="flex justify-end ">
        <a href="{{ route('user.medical-records') }}" class="text-gray-400 hover:text-kaitoke-green-600 inline-flex items-center">
            <i class="fa-regular fa-circle-xmark text-3xl"></i>
        </a>
    </div>

    <!-- Medical Record Details (Wrap in a div to target print) -->

    <div class="flex items-center justify-between mb-4 mt-2">
        <div>
            <h2 class="text-xl font-bold">Medical Record: {{ $medicalRecord->record_title ?? 'N/A' }}</h2>
            <p class="text-gray-500">Date of Examination: {{ $medicalRecord->medicalCreated() ?? 'N/A' }}</p>
        </div>
        <div class="flex space-x-4">
            <!-- Download PDF Button -->
            <a href="{{ route('reports.medical-record', ['record' => $medicalRecord]) }}" class="block px-4 py-2 bg-kaitoke-green-600 text-white rounded hover:bg-green-600" target="_blank">
                <i class="fa-solid fa-file-pdf mr-2"></i> Download PDF
            </a>

            <!-- Print Button -->
            <button onclick="printDiv('printableArea')" class="block px-4 py-2 bg-blue-500 text-white rounded hover:bg-kaitoke-green-600">
                <i class="fa-solid fa-print mr-2"></i> Print
            </button>
        </div>
    </div>
    <div id="printableArea" class="bg-white mt-4">

        <!-- Record Header -->


        <!-- Personal Information -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700">Personal Information</h3>
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
</x-student-layout>
