<div class="w-1/4 bg-white rounded-lg shadow-md p-6 max-h-screen overflow-y-auto">
    <div class="flex flex-col items-center">
        <a href="{{Auth::user()->getImage()}}" alt="{{Auth::user()->name}}" target="_blank">

            <img src="{{Auth::user()->getImage()}}" alt="Profile Image" class="border rounded-full mb-4">
        </a>
        <h2 class="text-xl font-semibold">{{Auth::user()->name}}</h2>
        <p class="text-gray-500 mb-4">{{Auth::user()->email}}</p>
        <p class="text-gray-500 mb-4">({{Auth::user()->role}})</p>

        <div class="flex space-x-3 mb-4">
            <button class="bg-gray-100 p-4 rounded-full">

            </button>
            <button class="bg-gray-100 p-4 rounded-full">
            </button>
            <button class="bg-gray-100 p-4 rounded-full">
            </button>
        </div>
        <a href="{{ route('edit-profile', ['record' => Auth::user()]) }}" class="bg-kaitoke-green-600 text-white w-full py-2 rounded-lg block text-center">Update Profile</a>
    </div>
    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-4 text-center">Emergency Contacts</h3>
        <div class="space-y-4">
            @foreach ($emergencyContacts as $contact)
                <div class="flex items-center space-x-4">
                    <!-- Emergency Contact Image -->
                    <a href="{{ $contact->getImage() }}" target="_blank" class="w-12 h-12">
                        <img src="{{ $contact->getImage() }}" alt="{{ $contact->name }}" class="rounded-full object-cover w-full h-full">
                    </a>
                    <!-- Emergency Contact Details -->
                    <div>
                        <h4 class="font-semibold">{{ $contact->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $contact->contact }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
