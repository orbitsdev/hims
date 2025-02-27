<div class="container mx-auto py-6 px-4 max-w-5xl">
    <!-- Print Button -->
    <div class="text-right mb-4">
        <button onclick="printDiv('printArea')" class="px-4 py-2 bg-gray-600 text-white rounded">
            <i class="fas fa-print"></i> Print Emergency Contacts
        </button>
    </div>

    <!-- Emergency Contact List -->
    <div id="printArea" class="border p-6 shadow-lg bg-white">
        <!-- Header with Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/sksu1.png') }}" alt="University Logo" class="mx-auto w-20">
            <h2 class="text-2xl font-bold">Emergency Contacts List</h2>
            <p class="text-sm text-gray-600">Generated on {{ now()->format('F d, Y') }}</p>
        </div>

        <!-- Emergency Contacts Table -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2 text-left">#</th>
                    <th class="border border-gray-300 p-2 text-left">Name</th>
                    <th class="border border-gray-300 p-2 text-left">Contact</th>
                    <th class="border border-gray-300 p-2 text-left">Address</th>
                    <th class="border border-gray-300 p-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $index => $contact)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 p-2">{{ $contact->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 p-2">{{ $contact->contact ?? 'N/A' }}</td>
                        <td class="border border-gray-300 p-2">{{ $contact->address ?? 'N/A' }}</td>
                        <td class="border border-gray-300 p-2 font-medium">
                            <span class="{{ $contact->active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $contact->active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-gray-300 p-4 text-center text-gray-500">
                            No emergency contacts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
        location.reload();
    }
</script>
