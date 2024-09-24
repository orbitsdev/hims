<x-student-layout>

    <div class="container mx-auto py-4 px-4">
        <!-- Search Form -->
        <div class="relative mb-6">
            <!-- Search Icon -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

            </div>

            <!-- Search Input -->
            <!-- Search Input with .live for automatic updates in Livewire 3 -->
            <input type="text" wire:model.debounce.300ms.live="searchTerm"
                placeholder="Search Conditions, Treatments, or First Aid Guides..."
                class="w-full p-4 pl-12 border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm">


        </div>


        <!-- Tags for Filtering (Optional) -->
        <div class="mb-6 flex space-x-4">

            <div class="space-y-1">
                @if ($conditions->isNotEmpty())
                    @foreach ($conditions as $condition)
                        <a href="{{ route('first-aid.details', ['id' => $condition->id]) }}"
                            class="bg-white flex items-center space-x-4 p-4  shadow-md hover:bg-gray-100  hover:shadow-lg transition-transform duration-200 ease-in-out">


                            <div class=" p-6   flex items-center space-x-4">
                                <!-- Condition Image Placeholder -->
                                <div class="w-20 h-20 flex-shrink-0">
                                    <img src="{{ $condition->getImage() }}" alt="{{ $condition->name }}"
                                        class="w-full h-full object-cover rounded-md">
                                </div>

                                <!-- Condition Details -->
                                <div class="flex-1">
                                    <h3 class="text-2xl font-semibold">{{ $condition->name }}</h3>

                                    <!-- Display a Short Excerpt of the Condition Description Using Markdown -->
                                    <p class="text-gray-700 mt-2">@markdown(Str::limit($condition->description, 300))</p>

                                    <!-- View Details Button -->



                                    @if ($condition->treatments->isNotEmpty())
                                        <div class="">
                                            <h3 class="text-lg font-semibold">Treatments</h3>
                                            @foreach ($condition->treatments as $treatment)
                                                <div class="mt-2 bg-gray-100 p-4 rounded-md">
                                                    <h4 class="text-md font-semibold">{{ $treatment->name }}</h4>
                                                    <div class="mt-2 text-gray-700">
                                                        @markdown($treatment->description ?? '')
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-gray-600">No results found for "{{ $searchTerm }}".</p>
                @endif
            </div>
        </div>

    </div>


</x-student-layout>
