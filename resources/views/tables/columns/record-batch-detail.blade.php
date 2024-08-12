<div class="px-4">
    @if ($getRecord()->totalBatches()> 0)
        
    {{$getRecord()->totalBatches()}}
    @else
     NONE
    @endif
</div>
