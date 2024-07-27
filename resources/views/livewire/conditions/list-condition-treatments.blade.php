<x-admin-layout>

    
   

    <div class="flex  justify-end pb-4">
        <x-filament::button  icon="heroicon-m-arrow-left" tag="a" href="{{route('manage-condition', ['record'=> $this->record->id])}}" color="gray">
            <span class="text-sm text-gray-400"> BACK</span>
        </x-filament::button>
    
    </div>
    <div class="">

        {{ $this->table }}
    </div>

</x-admin-layout>