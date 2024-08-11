<div class="px-4 max-w-4xl">
    {{-- {{ $getRecord()->totalBatches() }} --}}
    
    @foreach ($getRecord()->recordBatches as  $batch)
            <p>
                {{$batch->description}} - {{$batch->department->name}}
            </p>
    @endforeach
</div>
