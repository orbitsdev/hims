<x-admin-layout>

<form wire:submit="create">
    {{ $this->form }}
    

    
     {{-- <button type="submit">
        Submit
    </button> --}}
     
    <x-filament::button type="submit" class="mt-4">
        Submit
    </x-filament::button>
</form>

<x-filament-actions::modals />

</x-admin-layout>
