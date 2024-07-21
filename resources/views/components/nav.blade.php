<nav class="flex flex-1 flex-col">

    <div  class="mb-4">

        <div class="flex items-center justify-center">
            <img src="{{asset('images/logo.png')}}" alt="" class="h-40 w-40">
        </div>
        <div class="flex items-center justify-center ">

            <h1 class="text-6xl font-bold"> HIMS</h1>
        </div>
    </div>
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400">RECORD MANAGEMENT</div>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <!-- Current: "bg-gray-50 text-tory-blue-600", Default: "text-gray-700 hover:text-tory-blue-600 hover:bg-gray-50" -->
                    <a href="{{route('dashboard')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['users','user-create','user-edit'])}}">
                        {{-- <svg class="h-6 w-6 shrink-0 text-tory-blue-600" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg> --}}

                        <i class="fa-solid fa-users text-2xl w-6" ></i>
                        {{-- <i class="fa-solid fa-key text-2xl"></i> --}}
                       SYSTEM USERS
                    </a>
                </li>
               
                <li>
                    <a href="{{route('students')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['students','create-student','edit-student','view-student'])}}">
                        <i class="fa-solid fa-graduation-cap text-2xl w-6"></i>
                        STUDENTS
                    </a>
                </li>
                <li>
                    <a href="{{route('staffs')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['staffs','staffs-edit','staffs-create','staffs-view'])}} ">
                        <i class="fa-solid fa-clipboard-user text-2xl w-6"></i>
                        STAFFS
                    </a>
                </li>
                <li>
                    <a href="{{route('personnels')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['personnels','personnel-edit','personnel-create'])}} ">
                        <i class="fa-solid fa-user text-2xl w-6"></i>
                        PERSONNELS
                    </a>
                </li>
                <li>
                    <a href="{{route('events')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['events','event-create','event-edit','event-view'])}}">
                        <i class="fa-solid fa-calendar-check text-2xl w-6"></i>
                      EVENTS
                    </a>
                </li>
                <li>
                    <a href="{{route('emergency-contacts')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['emergency-contacts'])}}">
                        <i class="fa-solid fa-kit-medical text-2xl w-6"></i>
                      EMERGENCY CONTACTS
                    </a>
                </li>
              
            </ul>
        </li>
        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400">FORM MANAGEMENT</div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                    <a href="{{route('academic-year')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['academic-year'])}}">
                        {{-- <i class="fa-solid fa-building-columns text-2xl"></i> --}}
                        <i class="fa-solid fa-calendar text-2xl"></i>
                      ACADEMIC YEAR
                    </a>
                </li>
                <li>
                    <a href="{{route('departments')}}"
                        class="{{RouteManager::isCurrentPage(Route::currentRouteName(),['departments'])}}">
                        <i class="fa-solid fa-building-columns text-2xl"></i>
                        COLLEGE DEPARMENT
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>