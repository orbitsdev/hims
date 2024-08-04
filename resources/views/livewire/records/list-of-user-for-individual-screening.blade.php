
    <div class="p-10">
   

       
            <div class="flex justify-between items-end">
                <div class="mx-auto max-w-6xl lg:mx-0 ">
               
                <h2 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">List Of User Who Deosnt have Medical Record in this  {{$record?->semester->semesterWithYear()??''}}</h2>
                <p class="mt-10 text-lg leading-8 text-gray-600"> </p>
              </div>
              
    
              
            </div>
    
            
         
            <x-filament::button  color="gray" class=" mb-4"   href="{{route('records')}}" size="xl"
            tag="a" icon="heroicon-m-backspace">
            BACK
          </x-filament::button>
            {{ $this->table }}
    </div>
    

