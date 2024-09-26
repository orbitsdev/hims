<div class="p-6">

<div class="container mx-auto py-6 px-4 max-w-7xl rounded bg-white">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('first-aid.search') }}" class="text-gray-600 hover:underline inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <!-- Article Header -->
    <div class="text-center">
        <!-- Article Category Tag -->
        <div class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full mb-4">
            {{ $condition->category ?? 'Health' }}
        </div>
        
        <!-- Article Title -->
        <h1 class="text-5xl font-bold text-gray-900 mb-4">{{ $condition->name }}</h1>
        
        <!-- Date and Time -->
        {{-- <p class="text-gray-500 text-lg">{{ $condition->created_at->format('d F Y') }} &bull; {{ $condition->created_at->format('h:i A') }}</p> --}}
    </div>

    <!-- Article Image -->
    <div class="mb-12 mt-8">
        <img src="{{ $condition->getImage() }}" alt="{{ $condition->name }}" class="w-full h-96 object-cover rounded-lg     ">
    </div>

    <!-- Article Content -->
    <div class="prose max-w-none text-gray-700 mb-12 mx-auto">
        @markdown($condition->description ?? 'No description available')
    </div>

    <!-- First Aid Guides Section -->
    @if($condition->firstAidGuides->isNotEmpty())
        <div class="mb-4">
            <h3 class="text-2xl  mb-2">First Aid Guides</h3>
            <div class="space-y-6">
                @foreach($condition->firstAidGuides as $guide)
                    <div class="bg-white flex items-center space-x-4 border border-gray-200 rounded-lg  transition-transform duration-200 ease-in-out p-6">
                        <!-- Guide Image -->
                        <a href="{{ $guide->getImage() }}" target="_blank" class="w-24 h-24 flex-shrink-0">
                            <img src="{{ $guide->getImage() }}" alt="{{ $guide->title }}" class="w-full h-full object-cover rounded-lg ">
                        </a>
                        <!-- Guide Content -->
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">{{ $guide->title }}</h4>
                            <p class="text-gray-600 text-lg mt-2">
                                @markdown($guide->content ?? 'No content available')
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Treatments Section -->
    @if($condition->symptoms->isNotEmpty())
        <div class="mb04">
            <h3 class="text-2xl  mb-2">Symptoms</h3>
            <div class="space-y-6">
                @foreach($condition->symptoms as $symptom)
                    <div class="bg-white flex items-center space-x-4 border border-gray-200 rounded-lg  transition-transform duration-200 ease-in-out p-6">
                        <!-- Treatment Image -->
                        <a href="{{ $symptom->getImage() }}" target="_blank" class="w-24 h-24 flex-shrink-0">
                            <img src="{{ $symptom->getImage() }}" alt="{{ $symptom->name }}" class="w-full h-full object-cover rounded-lg ">
                        </a>
                        <!-- Treatment Content -->
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">{{ $symptom->name }}</h4>
                            <p class="text-gray-600 text-lg mt-2">
                                @markdown($symptom->description ?? 'No description available')
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if($condition->treatments->isNotEmpty())
        <div class="mt-4">
            <h3 class="text-2xl  mb-2">Treatments</h3>
            <div class="space-y-6">
                @foreach($condition->treatments as $treatment)
                    <div class="bg-white flex items-center space-x-4 border border-gray-200 rounded-lg  transition-transform duration-200 ease-in-out p-6">
                        <!-- Treatment Image -->
                        <a href="{{ $treatment->getImage() }}" target="_blank" class="w-24 h-24 flex-shrink-0">
                            <img src="{{ $treatment->getImage() }}" alt="{{ $treatment->name }}" class="w-full h-full object-cover rounded-lg ">
                        </a>
                        <!-- Treatment Content -->
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">{{ $treatment->name }}</h4>
                            <p class="text-gray-600 text-lg mt-2">
                                @markdown($treatment->description ?? 'No description available')
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
</div>
