<x-student-layout>
    <div class="container mx-auto py-6 px-4 max-w-7xl">


        <!-- Emergency Contacts Section -->
        <div id="emergency" class="tab-content">
            <!-- Search Bar (optional) -->
            <div class="mb-6">
                <input type="text" placeholder="Search Emergency Contacts..." class="w-full p-4 rounded-lg border focus:border-kaitoke-green-700 focus:ring-kaitoke-green-700" wire:model.debounce.300ms.live="search" >
            </div>

            <!-- Emergency Contacts List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($emergencyContacts as $contact)
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                        <!-- Emergency Contact Image -->
                        <a href="{{ $contact->getImage() }}" target="_blank" class="mb-4">
                            <img src="{{ $contact->getImage() }}" alt="{{ $contact->name }}" class="w-24 h-24 rounded-full object-cover border ">
                        </a>

                        <!-- Emergency Contact Details -->
                        <h3 class="text-xl font-semibold text-gray-900">{{ $contact->name }}</h3>
                        <p class="text-gray-600">{{ $contact->contact }}</p>
                        <p class="text-gray-500">{{ $contact->address }}</p>

                        <!-- Active Status -->
                        <span class="text-sm {{ $contact->active ? 'text-green-500' : 'text-red-500' }}">
                            {{ $contact->active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-600 col-span-full text-center">No emergency contacts available.</p>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $emergencyContacts->links() }}
            </div>
        </div>
    </div>
</x-student-layout>
