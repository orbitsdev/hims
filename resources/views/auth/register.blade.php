<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center bg-kaitoke-green-900">
        <div class="flex shadow-lg w-full max-w-4xl rounded-lg overflow-hidden bg-white">
            <!-- Left Side Form -->
            <div class="w-1/2 p-8">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-4">Sign Up to InsideBox</h2>
                    <p class="text-gray-500">Start your journey</p>
                </div>

                <!-- Validation Errors -->
                <x-validation-errors class="mb-4" />

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name Input -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 mb-2">Full Name</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Your full name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-kaitoke-green-500">
                    </div>
                    <div class="mb-6">
                        <label for="username " class="block text-gray-700 mb-2">Username</label>
                        <input id="username " type="text" name="username " :value="old('username')" required autofocus placeholder="7Username" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-kaitoke-green-500">
                    </div>

                    <!-- Email Input -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 mb-2">E-mail</label>
                        <input id="email" type="email" name="email" :value="old('email')" required placeholder="example@email.com" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-kaitoke-green-500">
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required placeholder="********" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-kaitoke-green-500">
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="********" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-kaitoke-green-500">
                    </div>

                    <!-- Register Button -->
                    <div class="mb-6">
                        <button type="submit" class="w-full bg-kaitoke-green-600 text-white py-2 rounded-md hover:bg-kaitoke-green-700 transition">
                            Register
                        </button>
                    </div>

                    <!-- Social Sign-In -->
                    <div class="text-center text-gray-500 mb-6">or</div>
                    <a class="flex items-center justify-center w-full border border-gray-200 rounded-lg p-2 hover:bg-gray-100 shadow-sm mb-4">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Icon" class="h-5 w-5 mr-2">
                        <span class="font-medium text-gray-600">Continue with Google</span>
                    </a>

                    <!-- Already have an account -->
                    <div class="text-center">
                        <p class="text-gray-500">Already have an account? <a href="{{ route('login') }}" class="text-kaitoke-green-600 hover:underline">Sign In</a></p>
                    </div>
                </form>
            </div>

            <!-- Right Side Image -->
            <div class="w-1/2 hidden md:block">
                <img src="https://sksu.edu.ph/wp-content/uploads/2021/06/sksu_employs_awa-1024x512.jpg" alt="Background Image" class="object-cover w-full h-full">
            </div>
        </div>
    </div>
</x-guest-layout> 
