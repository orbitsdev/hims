<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Terms and Privacy Policy -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2 text-sm">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-theme-green hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-theme-green hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex items-center justify-between mt-4">

            <div class="text-center">
              <span class="text-sm text-gray-500">Already Have an account?</span>
              <a href="{{route('login')}}" class="text-sm text-theme-green font-bold hover:underline text-kaitoke-green-700">Login</a>
            </div>

                <button class="bg-kaitoke-green-700 text-white text-center font-medium py-2 rounded-lg hover:bg-kaitoke-green-800 focus:ring-2 focus:ring-kaitoke-green-600 focus:ring-opacity-50 shadow-md px-4">
                    {{ __('Register') }}
                </button>
            </div>
            <div class="flex items-center justify-center w-full mt-4">
                <div class="w-1/3 border-t border-gray-300"></div>
                <span class="mx-2 text-sm text-gray-400">OR</span>
                <div class="w-1/3 border-t border-gray-300"></div>
              </div>

              <!-- Sign in with Google Button -->
              <a class="mt-6 flex items-center justify-center w-full border border-gray-300 rounded-lg p-2 hover:bg-gray-100 shadow-md">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Icon" class="h-5 w-5 mr-2">
                <span class=" font-medium text-gray-600">Continue With Google</span>
              </a>
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
