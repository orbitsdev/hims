<div class="flex flex-col items-center justify-center min-h-screen bg-[#E2E5E0] max-w-7xl mx-auto">
    <!-- Form for creating (using wire:submit to handle the submission) -->
    <form wire:submit.prevent="create">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            SAVE
        </x-filament::button>
    </form>

    <!-- Logout Form (separate form to handle logout action) -->
    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf
        <x-filament::button type="submit" class="mt-4 bg-red-500 hover:bg-red-600">
            Log Out
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
