<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <!-- Container to center the form -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <form wire:submit.prevent="save">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4 w-full">
                UPDATE
            </x-filament::button>
        </form>
    </div>

    <x-filament-actions::modals />
</div>
