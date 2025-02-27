<div>
    <div class="container mx-auto py-6 px-4 max-w-3xl">
        <!-- Print Button -->
        <div class="text-right mb-4">
            <button onclick="printDiv('printArea')" class="px-4 py-2 bg-gray-600 text-white rounded">
                Print Report
            </button>
        </div>

        <div id="printArea" class="border p-6 shadow-lg bg-white">
            <!-- Header with Logo -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/sksu1.png') }}" alt="University Logo" class="mx-auto w-20">
                <h2 class="text-2xl font-bold">Medical Examination Report</h2>
                <p class="text-sm text-gray-600">Generated on {{ now()->format('F d, Y') }}</p>
            </div>

            <!-- Patient Information -->
            <h3 class="text-xl font-semibold mb-4">Patient Information</h3>

            <!-- Patient Details with Profile Image in a Proper 2x2 Layout -->
            <div class="grid grid-cols-2 gap-4 items-start">
                <!-- Left Side - Patient Details -->
                <div>
                    <p class="text-md"><span class="font-medium">Full Name:</span> {{ $record?->first_name }} {{ $record?->middle_name }} {{ $record?->last_name }}</p>
                    <p class="text-md"><span class="font-medium">Age:</span> {{ $record->age ?? 'N/A' }}</p>
                    <p class="text-md"><span class="font-medium">Date of Birth:</span>
                        {{ $record?->birth_date ? \Carbon\Carbon::parse($record?->birth_date)->format('F d, Y') : 'N/A' }}
                    </p>
                    <p class="text-md"><span class="font-medium">Phone:</span> {{ $record->phone ?? 'N/A' }}</p>
                    <p class="text-md"><span class="font-medium">Email:</span> {{ $record->email ?? 'N/A' }}</p>
                    <p class="text-md"><span class="font-medium">Address:</span> {{ $record->address ?? 'N/A' }}</p>
                </div>

                <!-- Right Side - Profile Image (Centered) -->
                @if ($record->user->profile_photo_path)
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $record->user->profile_photo_path) }}"
                            alt="Patient Photo"
                            class="w-32 h-32 object-cover rounded-md border">
                    </div>
                @endif
            </div>

            <!-- Medical Examination Table -->
            <h3 class="text-xl font-semibold mt-6 mb-4">Medical Examination</h3>
            <table class="w-full border-collapse border border-gray-300">
                <tr>
                    <td class="border border-gray-300 p-2">Date of Examination:</td>
                    <td class="border border-gray-300 p-2 font-medium">
                        {{ $record->date_of_examination ? \Carbon\Carbon::parse($record->date_of_examination)->format('F d, Y') : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Condition:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->condition_name ?? 'Not Specified' }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Physician:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->physician_name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Blood Pressure:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->blood_pressure ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Temperature:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->temperature ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Heart Rate:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->heart_rate ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Allergies:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->allergies ?? 'None Reported' }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Past Illness:</td>
                    <td class="border border-gray-300 p-2 font-medium">{{ $record->past_illness ?? 'None' }}</td>
                </tr>
            </table>

            <!-- Additional Remarks -->
            <h3 class="text-xl font-semibold mt-6 mb-4">Remarks & Diagnosis</h3>
            <p class="text-md">{{ $record->remarks ?? 'No additional remarks.' }}</p>

            <!-- Release Info -->
            <h3 class="text-xl font-semibold mt-6 mb-4">Release Information</h3>
            <p class="text-md"><span class="font-medium">Released by:</span> {{ $record->release_by ?? 'N/A' }}</p>
            <p class="text-md"><span class="font-medium">Final Diagnosis:</span> {{ $record->specified_diagnoses ?? 'Pending' }}</p>
        </div>
    </div>

    <!-- Print Function -->
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>
