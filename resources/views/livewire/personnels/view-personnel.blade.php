<div class="flex w-full bg-gray-100 h-full p-6">
    <!-- Image Section -->
    <a href="{{ $record->user->getImage() }}" class="h-96 w-96 mb-16 mr-6" target="_blank">
        <img class="object-cover h-full w-full" src="{{ $record->user->getImage() }}" alt="Profile Image">
    </a>

    <!-- Details Section -->
    <div class="bg-white w-full max-w-full shadow-md rounded-lg overflow-hidden">
        <!-- Account Details -->
        <div class="px-4 py-5 sm:px-6 bg-gray-200 border-b border-gray-300">
            <h3 class="text-lg leading-6 font-medium text-gray-900">UNIVERSITY IDENTITY</h3>
        </div>
        <div class="border-t border-gray-300">
            {{-- <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-600">ID NUMBER</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->id_number}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-600">DEPARTMENT</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->department->getNameWithAbbreviation() ?? ''}}
                    </dd>
                </div>


            </dl> --}}
        </div>

        <!-- Personal Details -->
        @if($record->personalDetail)
        <x-personal-detail :record="$record->personalDetail"/>
            @endif
    </div>
</div>
