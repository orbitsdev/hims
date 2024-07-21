
<x-admin-layout>

    <form wire:submit="save">
        {{ $this->form }}
        
       
        <x-filament::button type="submit" class="mt-4">
            UPDATE
        </x-filament::button>
    </form>
    
    <x-filament-actions::modals />

</x-admin-layout>