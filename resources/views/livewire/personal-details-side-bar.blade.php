<div class="w-1/4 bg-white rounded-lg shadow-md p-6 max-h-screen">
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

</div>
