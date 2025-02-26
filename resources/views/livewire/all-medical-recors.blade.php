<div class="container mx-auto ">
    <!-- Header Section -->
    {{-- <div class="mb-6">
        <h1 class="text-4xl font-bold text-gray-800">Medical Records</h1>
    </div> --}}

    <!-- Check if there are any medical records -->
    @if ($record->medicalRecords->isNotEmpty())
        <ul class="space-y-4">
            @foreach ($record->medicalRecords as $medicalRecord)
                <li class="border-b pb-3">
                    <a href="#" class="text-orange-600 hover:text-orange-800 text-lg font-semibold underline">
                        {{ $medicalRecord->record_title ?? 'Untitled Record' }}
                    </a>
                    <p class="text-sm text-gray-500">
                        Date of Examination:
                        <span class="font-medium">
                            {{ $medicalRecord->date_of_examination ? \Carbon\Carbon::parse($medicalRecord->date_of_examination)->format('F d, Y') : 'N/A' }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-500">
                        Condition:
                        <span class="font-medium">{{ $medicalRecord->condition_name ?? 'Not Specified' }}</span>
                    </p>
                </li>
            @endforeach
        </ul>
    @else
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center py-20">
            <i class="fas fa-folder-open text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-3xl font-semibold text-gray-600 mb-4">No Medical Records Found</h3>
            <p class="text-lg text-gray-500">You do not have any medical records at the moment.</p>
        </div>
    @endif
</div>
