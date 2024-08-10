<div class="p-10 ">

    <x-filament::button  color="gray" class=" mb-4"   href="{{route('by-batch-medical-recoding',['record'=> $record])}}" size="xl"
        tag="a" icon="heroicon-m-backspace">
        BACK
      </x-filament::button>

    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
                SAVE
            </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
