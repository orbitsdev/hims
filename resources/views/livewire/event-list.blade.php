{{-- <x-student-layout>
    <div class="container mx-auto flex py-6">
        <main class="flex-1 mx-8  max-w-4xl mx-auto">
            <div class="space-y-6">
                @forelse ($events as $event)
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <!-- Event Header: User Details and Time -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <!-- User Profile Image -->
                                @if ($event->user)
                                    <img src="{{ $event->user->getImage() ?? asset('images/sksu1.png') }}"
                                        alt="User Profile" class="w-10 h-10 rounded-full">
                                @endif
                                <!-- User Info -->
                                <div>
                                    <h4 class="font-bold">{{ $event->user->name ?? 'Anonymous' }}</h4>
                                    <p class="text-sm text-gray-500">{{ $event->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Event Image -->
                        @if ($event->getImage())
                            <div class="mt-4">
                                <img src="{{ $event->getImage() }}" alt="{{ $event->title }}" class="w-full max-h-64 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- Event Title and Content -->
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-500">
                                @markdown($event->content ?? '')
                            </p>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="flex flex-col items-center justify-center py-20 space-y-4">
                        <img src="{{ asset('images/placeholder-image.jpg') }}" alt="No Events" class="w-48 h-48 mb-6">
                        <h3 class="text-3xl font-bold text-gray-600">No Events Available</h3>
                        <p class="text-lg text-gray-500 text-center max-w-md">
                            There are no events at the moment. Please check back later or create a new event.
                        </p>
                    </div>
                @endforelse
            </div>
            @dump($academicYears)
        @if ($academicYears->isNotEmpty())  
        <aside class="w-1/4 bg-white max-h-screen p-4 rounded-lg overflow-y-auto">
            <h4 class="text-lg font-bold mb-4">Medical Records</h4>

           
                <ul class="space-y-4">
                    @forelse ($academicYears as $academicYear)
                        <li>
                            <h5 class="font-semibold text-gray-700 ">{{ $academicYear->name }}</h5>
                            @forelse ($academicYear->semesters as $semester)
                                <div class="ml-4">
                                    <h6 class="text-md font-semibold text-gray-600">{{ $semester->name_in_text }}</h6>
                                    <ul class="space-y-2">
                                        @forelse ($semester->records as $record)
                                            <li class="flex items-center space-x-3">
                                                <div>
                                                    <p class="text-sm font-semibold">{{ $record->title }}</p>

                                                    <!-- Loop through medical records under each record -->
                                                    @forelse ($record->medicalRecords as $medicalRecord)
                                                        <!-- Link to the medical record details route -->
                                                        <a href="{{ route('medical-record-details', ['id' => $medicalRecord->id]) }}"
                                                            class="text-blue-500 hover:underline">
                                                            {{ $medicalRecord->created_at->format('F d, Y H:i:s') }}
                                                        </a>
                                                    @empty
                                                        <p>No medical records available.</p>
                                                    @endforelse
                                                </div>
                                            </li>
                                        @empty
                                            <p>No records available for this semester.</p>
                                        @endforelse
                                    </ul>
                                </div>
                            @empty
                            @endforelse
                        </li>
                    @empty
                    @endforelse
                </ul>
          
        </aside>
        @endif
    </div>
</x-student-layout> --}}


<x-student-layout>
    <div class="flex space-x-8 p-4">
        <!-- Left Sidebar -->
        <div class="w-1/4 bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-col items-center">
                <img src="{{Auth::user()->getImage()}}" alt="Profile Image" class="border rounded-full mb-4">
                <h2 class="text-xl font-semibold">{{Auth::user()->name}}</h2>
                <p class="text-gray-500 mb-4">{{Auth::user()->email}}</p>

                <div class="flex space-x-3 mb-4">
                    <button class="bg-gray-100 p-4 rounded-full">
                       
                    </button>
                    <button class="bg-gray-100 p-4 rounded-full">
                    </button>
                    <button class="bg-gray-100 p-4 rounded-full">
                    </button>
                </div>
                <a href="{{ route('edit-profile', ['record' => Auth::user()]) }}" class="bg-kaitoke-green-600 text-white w-full py-2 rounded-lg block text-center">Update Profile</a>
            </div>

        </div>

        <!-- Main Section -->
        <div class="w-2/3 bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center border-b pb-2 mb-4">
                <div class="flex space-x-4">
                    <button class="text-gray-600 font-semibold border-b-2 border-orange-500">Events</button>
                    <button class="text-gray-600 font-semibold">FirstAids</button>
                    <button class="text-gray-600 font-semibold">Notifications</button>
                    <button class="text-gray-600 font-semibold">Medical Records</button>

                </div>
            </div>

            <!-- Add New Note -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Add new note</h3>
                <textarea class="w-full border rounded-lg p-4 mb-2" rows="4" placeholder="Note title"></textarea>
                <textarea class="w-full border rounded-lg p-4" rows="6" placeholder="Note description"></textarea>
                <button class="mt-4 bg-kaitoke-green-600 text-white py-2 px-4 rounded-lg">Add note</button>
            </div>

            <!-- Existing Notes -->
            <div>
                <div class="border rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-gray-600 font-bold">Note by Esther Howard</h3>
                        <span class="text-gray-400 text-sm">Today, 12:00 PM</span>
                    </div>
                    <p class="mb-4">This is note title</p>
                    <p class="text-gray-500">She's interested in our new product line and wants our very best price. Please include a detailed breakdown of costs.</p>
                </div>

                <div class="border rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-gray-600 font-bold">Note by Esther Howard</h3>
                        <span class="text-gray-400 text-sm">Today, 12:00 PM</span>
                    </div>
                    <p class="mb-4">This is note title</p>
                    <p class="text-gray-500">She's interested in our new product line and wants our very best price. Please include a detailed breakdown of costs.</p>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="w-1/4 bg-white rounded-lg shadow-md p-6">
            <div class="mb-8">
                <h3 class="text-gray-600 font-bold">Latest Medical Record</h3>
                <p class="text-gray-400">2021-2022.</p>
                <p class="text-gray-400">First Semester </p>
                <p class="text-gray-400">Dental CheckUp For Sksu Student</p>
            </div>

            <div class="mb-8">
                <h3 class="text-gray-600 font-bold">Vital Signs</h3>
                <div class="border rounded-lg p-4 mb-2">
                    <p class="text-sm">Closing date: 18 Jan 2021</p>
                    <p class="text-sm font-semibold">Web Development</p>
                    <p class="text-orange-500 font-semibold">$120,000</p>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>

