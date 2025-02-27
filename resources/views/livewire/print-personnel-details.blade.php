<div class="container mx-auto py-6 px-4 max-w-3xl">
    <!-- Print Button -->
    <div class="text-right mb-4">
        <button onclick="printDiv('printArea')" class="px-4 py-2 bg-gray-600 text-white rounded">
            <i class="fas fa-print"></i> Print Personnel Details
        </button>
    </div>

    <!-- Personnel Details -->
    <div id="printArea" class="border p-6 shadow-lg bg-white">
        <!-- Header with Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/sksu1.png') }}" alt="University Logo" class="mx-auto w-20">
            <h2 class="text-2xl font-bold">Personnel Details</h2>
            <p class="text-sm text-gray-600">Generated on {{ now()->format('F d, Y') }}</p>
        </div>

        <!-- Personnel Information -->
        <h3 class="text-xl font-semibold mb-4">Personnel Information</h3>

        <!-- Personnel Details with Profile Image in a Proper 2x2 Layout -->
        <div class="grid grid-cols-2 gap-4 items-start">
            <!-- Left Side - Personnel Details -->
            <div>
                <p class="text-md"><span class="font-medium">Full Name:</span> {{ $record->user->name ?? 'N/A' }}</p>
                <p class="text-md"><span class="font-medium">Department:</span> {{ $record->department->name ?? 'N/A' }}</p>
            </div>

            <!-- Right Side - Profile Image (Aligned) -->
            @if ($record->user->profile_photo_path)
                <div class="flex justify-center">
                    <img src="{{ $record->user->getImage() }}"
                        alt="Personnel Photo"
                        class="w-32 h-32 object-cover rounded-md border">
                </div>
            @endif
        </div>
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
