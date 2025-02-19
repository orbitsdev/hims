<x-admin-layout>
    <div class="px-6 py-8 bg-white rounded-md min-h-screen">
        {{-- {{$selectedAcademicYear}}
        {{$selectedSemester}} --}}

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 uppercase ">Dashboard Overview</h2>
            {{-- @dump(Auth::user()->hasRoleOf(['Admin','Staff'])) --}}
        </div>

       <!-- Filter Section with Label Button and Width Adjustment -->
<div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Filter Label Button -->


    <!-- Academic Year Filter -->
    <div>
        <label for="academic-year" class="block text-sm font-medium text-gray-700 mb-2">Select Academic Year</label>
        <select id="academic-year" wire:model.live="selectedAcademicYear"
            class="block w-full min-w-[250px] md:min-w-[400px] border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm mt-1  px-3 bg-white">
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
            class="block w-full min-w-[250px] md:min-w-[400px] border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm mt-1  px-3 bg-white">
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
                <p class="text-3xl font-bold text-gray-900">{{$total_users}}</p>
                <p class="text-sm text-gray-500">Total number of users in the system</p>
            </div>
        </div>
    </div>

    <!-- Students -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Students</h3>
                <p class="text-3xl font-bold text-gray-900">{{$total_students}}</p>
                <p class="text-xs text-gray-500">Active students</p>
            </div>
            @if ($total_students > 0)
                <div>
                    <a href="{{ route('students.export') }}"
                       class="flex items-center gap-2 bg-[#106c3b] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export
                    </a>
                </div>
            @endif
        </div>
    </div>


    <!-- Personnels -->
  <!-- Personnels -->
<div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-sm font-semibold text-gray-500">Personnels</h3>
            <p class="text-3xl font-bold text-gray-900">{{$total_personnel}}</p>
            <p class="text-xs text-gray-500">Total personnel involved</p>
        </div>
        @if ($total_personnel > 0)
            <div>
                <a href="{{ route('personnels.export') }}"
                   class="flex items-center gap-2 bg-[#106c3b] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Export
                </a>
            </div>
        @endif
    </div>
</div>


    <!-- Staff -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Staff</h3>
                <p class="text-3xl font-bold text-gray-900">{{$total_staff}}</p>
                <p class="text-xs text-gray-500">Active staff members</p>
            </div>
            @if ($total_staff > 0)
                <div>
                    <a href="{{ route('staff.export') }}"
                       class="flex items-center gap-2 bg-[#106c3b] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Screening -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Screening</h3>
                <p class="text-3xl font-bold text-gray-900">{{$total_screening}}</p>
                <p class="text-xs text-gray-500">Screenings conducted this semester</p>
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
                <p class="text-3xl font-bold text-gray-900">{{$total_medical_record}}</p>
                <p class="text-xs text-gray-500">Total medical records</p>
            </div>
            <div class="text-gray-500">
                <i class="fa-solid fa-file-medical text-2xl"></i>
            </div>
        </div>
    </div>

    @can('admin')


    <!-- Events -->
    <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-500">Events</h3>
                <p class="text-3xl font-bold text-gray-900">{{$total_events}}</p>
                <p class="text-xs text-gray-500">Events created this semester</p>
            </div>
            @if ($total_events > 0)
                <div>
                    <a href="{{ route('events.export') }}"
                       class="flex items-center gap-2 bg-[#106c3b] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export
                    </a>
                </div>
            @endif
        </div>
    </div>
    @endcan

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
                <ul class="space-y-4 overflow-y-auto custom-scrollbar" style="max-height: 300px;">
                    @foreach ($contacts as $contact)
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <a href="{{$contact->getImage()}}">
                            <img src="{{$contact->getImage()}}" alt="{{$contact->name}}" class="w-12 h-12 mr-4 rounded-full object-cover">
                        </a>
                            <div>
                                <h4 class="text-md font-semibold text-gray-900">{{$contact->name}}</h4>
                                <p class="text-sm text-gray-500">{{$contact->contact}}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            @if ($contact->active == true)
                            <p class="text-sm font-semibold text-green-600">{{$contact->textStatus()}}</p>
                            @else
                            <p class="text-sm font-semibold text-gray-600">{{$contact->textStatus()}}</p>
                            @endif
                            <p class="text-xs text-gray-500">Location: {{$contact->address}}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>




            <div class="bg-[#F9F9F9]  border border-[#F2F2F2] p-6 rounded-lg">

                <!-- Chart Section -->
                <div class=" ">
                    <canvas wire:ignore id="myChart"></canvas>
                </div>
            </div>
        </div>




        <div class="bg-[#F9F9F9] border border-[#F2F2F2] p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Blood Pressure Alerts</h3>

            <!-- Blood Pressure Alerts Table -->
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full  text-left">
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Patient Name</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Blood Pressure</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Condition</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($total_not_normal_bp_record as $key=> $medicalRecord )

                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <img src="{{ asset('images/sksu1.png') }}" alt="Patient Image" class="w-10 h-10 mr-4 rounded-full object-cover">
                                <span class="text-md font-semibold text-gray-900">{{$medicalRecord->fullNameLower()}}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">Systolic: {{$medicalRecord->systolic_pressure}} mmHg, Diastolic: {{$medicalRecord->diastolic_pressure}} mmHg</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{$medicalRecord->created_at->format('F j, Y')}}</td>

                        <td class="px-4 py-3">
                            <span class="bg-red-100 text-red-600 text-sm font-semibold px-2 py-1 rounded-lg">{{$medicalRecord->getBloodPressureStatus()}}</span>
                        </td>
                        <td class="px-4 py-3 text-right">

                                <x-filament-actions::group :actions="[
                                    ($this->manageAction)(['record' => $medicalRecord->id]),
                                    ($this->sendSmsAction)(['record' => $medicalRecord->id]),

                                    ($this->sendBloodEmailAlertAction)(['record' => $medicalRecord->id])
                                ]" />



                        </td>
                    </tr>
                    @endforeach

                    {{-- <tr class="border-t">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <img src="{{ asset('images/sksu1.png') }}" alt="Patient Image" class="w-10 h-10 mr-4 rounded-full object-cover">
                                <span class="text-md font-semibold text-gray-900">Jane Smith</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">Systolic: 90 mmHg, Diastolic: 60 mmHg</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Sep 18, 2024</td>
                        <td class="px-4 py-3">
                            <span class="bg-yellow-100 text-yellow-600 text-sm font-semibold px-2 py-1 rounded-lg">Hypotension</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Send Notification</button>
                        </td>
                    </tr>

                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <img src="{{ asset('images/sksu1.png') }}" alt="Patient Image" class="w-10 h-10 mr-4 rounded-full object-cover">
                                <span class="text-md font-semibold text-gray-900">Mark Lee</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">Systolic: 160 mmHg, Diastolic: 95 mmHg</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Sep 15, 2024</td>
                        <td class="px-4 py-3">
                            <span class="bg-red-100 text-red-600 text-sm font-semibold px-2 py-1 rounded-lg">Severe Hypertension</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Send Notification</button>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
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
       <x-filament-actions::modals />
</x-admin-layout>
