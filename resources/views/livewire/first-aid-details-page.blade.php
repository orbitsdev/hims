<x-student-layout>
    <div class="container mx-auto  rounded-lg ">
        <!-- Close Button -->
        <div class="flex justify-end ">
            <a href="{{ route('first-aid.search') }}" class="text-gray-400 hover:text-kaitoke-green-600 inline-flex items-center">
            <i class="fa-regular fa-circle-xmark text-3xl"></i>
            </a>
        </div>

        <!-- Condition Details Section -->
        <div class="flex items-start space-x-10 mt-4">
            <!-- Condition Image -->
            <div class="w-1/3 bg-white p-4 border border-gray-200  rounded-lg">
                <img src="{{ $condition->getImage() }}" alt="{{ $condition->name }}" class="w-full h-full object-cover rounded-md">
            </div>

            <!-- Condition Details -->
            <div class="flex-1 bg-white p-6 border border-gray-200  rounded-lg">
                <h3 class="text-4xl font-bold text-kaitoke-green-900">{{ $condition->name }}</h3>
                <p class="text-gray-700 mt-6 leading-relaxed">@markdown($condition->description ?? 'No description available')</p>

                <!-- Symptoms Section -->
                @if ($condition->symptoms->isNotEmpty())
                <div class="mt-10 bg-[#f8f9fa] p-6 rounded-lg">
                    <h4 class="text-2xl font-bold text-gray-800 mb-4">Symptoms</h4>
                    @foreach ($condition->symptoms as $symptom)
                        <div class="mt-4 flex items-start space-x-4 border-l-4 border-green-700 pl-4 py-2 bg-white shadow-sm rounded-md">
                            <!-- Symptom Image -->
                            <a href="{{ $symptom->getImage() }}" class="flex-shrink-0 w-16 h-16" target="_blank">
                                <img src="{{ $symptom->getImage() }}" alt="{{ $symptom->name }}" class="w-full h-full object-cover rounded-md">
                            </a>
                            <!-- Symptom Details -->
                            <div>
                                <h5 class="font-semibold text-lg text-gray-900">{{ $symptom->name }}</h5>
                                <p class="text-gray-600 mt-1 leading-relaxed">@markdown($symptom->description ?? '')</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Treatments Section -->
            @if ($condition->treatments->isNotEmpty())
                <div class="mt-10 bg-[#f8f9fa] p-6 rounded-lg">
                    <h4 class="text-2xl font-bold text-gray-800 mb-4">Treatments</h4>
                    @foreach ($condition->treatments as $treatment)
                        <div class="mt-4 flex items-start space-x-4 border-l-4 border-green-700 pl-4 py-2 bg-white shadow-sm rounded-md">
                            <!-- Treatment Image -->
                            <a href="{{ $treatment->getImage() }}" class="flex-shrink-0 w-16 h-16" target="_blank">
                                <img src="{{ $treatment->getImage() }}" alt="{{ $treatment->name }}" class="w-full h-full object-cover rounded-md">
                            </a>
                            <!-- Treatment Details -->
                            <div>
                                <h5 class="font-semibold text-lg text-gray-900">{{ $treatment->name }}</h5>
                                <p class="text-gray-600 mt-1 leading-relaxed">@markdown($treatment->description ?? '')</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            </div>
        </div>
    </div>
</x-student-layout>
