<x-student-layout>
    <div class="container mx-auto px-4 py-6 max-w-2xl ">

        @if ($events->isNotEmpty())
            <div class="space-y-6">
                @foreach($events as $event)
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <!-- Event Image -->
                        @if($event->getImage())
                            <img src="{{ $event->getImage() }}" alt="{{ $event->title }}" class="w-full h-64 object-cover mb-4 rounded-lg">
                        @endif

                        <!-- Event Title -->
                        <h3 class="text-xl font-semibold">{{ $event->title }}</h3>

                        <!-- Event Date -->
                        <p class="text-sm text-gray-500">{{ $event->evenDate() }}</p>

                        <!-- Event Content -->
                        <div class="mt-4">
                            @markdown($event->content ?? '')
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($events->hasMorePages())
                <div class="text-center mt-6">
                    <button
                        wire:click="loadMore"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Load More
                    </button>
                </div>
            @endif

            <div wire:loading class="text-center mt-6">
                <p>Loading...</p>
            </div>
        @else
         <!-- Empty State -->
<div class="flex flex-col items-center justify-center py-20 space-y-4">
    <!-- Placeholder Icon -->
    <img src="{{ asset('images/emoty.png') }}" alt="No Events" class="w-48 h-48 mb-6">

    <!-- Title -->
    <h3 class="text-3xl font-bold text-gray-600">No Results Found</h3>

    <!-- Description -->
    <p class="text-lg text-gray-500 text-center max-w-md">
        Not Event was publish yet
    </p>

    <!-- Additional Help -->

</div>

        @endif

    </div>

    <script>
        document.addEventListener('livewire:load', () => {
            window.addEventListener('scroll', () => {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
                    Livewire.emit('loadMore');
                }
            });
        });
    </script>

</x-student-layout>
