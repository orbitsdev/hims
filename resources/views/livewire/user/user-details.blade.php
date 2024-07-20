<div class="flex w-full bg-tory-blue-50 h-full p-6">
    <a href="{{$record->getImage()}}" class="h-96 w-96 mb-16 mr-6" target="_blank"><img class=" " src="{{$record->getImage()}}" alt=""></a>
    <div class="bg-white  w-full max-w-ful shadow overflow-hidden sm:rounded-lg   ">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Registered Users
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Details and informations about user.
            </p>
        </div>
        <div class="border-t border-gray-200  ">
            <dl>
                <div class="bg-tory-blue-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Full name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->fullName()}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Usename
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->username??''}}
                    </dd>
                </div>
                <div class="bg-tory-blue-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Email address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->email??''}}
                    </dd>
                </div>
                <div class="bg-tory-blue-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Role
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$record->role}}
                    </dd>
                </div>
                
                
            </dl>
        </div>
    </div>
</div>
