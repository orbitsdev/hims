{{-- <x-student-layout>
    <div class="container mx-auto px-4 py-6 max-w-3xl">
        @if ($events->isNotEmpty())
            <div class="space-y-6">
                @foreach($events as $event)
                    <div class="bg-white p-6 shadow-lg rounded-lg relative">
                        <!-- User Info -->
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="{{ asset('images/user-placeholder.png') }}" alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">John Doe</h3> <!-- Replace with dynamic user data -->
                                <p class="text-sm text-gray-500">{{ $event->evenDate() }}</p>
                            </div>
                        </div>

                        <!-- Event Image -->
                        @if($event->getImage())
                            <div class="mb-4">
                                <img src="{{ $event->getImage() }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- Event Title -->
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>

                        <!-- Event Content -->
                        <div class="mt-4">
                            @markdown($event->content ?? '')
                        </div>

                        <!-- Bottom Section with Static Data for Now -->
                        <div class="flex justify-between items-center mt-6">
                            <!-- Placeholder for future actions (e.g., Like, Comment) -->
                            <div class="flex space-x-2 text-gray-500">
                                <button class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                    <span>12 Likes</span>
                                </button>
                                <button class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7 7 7-7" />
                                    </svg>
                                    <span>4 Comments</span>
                                </button>
                            </div>

                            <!-- Placeholder for share or other action -->
                            <button class="text-blue-500 hover:underline">Share</button>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($events->hasMorePages())
                <div class="text-center mt-6">
                    <button wire:click="loadMore" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Load More
                    </button>
                </div>
            @endif

            <div wire:loading class="text-center mt-6">
                <p>Loading...</p>
            </div>
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-20 space-y-4">
                <!-- Placeholder Icon -->
                <img src="{{ asset('images/empty.png') }}" alt="No Events" class="w-48 h-48 mb-6">

                <!-- Title -->
                <h3 class="text-3xl font-bold text-gray-600">No Events Found</h3>

                <!-- Description -->
                <p class="text-lg text-gray-500 text-center max-w-md">
                    No events have been posted yet. Please check back later.
                </p>
            </div>
        @endif
    </div>


    <script>
        document.addEventListener('livewire:load', () => {
            window.addEventListener('scroll', () => {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
                    Livewire.emit('loadMore');
                }
            });
        });
    </script>

</x-student-layout> --}}


<x-student-layout>
    <div class="container mx-auto flex py-6">

        <aside class="w-1/4 bg-white max-h-screen p-4 shadow-lg rounded-lg space-y-6">

            <div class="text-center">
                <img src="{{ asset('images/sksu1.png') }}" alt="User Profile" class="w-20 h-20 rounded-full mx-auto mb-4">
                <h3 class="text-lg font-semibold">Jakob Botosh</h3>
                <p class="text-gray-600">@jakobbts</p>
                <div class="flex justify-center space-x-4 mt-4">
                    <div class="text-center">
                        <h4 class="font-bold">2.3k</h4>
                        <p class="text-gray-500">Followers</p>
                    </div>
                    <div class="text-center">
                        <h4 class="font-bold">235</h4>
                        <p class="text-gray-500">Following</p>
                    </div>
                    <div class="text-center">
                        <h4 class="font-bold">80</h4>
                        <p class="text-gray-500">Posts</p>
                    </div>
                </div>
            </div>


            <nav class="space-y-2">
                <a href="#" class="block p-3 bg-blue-50 rounded-lg hover:bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M18 9a9 9 0 11-9-9 9 9 0 019 9zM6.707 10.707a1 1 0 01-1.414-1.414L8.586 6H3a1 1 0 010-2h7a1 1 0 011 1v7a1 1 0 11-2 0V8.414l-2.293 2.293z" />
                    </svg>
                    Watch Videos
                </a>
                <a href="#" class="block p-3 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a1 1 0 00-1 1v10a1 1 0 001 1h3v1h4v-1h3a1 1 0 001-1V4a1 1 0 00-1-1H5zm1 2h8v8H6V5z" />
                    </svg>
                    Marketplace
                </a>

            </nav>
        </aside>


        <main class="flex-1  mx-8">
                <div class="space-y-6">
                    {{-- <div class="flex justify-end">
                        <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Create Event
                        </a>
                    </div> --}}
                @forelse ($events as $event)




                <div class="bg-white p-6 shadow-md rounded-lg">
                    <!-- Event Header: User Details and Time -->
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- User Profile Image -->
                            @if ($event->user)
                            <img src="{{ $event->user->getImage() ?? asset('images/sksu1.png') }}" alt="User Profile" class="w-10 h-10 rounded-full">

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
                            <img src="{{ $event->getImage() }}" alt="{{ $event->title }}" class="w-full rounded-lg">
                        </div>
                    @endif

                    <!-- Event Title and Content -->
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-500">
                            @markdown($event->content ?? '')
                        </p>
                    </div>

                    {{-- <!-- Event Footer: Likes (Static for now) -->
                    <div class="flex justify-between mt-4">
                        <div class="flex space-x-4 text-gray-500">
                            <!-- Likes -->
                            <div class="flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p>89 Likes</p>
                            </div>
                        </div>
                    </div> --}}
                </div>

            @empty

            @endforelse

                <div class="bg-white p-6 shadow-md rounded-lg">
                    <!-- Empty State -->
<div class="flex flex-col items-center justify-center py-20 space-y-4">
    <!-- Placeholder Icon -->
    <img src="{{ asset('images/empty-state.svg') }}" alt="No Events" class="w-48 h-48 mb-6">

    <!-- Title -->
    <h3 class="text-3xl font-bold text-gray-600">No Events Available</h3>

    <!-- Description -->
    <p class="text-lg text-gray-500 text-center max-w-md">
        There are no events at the moment. Please check back later or create a new event.
    </p>

    <!-- Optional Action Button (If needed) -->
    {{-- <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Create Event
    </a> --}}
</div>

                </div>
            </div>
        </main>


        <aside class="w-1/4 bg-white  max-h-screen p-4 rounded-lg overflow-y-scroll">
            <h4 class="text-lg font-bold mb-4">Medical Records</h4>

            @if ($academicYears)

            <ul class="space-y-4">
                @forelse ($academicYears as $academicYear)
                <li>
                    <h5 class="font-semibold text-gray-700 ">{{$academicYear->name}}</h5>

                    @forelse ($academicYear->semesters as  $semester)
                    <div class="ml-4">
                        <h6 class="text-md font-semibold text-gray-600">{{$semester->name_in_text}}</h6>
                        <ul class="space-y-2">
                            @forelse ($semester->records as $record)
                            <li class="flex items-center space-x-3">
                                <div>
                                    <p class="text-sm font-semibold">{{ $record->title }}</p>

                                    <!-- Loop through medical records under each record -->
                                    @forelse ($record->medicalRecords as $medicalRecord)
                                        <!-- Link to the medical record details route -->
                                        <a href="{{ route('medical-record-details', ['id' => $medicalRecord->id]) }}" class="text-blue-500 hover:underline">
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
            @endif
        </aside>

    </div>
</x-student-layout>
