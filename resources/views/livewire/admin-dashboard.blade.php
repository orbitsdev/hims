<x-admin-layout>
    <div class="px-6 py-8 bg-white rounded-md min-h-screen">
        <!-- Statistics Cards with Gradients -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 p-6 rounded-lg shadow-lg text-white transition-transform transform hover:scale-105">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold">Total Users</h3>
                        <p class="text-3xl font-bold">1,230</p>
                        <p class="text-xs">From Users Table</p>
                    </div>
                    <div class="text-white">
                        <i class="fa-solid fa-users text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Medical Records -->
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-6 rounded-lg shadow-lg text-white transition-transform transform hover:scale-105">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold">Medical Records</h3>
                        <p class="text-3xl font-bold">850</p>
                        <p class="text-xs">Total Records</p>
                    </div>
                    <div class="text-white">
                        <i class="fa-solid fa-file-medical text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
            <div class="bg-gradient-to-r from-purple-400 to-purple-600 p-6 rounded-lg shadow-lg text-white transition-transform transform hover:scale-105">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold">Events</h3>
                        <p class="text-3xl font-bold">25</p>
                        <p class="text-xs">Upcoming Events</p>
                    </div>
                    <div class="text-white">
                        <i class="fa-solid fa-calendar text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dropdown Section for Academic Year and Semester -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="academic-year" class="block text-sm font-medium text-gray-700">Select Academic Year</label>
                <select id="academic-year" wire:model.live="selectedAcademicYear"
                    class="block w-full border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm mt-1 p-2">
                    <option value="">Select Year</option>
                    @foreach ($academicYears as $year)
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700">Select Semester</label>
                <select id="semester" wire:model.live="selectedSemester"
                    class="block w-full border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm mt-1 p-2">
                    <option value="">Select Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->name_in_number }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-lg">
            <canvas wire:ignore id="myChart"></canvas>
        </div>
    </div>

    <script>
        let chart = null;
        const ctx = document.getElementById('myChart');

        console.log({!! json_encode($data) !!});
    
     
        function initOrUpdateChart(data) {
            if (chart) {
                chart.destroy(); 
            }
    
            
            chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    
    
        let chartData = {!! json_encode($data) !!};
        initOrUpdateChart(chartData);
    
        document.addEventListener('livewire:init', () => {
            Livewire.on('chart-updated', (updatedData) => { 
                initOrUpdateChart(updatedData[0]); 
            });
        });
    </script>
</x-admin-layout>
