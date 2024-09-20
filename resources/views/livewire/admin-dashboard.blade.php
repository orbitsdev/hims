<x-admin-layout>
    <div class="px-6 py-8 bg-white rounded-md min-h-screen">
        {{$selectedAcademicYear}}
        {{$selectedSemester}}
       <!-- Filter Section with Label Button and Width Adjustment -->
<div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Filter Label Button -->


    <!-- Academic Year Filter -->
    <div>
        <label for="academic-year" class="block text-sm font-medium text-gray-700 mb-2">Select Academic Year</label>
        <select id="academic-year" wire:model.live="selectedAcademicYear"
            class="block w-full min-w-[250px] md:min-w-[400px] border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm mt-1 p-3 bg-white">
            <option value="">Select Year</option>
            @foreach ($academicYears as $year)
                <option value="{{ $year->id }}">{{ $year->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Semester Filter -->
    <div>
        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Select Semester</label>
        <select id="semester" wire:model.live="selectedSemester"
            class="block w-full min-w-[250px] md:min-w-[400px] border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm mt-1 p-3 bg-white">
            <option value="">Select Semester</option>
            @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}">{{ $semester->name_in_number }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center mb-4">
        {{-- <button class="border border-gray-300 rounded-full px-4 py-2 text-sm flex items-center">
            <i class="fa-solid fa-filter mr-2"></i> Filters
        </button> --}}
    </div>
</div>


        <!-- Statistics Cards with Minimal Design -->
<!-- Dashboard Cards Section -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <!-- System Users -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">System Users</h3>
                <p class="text-3xl font-bold text-gray-900">1,000</p>
                <p class="text-sm text-gray-500">Total number of users in the system</p>
            </div>
        </div>
    </div>

    <!-- Students -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Students</h3>
                <p class="text-3xl font-bold text-gray-900">123,000</p>
                <p class="text-sm text-red-500">↓ 5% from last month</p>
                <p class="text-xs text-gray-500">Active students</p>
            </div>
        </div>
    </div>

    <!-- Personnels -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Personnels</h3>
                <p class="text-3xl font-bold text-gray-900">24,000</p>
                <p class="text-sm text-red-500">↓ 71% of total personnel targets</p>
                <p class="text-xs text-gray-500">Total personnel involved</p>
            </div>
        </div>
    </div>

    <!-- Staff -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Staff</h3>
                <p class="text-3xl font-bold text-gray-900">423</p>
                <p class="text-sm text-green-500">↑ 22% higher than last quarter</p>
                <p class="text-xs text-gray-500">Active staff members</p>
            </div>
        </div>
    </div>

    <!-- Screening -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Screening</h3>
                <p class="text-3xl font-bold text-gray-900">1,230</p>
                <p class="text-xs text-gray-500">Screenings conducted this year</p>
            </div>
            <div class="text-gray-500">
                <i class="fa-solid fa-users text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Medical Records -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Medical Records</h3>
                <p class="text-3xl font-bold text-gray-900">850</p>
                <p class="text-xs text-gray-500">Total medical records</p>
            </div>
            <div class="text-gray-500">
                <i class="fa-solid fa-file-medical text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Events -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Events</h3>
                <p class="text-3xl font-bold text-gray-900">25</p>
                <p class="text-xs text-gray-500">Events created this year</p>
            </div>
            <div class="text-gray-500">
                <i class="fa-solid fa-calendar text-2xl"></i>
            </div>
        </div>
    </div>
</div>



        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Emergency Contacts Section -->
            <!-- Emergency Contacts Section with Images -->
<div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg ">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-700">Emergency Contacts</h3>
        <i class="fa-solid fa-ellipsis-vertical text-gray-500"></i>
    </div>

    <!-- Emergency Contact List -->
    <ul class="space-y-4">
        <!-- Police Contact -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{asset('images/sksu1.png')}}" alt="Police" class="w-12 h-12 mr-4 rounded-full object-cover">
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Police</h4>
                    <p class="text-sm text-gray-500">Emergency Hotline: 117</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-green-600">Active</p>
                <p class="text-xs text-gray-500">ID: 0JWEJS7SNC</p>
            </div>
        </li>

        <!-- 911 Emergency Contact -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{asset('images/sksu1.png')}}" alt="911" class="w-12 h-12 mr-4 rounded-full object-cover">
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Emergency 911</h4>
                    <p class="text-sm text-gray-500">National Emergency Hotline</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-green-600">Active</p>
                <p class="text-xs text-gray-500">ID: 0JWEJS7SNC</p>
            </div>
        </li>

        <!-- Fire Department Contact -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{asset('images/sksu1.png')}}" alt="Fire Department" class="w-12 h-12 mr-4 rounded-full object-cover">
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Fire Department</h4>
                    <p class="text-sm text-gray-500">Fire Hotline: 160</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-green-600">Active</p>
                <p class="text-xs text-gray-500">ID: 0JWEJS7SNC</p>
            </div>
        </li>

        <!-- Doctor Contact -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{asset('images/sksu1.png')}}" alt="Doctor" class="w-12 h-12 mr-4 rounded-full object-cover">
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Doctor</h4>
                    <p class="text-sm text-gray-500">Medical Assistance: +63 912 345 6789</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-green-600">Active</p>
                <p class="text-xs text-gray-500">ID: 0JWEJS7SNC</p>
            </div>
        </li>

        <!-- Health Hotline -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{asset('images/sksu1.png')}}" alt="Health Hotline" class="w-12 h-12 mr-4 rounded-full object-cover">
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Health Hotline</h4>
                    <p class="text-sm text-gray-500">+63 922 111 2222</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-green-600">Active</p>
                <p class="text-xs text-gray-500">ID: 0JWEJS7SNC</p>
            </div>
        </li>
    </ul>
