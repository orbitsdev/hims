<div>



    <div class="flex flex-col items-center justify-center h-full p-4 space-y-4">
        <!-- Feed Item 1 -->
        <div class="max-w-lg w-full bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            @if($record->image)
            <img class="rounded-t-lg w-full h-48 object-cover" src="{{$record->getImage()}}" alt="Feed Image 1">
            @endif
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-900">{{$record->title}}</h2>
                <p class="text-gray-700">{{$record->description}}</p>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-sm text-gray-500">Date{{$record->evenDate() }}</span>
                    {{-- <button class="text-blue-600 hover:underline">Read More</button> --}}
                </div>

                <div class="mt-8 prose max-w-none ">
                    @markdown($record->content)
                </div>
            </div>
        </div>
    
      

</div>
