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
    
        <!-- Left Sidebar -->
        

        <!-- Main Section -->
        <div class="mb-8">
            @forelse ($events as $event)
            <div class="bg-white p-6 border border-gray rounded-lg mb-6">
                <!-- Event Header: User Details and Time -->
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center space-x-4">
                        <!-- User Profile Image -->
                        @if ($event->user)
                            <img src="{{ $event->user->getImage() ?? asset('images/sksu1.png') }}" alt="User Profile" class="w-8 h-8 rounded-full">
                        @endif
                        <!-- User Info -->
                        <div>
                            <h4 class="font-bold text-sm">{{ $event->user->name ?? 'Anonymous' }}</h4>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $event->created_at->diffForHumans() }}</span>
                    </div>
                </div>
        
                <!-- Event Title and Content -->
                <div class="mb-4">
                    <h3 class="text-base font-bold">{{ $event->title }}</h3>
                    <p class="text-gray-500 text-sm">
                 {{$event->description ??''}}
                    </p>
                </div>
        
                <!-- Event Image -->
                @if ($event->getImage())
                    <div class="mt-4">
                        <img src="{{ $event->getImage() }}" alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-lg">
                    </div>
                @endif
                <div class="mt-4 ">
                    @markdown($event->content ??'')
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
       
</x-student-layout>

