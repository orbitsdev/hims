<div class="p-10">
    <div class="flex justify-between items-end">
        <div class="mx-auto max-w-6xl lg:mx-0">
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-kaitoke-green-900 sm:text-5xl">
                ( {{$record->description ?? ''}} )Accounts Without Medical Records - {{ $record?->record?->semester->semesterWithYear() ?? 'N/A' }}
            </h2>
            <p class="mt-10 text-lg leading-8 text-gray-600"></p>
        </div>
    </div>

    <x-filament::button color="gray" class="mb-4" href="{{ route('batches', ['record'=> $record->record]) }}" size="xl" tag="a" icon="heroicon-m-backspace">
        Back
    </x-filament::button>

    {{ $this->table }}
</div>
