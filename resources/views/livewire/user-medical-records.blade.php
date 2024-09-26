<x-student-layout>
    <div class="container mx-auto py-6 px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Medical Records</h1>
        </div>

        <!-- Check if there are any academic years -->
        @if ($academicYears->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($academicYears as $academicYear)
                    <div class="bg-white border border-gray-200 rounded-lg  p-6  hover:bg-[#f2f4f1] hover:shadow-sm">
                        <!-- Academic Year Header -->
                        <h3 class="text-xl font-bold text-gray-700 mb-4">{{ $academicYear->name }}</h3>

                        @forelse ($academicYear->semesters as $semester)
                            <div class="mb-4 ">
                                <!-- Semester Info -->
                                <h4 class="text-lg font-semibold text-gray-600">{{ $semester->name_in_text }}</h4>
                                <ul class="space-y-4">
                                    @forelse ($semester->records as $record)
                                        <li class="flex items-start space-x-4">
                                            <div class="flex-1">
                                                <!-- Record Title -->
                                                <p class="text-md font-medium text-gray-900">{{ $record->title }}</p>

                                                <!-- Medical Record Details -->
                                                @forelse ($record->medicalRecords as $medicalRecord)
                                                    <div class="flex justify-between mt-2 items-center">
                                                        <a href="{{ route('medical-record-details', ['id' => $medicalRecord->id]) }}"
                                                            class="text-kaitoke-green-700 text-md underline hover:underline">
                                                            {{ $medicalRecord->created_at->format('F d, Y H:i A') }}
                                                        </a>
                                                        <i class="fas fa-file-medical-alt text-kaitoke-green-700"></i>
                                                    </div>
                                                @empty
                                                    <p class="text-gray-500">No medical records available.</p>
                                                @endforelse
                                            </div>
                                        </li>
                                    @empty
                                        <p class="text-gray-500">No records available for this semester.</p>
                                    @endforelse
                                </ul>
                            </div>
                        @empty
                            <p class="text-gray-500">No semesters available for this academic year.</p>
                        @endforelse
                    </div>
                @empty
                    <p class="text-gray-500">No academic years available.</p>
                @endforelse
            </div>
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-20">
                <i class="fas fa-folder-open text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-3xl font-semibold text-gray-600 mb-4">No Medical Records Found</h3>
                <p class="text-lg text-gray-500">It seems that there are no medical records available at the moment. Please check again later.</p>
            </div>
        @endif
    </div>
</x-student-layout>
