<x-admin-layout>

    <div class="flex justify-between items-end">
        <div class="mx-auto max-w-6xl lg:mx-0">
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-indigo-900 sm:text-5xl">
                Record Batch Lists - {{ $record?->semester->semesterWithYear() ?? 'N/A' }}
            </h2>
            <p class="mt-10 text-lg leading-8 text-gray-600"></p>
        </div>
    </div>
    
    <x-filament::button color="gray" class="mb-4" href="{{ route('records') }}" size="xl" tag="a" icon="heroicon-m-backspace">
        Back
    </x-filament::button>
    <div>
        {{ $this->table }}
    </div>
</x-admin-layout>
