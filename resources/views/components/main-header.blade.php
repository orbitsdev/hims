<nav class=" bg-[#067547] shadow-md">
    <div class="h-4 bg-[#064F32]"></div>
    <div class="container mx-auto flex justify-between items-center py-4 max-w-4xl mx-auto">
        <!-- Left side: Static First Aid & Treatment Section -->
        <div class="flex items-center space-x-6">
            <!-- First Aid & Treatment -->
            <a href="{{route('first-aid.search')}}" class="{{ RouteManager::isCurrentPublicPage(Session::get('current_route_name'), ['first-aid.search','first-aid.details']) }}">
                First Aid & Treatment
            </a>

            <!-- Events -->
            <a href="{{route('events.index')}}" class="{{ RouteManager::isCurrentPublicPage(Session::get('current_route_name'), ['events.index']) }}">
                Events
            </a>
        </div>

        <!-- Right side: User Dropdown, Notifications -->
        <div class="flex items-center space-x-6">
            <!-- Notification Icon with Badge -->
            <div class="relative">
                <button type="button" class="relative flex rounded-full focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 016 6v3.586l.707.707A1 1 0 0117 14H3a1 1 0 01-.707-1.707L3 11.586V8a6 6 0 016-6zM5 14h10v1a2 2 0 11-4 0H9a2 2 0 11-4 0v-1z"/>
                    </svg>
                    <!-- Badge -->
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full h-5 w-5 text-xs flex items-center justify-center z-20">3</span>
                </button>
            </div>
            <div>
                <p class="text-white">
                    {{Auth::user()->name}}

                </p>

            </div>
            <!-- User Dropdown -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <div>
                    <button @click="dropdownOpen = !dropdownOpen" type="button" class="relative flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-kaitoke-green-500 focus:ring-offset-2" id="user-menu-button">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->getImage() }}" alt="User Image">
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" class="absolute z-30 right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <x-dropdown-link href="{{ Auth::user()->getImage() }}" target="_blank">
                        View Image
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('edit-profile', ['record' => Auth::user()]) }}">
                        Edit Profile
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
