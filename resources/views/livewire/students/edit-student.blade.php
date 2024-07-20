<x-admin-layout>

    <form wire:submit="save">
        {{ $this->form }}

        <button type="submit">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</x-admin-layout>