<div class="flex w-full bg-gray-100 h-full p-6">
    <!-- Image Section -->
    <a href="{{$record->getImage()}}" class="h-96 w-96 mb-16 mr-6" target="_blank">
        <img class="object-cover h-full w-full" src="{{$record->getImage()}}" alt="Profile Image">
    </a>

    <!-- Details Section -->
    <div class="bg-white w-full max-w-full shadow-md rounded-lg overflow-hidden">
        <!-- Account Details -->
        <div class="px-4 py-5 sm:px-6 bg-gray-200 border-b border-gray-300">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Account Details</h3>
        </div>
        <div class="border-t border-gray-300">
            <dl>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-600">Full Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->fullName()}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-600">Username</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->username ?? ''}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-600">Email Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->email ?? ''}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-600">Role</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->role}}
                    </dd>
                </div>
            </dl>
        </div>
        @if ($record->personalDetail)
        <x-personal-detail :record="$record->personalDetail" />
    @endif
        <!-- Personal Details -->
        
    </div>
</div>
