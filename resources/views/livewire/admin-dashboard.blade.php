<x-admin-layout>
    <!-- Dashboard Overview Section -->
    <div class="px-6 py-8 bg-white rounded-md min-h-screen">
        <!-- Statistics Cards with Gradients -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Total Users Card with Gradient -->
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 p-6 rounded-lg  text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold">Total Users</h3>
                        <p class="text-3xl font-bold">1,230</p>
                        <p class="text-xs">From Users Table</p>
                    </div>
                    <div class="text-white">
                        <i class="fa-solid fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Medical Records -->
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-6 rounded-lg  text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold">Medical Records</h3>
                        <p class="text-3xl font-bold">850</p>
                        <p class="text-xs">Total Records</p>
                    </div>
                    <div class="text-white">
                        <i class="fa-solid fa-file-medical text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
            <div class="bg-gradient-to-r from-purple-400 to-purple-600 p-6 rounded-lg  text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold">Events</h3>
                        <p class="text-3xl font-bold">25</p>
                        <p class="text-xs">Upcoming Events</p>
                    </div>
                    <div class="text-white">
                        <i class="fa-solid fa-calendar text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
        {{$selectedAcademicYear}}
        {{$selectedSemester}}
           {{-- {{$conditions}}
           <br> --}}
    @php
    print_r($data)
    @endphp
        <div class="mb-6" wire:ignore>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Academic Year Select -->
                <div>
                    <label for="academic-year" class="block text-sm font-medium text-gray-700">Select Academic Year</label>
                    <select id="academic-year" wire:model.live="selectedAcademicYear" class="block w-full mt-1 p-2 border-gray-300 rounded-md">
                        <option value="">Select Year</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Semester Select -->
                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Select Semester</label>
                    <select id="semester" wire:model.live="selectedSemester" class="block w-full mt-1 p-2 text-red border-gray-300 rounded-md">
                        <option value="">Select Semester</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->name_in_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div  >
            <canvas id="myChart"></canvas>
        </div>



        @push('scripts')
        <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.1/dist/echarts.min.js"></script>
        @endpush


    </div>


    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data:{!! json_encode($data) !!},
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-admin-layout>
