<div class="bg-[#E2E5E0] min-h-screen">
    <x-main-header />
    <div class="container mx-auto py-6">
        <div class="flex space-x-8 p-4">
            @livewire('personal-details-side-bar')


            <div class="w-2/3 bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center border-b pb-2 mb-4">
                    <div class="flex space-x-4">
                        <a href="{{ route('events.index') }}"
                            class="{{ RouteManager::isCurrentPublicPage(Session::get('current_route_name'), ['events.index']) }}">Events</a>
                        <a href="{{ route('first-aid.search') }}"
                            class="{{ RouteManager::isCurrentPublicPage(Session::get('current_route_name'), ['first-aid.search', 'first-aid.details']) }}">Firstaid & Treatments</a>
                        {{-- <a class="text-gray-600 font-semibold">Notifications</a>
                        <a class="text-gray-600 font-semibold">Medical Records</a> --}}

                    </div>
                </div>

                {{ $slot }}



            </div>

            {{-- @livewire('latest-medical-record-side-bar') --}}
        </div>
    </div>
</div>
