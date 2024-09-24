<x-student-layout>
    <div class="container mx-auto py-6 px-4">
        <!-- Condition Details -->
        <div class="bg-white p-6 rounded-lg border border-[#F2F2F2]">
            <!-- Condition Image -->
            <div class="mb-4 flex justify-center">
                <a href="{{ $condition->getImage() }}" target="_blank">
                    <img src="{{ $condition->getImage() }}" alt="{{ $condition->name }}" class="w-64 h-64 object-cover rounded-md ">
                </a>
            </div>

            <!-- Condition Name and Description -->
            <h2 class="text-3xl font-bold mb-4">{{ $condition->name }}</h2>
            <p class="text-gray-700 text-lg mb-6">@markdown($condition->description ?? '')</p>

            <!-- First Aid Guides -->
            @if($condition->firstAidGuides->isNotEmpty())
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold mb-4">First Aid Guides</h3>
                    <div class="space-y-1">
                        @foreach($condition->firstAidGuides as $guide)
                            <div class="bg-[#F9F9F9]  p-4 rounded-md shadow-sm flex items-center space-x-4">
                                <!-- Guide Image -->
                                <a href="{{ $guide->getImage() }}" target="_blank">
                                    <div class="w-20 h-20 flex-shrink-0">
                                        <img src="{{ $guide->getImage() }}" alt="{{ $guide->title }}" class="w-full h-full object-cover rounded-md ">
                                    </div>
                                </a>

                                <!-- Guide Content -->
                                <div>
                                    <h4 class="text-xl font-semibold">{{ $guide->title }}</h4>
                                    <p class="text-gray-700 mt-2">@markdown($guide->content ?? '')</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Treatments -->
            @if($condition->treatments->isNotEmpty())
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold mb-4">Treatments</h3>
                    <div class="space-y-1">
                        @foreach($condition->treatments as $treatment)
                            <div class="bg-[#F9F9F9]  p-4 rounded-md shadow-sm flex items-center space-x-4">
                                <!-- Treatment Image -->
                                <a href="{{ $treatment->getImage() }}" target="_blank">
                                    <div class="w-20 h-20 flex-shrink-0">
                                        <img src="{{ $treatment->getImage() }}" alt="{{ $treatment->name }}" class="w-full h-full object-cover rounded-md ">
                                    </div>
                                </a>

                                <!-- Treatment Content -->
                                <div>
                                    <h4 class="text-xl font-semibold">{{ $treatment->name }}</h4>
                                    <p class="text-gray-700 mt-2">@markdown($treatment->description ?? '')</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-student-layout>