</div>


            <div class="bg-[#F9F9F9]  border border-[#F2F2F2] p-6 rounded-lg">

                <!-- Chart Section -->
                <div class=" ">
                    <canvas wire:ignore id="myChart"></canvas>
                </div>
            </div>
        </div>





        <!-- Abnormal Blood Pressure Section -->
<div class="bg-[#F9F9F9]  border border-[#F2F2F2] p-6 rounded-lg ">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Abnormal Blood Pressure Records</h3>

    <!-- Blood Pressure List -->
    <ul class="space-y-4">
        <!-- Blood Pressure Record 1 -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <i class="fa-solid fa-exclamation-circle text-red-500 text-3xl mr-4"></i>
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Patient: John Doe</h4>
                    <p class="text-sm text-gray-500">Systolic: 140 mmHg, Diastolic: 90 mmHg</p>
                    <p class="text-xs text-gray-400">Date: Sep 20, 2024</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-red-600">Hypertension</p>
            </div>
        </li>

        <!-- Blood Pressure Record 2 -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <i class="fa-solid fa-exclamation-circle text-red-500 text-3xl mr-4"></i>
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Patient: Jane Smith</h4>
                    <p class="text-sm text-gray-500">Systolic: 90 mmHg, Diastolic: 60 mmHg</p>
                    <p class="text-xs text-gray-400">Date: Sep 18, 2024</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-yellow-600">Hypotension</p>
            </div>
        </li>

        <!-- Blood Pressure Record 3 -->
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <i class="fa-solid fa-exclamation-circle text-red-500 text-3xl mr-4"></i>
                <div>
                    <h4 class="text-md font-semibold text-gray-900">Patient: Mark Lee</h4>
                    <p class="text-sm text-gray-500">Systolic: 160 mmHg, Diastolic: 95 mmHg</p>
                    <p class="text-xs text-gray-400">Date: Sep 15, 2024</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-red-600">Severe Hypertension</p>
            </div>
        </li>
    </ul>
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
