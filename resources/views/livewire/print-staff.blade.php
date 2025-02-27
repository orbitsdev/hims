<div class="container mx-auto py-6 px-4 max-w-3xl">
    <!-- Print Button -->
    <div class="text-right mb-4">
        <button onclick="printDiv('printArea')" class="px-4 py-2 bg-gray-600 text-white rounded">
            <i class="fas fa-print"></i> Print Staff Details
        </button>
    </div>

    <!-- Staff Details -->
    <div id="printArea" class="border p-6 shadow-lg bg-white">
        <!-- Header with Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/sksu1.png') }}" alt="University Logo" class="mx-auto w-20">
            <h2 class="text-2xl font-bold">Staff Details</h2>
            <p class="text-sm text-gray-600">Generated on {{ now()->format('F d, Y') }}</p>
        </div>

        <!-- Staff Personal Information -->
        <h3 class="text-xl font-semibold mb-4">Personal Information</h3>
        <table class="w-full border-collapse border border-gray-300">
            <tr>
                <td class="border border-gray-300 p-2">Full Name:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Phone:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->phone ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Email:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->user->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Address:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Emergency Contact:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->emergency_contact ?? 'N/A' }}</td>
            </tr>
        </table>

        <!-- Employment Information -->
        <h3 class="text-xl font-semibold mt-6 mb-4">Employment Information</h3>
        <table class="w-full border-collapse border border-gray-300">
            <tr>
                <td class="border border-gray-300 p-2">Position:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->position ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Department:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ optional($record->departmentR)->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Employment Type:</td>
                <td class="border border-gray-300 p-2 font-medium">{{ $record->employment_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Status:</td>
                <td class="border border-gray-300 p-2 font-medium">
                    <span class="{{ $record->status ? 'text-green-600' : 'text-red-600' }}">
                        {{ $record->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
            </tr>
            {{-- <tr>
                <td class="border border-gray-300 p-2">Started At:</td>
                <td class="border border-gray-300 p-2 font-medium">
                    {{ $record->started_at ? \Carbon\Carbon::parse($record->started_at)->format('F d, Y') : 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">End At:</td>
                <td class="border border-gray-300 p-2 font-medium">
                    {{ $record->end_at ? \Carbon\Carbon::parse($record->end_at)->format('F d, Y') : 'N/A' }}
                </td>
            </tr> --}}
        </table>

        <!-- Notes -->
        @if ($record->notes)
            <h3 class="text-xl font-semibold mt-6 mb-4">Notes</h3>
            <p class="text-md">{{ $record->notes }}</p>
        @endif

        <!-- Staff Photo -->
        @if ($record->photo)
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4">Staff Photo</h3>
                <img src="{{ asset($record->photo) }}" alt="Staff Photo" class="w-32 h-32 object-cover rounded-md border">
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
