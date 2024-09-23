<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center bg-kaitoke-green-900">
        <div class="flex shadow-lg w-full max-w-4xl rounded-lg overflow-hidden bg-white">
            <!-- Left Side Form -->
            <div class="w-1/2 p-8">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-4">Sign Up to HIMS</h2>

                </div>

                <!-- Validation Errors -->
                <x-validation-errors class="mb-4" />

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-4">
                        <x-label for="name" value="{{ __('Fullname') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required  />
                    </div>

                    <div class="mt-4">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required  />
            </div>
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required  />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Passoword') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="password_confirmation" />
            </div>

            <button class="mt-6 w-full bg-kaitoke-green-700 text-white text-center font-medium py-2 rounded-lg hover:bg-kaitoke-green-800 focus:ring-2 focus:ring-kaitoke-green-600 focus:ring-opacity-50 shadow-md">
                Register
              </button>
            <div class="flex items-center justify-center w-full mt-4">
                <div class="w-1/3 border-t border-gray-300"></div>
                <span class="mx-2 text-sm text-gray-400">OR</span>
                <div class="w-1/3 border-t border-gray-300"></div>
              </div>


              <a class="flex items-center justify-center w-full border border-gray-300 rounded-lg p-2 hover:bg-gray-100 shadow-md mt-4">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Icon" class="h-5 w-5 mr-2">
                <span class=" font-medium text-gray-600">Continue With Google</span>
              </a>


            <div class="h-6"></div>
              <div class="text-center">
                <span class="text-sm text-gray-500">Already have an account?</span>
                <a href="{{route('login')}}" class="text-sm text-theme-green font-bold hover:underline text-kaitoke-green-700">Login</a>
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
