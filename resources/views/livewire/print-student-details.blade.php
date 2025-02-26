<div class="container mx-auto py-6 px-4 max-w-3xl">
    <!-- Print Button -->
    <div class="text-right mb-4">
        <button onclick="printDiv('printArea')" class="px-4 py-2 bg-gray-600 text-white rounded">
            <i class="fas fa-print"></i> Print Student Details
        </button>
    </div>

    <!-- Student Details -->
    <div id="printArea" class="border p-6 shadow-lg bg-white">
        <!-- Header with Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/sksu1.png') }}" alt="University Logo" class="mx-auto w-20">
            <h2 class="text-2xl font-bold">Student Details</h2>
            <p class="text-sm text-gray-600">Generated on {{ now()->format('F d, Y') }}</p>
        </div>

        <!-- Student Information -->
        <h3 class="text-xl font-semibold mb-4">Personal Information</h3>
        <p class="text-md"><span class="font-medium">Full Name:</span>
            {{ $record->personalDetail->first_name ?? 'N/A' }}
            {{ $record->personalDetail->middle_name ?? '' }}
            {{ $record->personalDetail->last_name ?? 'N/A' }}
        </p>
        <p class="text-md"><span class="font-medium">Maiden Name:</span> {{ $record->personalDetail->maiden_name ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Age:</span> {{ $record->personalDetail->age ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Civil Status:</span> {{ $record->personalDetail->civil_status ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Date of Birth:</span>
            {{ $record->personalDetail->birth_date ? \Carbon\Carbon::parse($record->personalDetail->birth_date)->format('F d, Y') : 'N/A' }}
        </p>
        <p class="text-md"><span class="font-medium">Birth Place:</span> {{ $record->personalDetail->birth_place ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Address:</span> {{ $record->personalDetail->address ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Phone:</span> {{ $record->personalDetail->phone ?? 'N/A' }}</p>

        <!-- Academic Information -->
        <h3 class="text-xl font-semibold mt-6 mb-4">Academic Information</h3>
        <p class="text-md"><span class="font-medium">ID Number:</span> {{ $record->id_number ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Department:</span> {{ $record->department?->name ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Course:</span> {{ $record->course?->name ?? 'N/A' }}</p>
        <p class="text-md"><span class="font-medium">Section:</span> {{ $record->section?->name ?? 'N/A' }}</p>

        <!-- Student Photo -->
        @if ($record->image)
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4">Student Photo</h3>
                <img src="{{ asset($record->image) }}" alt="Student Photo" class="w-32 h-32 object-cover rounded-md border">
            </div>
        @endif
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
