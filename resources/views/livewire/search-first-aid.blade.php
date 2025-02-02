<x-student-layout>

    <div class="container max-w-4xl  ">
        <!-- Search Form -->
        <div class="relative mb-6">
            <!-- Search Icon -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>

            <!-- Search Input -->
            <input type="text" wire:model.debounce.300ms.live="searchTerm"
                placeholder="Search Conditions, Treatments, or First Aid Guides..."
                class="w-full p-4 pl-12 border-gray-300 focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700 rounded-md shadow-sm">
        </div>

        <!-- Results Display -->
        <div class="mb-6 space-y-8">
            @if ($conditions->isNotEmpty())
                @foreach ($conditions as $condition)
                    <a href="{{ route('first-aid.details', ['id' => $condition->id]) }}"
                        class="bg-white flex items-center space-x-4 border border-gray-200 rounded-lg hover:bg-[#f2f4f1] hover:shadow-sm transition-transform duration-200 ease-in-out p-6">

                        <!-- Condition Image Placeholder -->
                        <div class="w-20 h-20 flex-shrink-0 ">
                            <img src="{{ $condition->getImage() }}" alt="{{ $condition->name??'' }}"
                                class="w-full h-full object-cover rounded-md">
                        </div>

                        <!-- Condition Details -->
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-kaitoke-green-800">{{ $condition->name??'' }}</h3>
                            <p class="text-gray-600 mt-2">@markdown($condition->description ?? '')</p>

                            @if ($condition->symptoms->isNotEmpty())
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold">Symptoms</h4>
                                    @foreach ($condition->symptoms as $symptom)
                                        <div class="mt-2 border-l-4 border-green-600 pl-4">
                                            <h5 class="font-semibold">{{ $symptom->name??'' }}</h5>
                                            <p class="text-gray-600 mt-1">@markdown($symptom->description ??'')</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($condition->treatments->isNotEmpty())
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold">Treatments</h4>
                                    @foreach ($condition->treatments as $treatment)
                                        <div class="mt-2 border-l-4 border-green-600 pl-4">
                                            <h5 class="font-semibold">{{ $treatment->name??'' }}</h5>
                                            <p class="text-gray-600 mt-1">@markdown($treatment->description ??'')</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                <div class="text-center py-20">
                    <img src="{{ asset('images/empty-state.svg') }}" alt="No Results"
                        class="mx-auto mb-4" style="max-width: 200px;">
                    <h3 class="text-2xl font-semibold text-gray-600">No Results Found</h3>
                    <p class="text-gray-500 mt-2">Try adjusting your search or check back later.</p>
                </div>
            @endif
        </div>

    </div>

</x-student-layout>
