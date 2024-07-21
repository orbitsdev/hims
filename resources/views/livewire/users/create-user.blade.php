<x-admin-layout>

    <div class="flex  justify-end">
        <x-filament::button  class="mt-4 mb-6"   href="{{route('users')}}"
        tag="a" icon="heroicon-m-backspace">
            BACK
        </x-filament::button>
    
    </div>
    <form wire:submit="save">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            SAVE
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-admin-layout>