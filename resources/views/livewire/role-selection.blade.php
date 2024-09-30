<div class="flex flex-col items-center justify-center min-h-screen bg-[#E2E5E0]">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl text-center">
        <h1 class="text-2xl font-bold mb-4">Please select your role</h1>
        <p class="text-sm text-gray-500 mb-6">SKSU HIMS</p>

        <!-- 2-Column Grid for Role Cards -->
        <div class="grid grid-cols-2 gap-4 mb-6 w-full">
            @foreach($roles as $role)
                <div class="grid-cols-2 cursor-pointer transform transition-all duration-200 hover:scale-105">
                    <div class="border p-4 rounded-lg
                        {{ $selectedRole == $role ? 'bg-kaitoke-green-100 border-kaitoke-green-500' : 'bg-white border-gray-300' }}
                        hover:bg-kaitoke-green-50 hover:border-kaitoke-green-300"
                        wire:click="selectRole('{{ $role }}')">
                        <img src="{{ asset('images/' . strtolower($role) . '.png') }}" alt="{{ $role }}" class="w-10 h-10 mx-auto">
                        <p class="mt-2 text-sm font-bold">{{ $role }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Continue Button with Conditional Styling -->
        <button class="px-6 py-2 rounded-lg text-white transition-all duration-200
                {{ $selectedRole ? 'bg-kaitoke-green-500 hover:bg-kaitoke-green-600 cursor-pointer' : 'bg-gray-300 cursor-not-allowed' }} "
                wire:click="saveRole"
                {{ $selectedRole ? '' : 'disabled' }}>
            Continue
        </button>

        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button class="mt-4 px-6 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 transition-all duration-200"
                    @click.prevent="$root.submit();">
                Log Out
            </button>
        </form>

    </div>
</div>
