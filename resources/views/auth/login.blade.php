<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="login_name" value="{{ __('Email/Username') }}" />
                <x-input id="login_name" class="block mt-1 w-full" type="text" name="login_name" :value="old('login_name')" required  />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            {{-- <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}

            {{-- <div class="flex flex-col items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tory-kaitoke-green-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div> --}}

            <div class="flex flex-col items-center space-y-4 w-full max-w-sm mx-auto mt-4">
                <!-- Forgot Password Link -->
                <a href="#" class="text-sm text-kaitoke-green-700 hover:underline">Forgot the password?</a>

                <!-- Login Button -->
                <button class="w-full bg-kaitoke-green-700 text-white text-center font-medium py-2 rounded-lg hover:bg-kaitoke-green-800 focus:ring-2 focus:ring-kaitoke-green-600 focus:ring-opacity-50 shadow-md">
                  Login
                </button>

                <!-- OR Divider -->
                <div class="flex items-center justify-center w-full">
                  <div class="w-1/3 border-t border-gray-300"></div>
                  <span class="mx-2 text-sm text-gray-400">OR</span>
                  <div class="w-1/3 border-t border-gray-300"></div>
                </div>

                <!-- Sign in with Google Button -->
                <a class="flex items-center justify-center w-full border border-gray-300 rounded-lg p-2 hover:bg-gray-100 shadow-md">
                  <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Icon" class="h-5 w-5 mr-2">
                  <span class=" font-medium text-gray-600">Continue With Google</span>
                </a>
              </div>
              <div class="h-6"></div>
              <div class="text-center">
                <span class="text-sm text-gray-500">Don't have an account?</span>
                <a href="{{route('register')}}" class="text-sm text-theme-green font-bold hover:underline text-kaitoke-green-700">Sign Up</a>
              </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
