<x-admin-layout>

    <div class="flex  justify-end">
        <x-filament::button  class="mt-4 mb-6"   href="{{route('courses')}}"
        tag="a" icon="heroicon-m-backspace">
            BACK
        </x-filament::button>
    
    </div>
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            SAVE
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-admin-layout>