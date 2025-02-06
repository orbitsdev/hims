<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <!-- Title Section -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $record->title ?? 'First Aid Guide' }}</h1>

    <!-- Description Section -->
    <div class="prose mb-6">
        <h2 class="text-xl font-semibold text-green-700 mb-4">Description</h2>
        @markdown($record->content ?? 'No description available')
    </div>

    <!-- Symptoms Section -->
    @if($record->condition && $record->condition->symptoms->count() > 0)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-green-700 mb-4">Symptoms</h2>
            <ul class="list-disc pl-6 text-gray-700">
                @foreach($record->condition->symptoms as $symptom)
                    <li class="mb-2">{{ $symptom->name }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Treatments Section -->
    @if($record->condition && $record->condition->treatments->count() > 0)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-green-700 mb-4">Treatments</h2>
            @foreach($record->condition->treatments as $treatment)
                <div class="mb-4 p-4 border border-gray-200 rounded-md bg-gray-50">
                    <h3 class="text-lg font-semibold text-green-800">{{ $treatment->name }}</h3>
                    <p class="text-gray-700 mt-2">@markdown($treatment->description ?? 'No description available')</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Related Condition Section -->
    @if($record->condition)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-green-700 mb-4">Related Condition</h2>
            <p class="text-gray-700">
                <strong>Condition:</strong> {{ $record->condition->name ?? 'N/A' }}
            </p>
            <div class="prose text-gray-700">
                @markdown($record->condition->description ?? 'No description available')
            </div>
        </div>
    @endif
</div>
