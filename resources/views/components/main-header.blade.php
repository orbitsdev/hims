<nav class=" border-opacity-25  lg:border-b  px-4">
    <div class="mx-auto   p-2">
        <div class="relative flex h-16 items-center justify-end    lg:border-opacity-25">
            {{-- <div class="flex items-center px-2 lg:px-0">
                <div class="flex-shrink-0">
                    <img class="block h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=300" alt="Your Company">
                </div>
                <div class="hidden lg:ml-10 lg:block">
                    <div class="flex space-x-4">
                        <a href="#" class="rounded-md bg-indigo-700 px-3 py-2 text-sm font-medium text-white" aria-current="page">Dashboard</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Team</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Projects</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Calendar</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Reports</a>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="flex flex-1 justify-center px-2 lg:ml-6 lg:justify-end">
                <div class="w-full max-w-lg lg:max-w-xs">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative text-gray-400 focus-within:text-gray-600">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="search" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 sm:text-sm sm:leading-6" placeholder="Search" type="search" name="search">
                    </div>
                </div>
            </div> --}}
            {{-- <div class="flex lg:hidden">
                <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-indigo-600 p-2 text-indigo-200 hover:bg-indigo-500 hover:bg-opacity-75 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> --}}
            <div class="hidden lg:ml-4 lg:block">
                <div class="flex items-center">
                    {{-- <button type="button" class="relative flex-shrink-0 rounded-full bg-indigo-600 p-1 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button> --}}

                    <div class="relative ml-3 flex-shrink-0" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" type="button" class="relative flex rounded-full bg-indigo-600 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>

                        <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="#" class="block rounded-md bg-indigo-700 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Team</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Projects</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Calendar</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Reports</a>
        </div>
        <div class="border-t border-indigo-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-indigo-300">tom@example.com</div>
                </div>
                <button type="button" class="ml-auto flex-shrink-0 rounded-full bg-indigo-600 p-1 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Your Profile</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Settings</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75">Sign out</a>
            </div>
        </div>
    </div>
</nav>
