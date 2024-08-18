<div class="px-2">
    @switch($getRecord()->getBloodPressureStatus())
        @case('Normal')
        <span class="bg-green-100 text-green-800 px-3 py-1 text-sm font-medium rounded-full">Normal</span>
        @break
        
        @case('Elevated')
        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 text-sm font-medium rounded-full">Elevated</span>
        @break
        
        @case('Hypertension')
        <span class="bg-orange-100 text-orange-800 px-3 py-1 text-sm font-medium rounded-full">Hypertension</span>
        @break
        
        @case('Hypertension Stage 1')
        <span class="bg-red-100 text-red-800 px-3 py-1 text-sm font-medium rounded-full">Hypertension Stage 1</span>
        @break
        
        @case('Hypertension Stage 2')
        <span class="bg-red-200 text-red-800 px-3 py-1 text-sm font-medium rounded-full">Hypertension Stage 2</span>
        @break
        
        @case('Hypertensive Crisis')
        <span class="bg-red-300 text-red-800 px-3 py-1 text-sm font-medium rounded-full">Hypertensive Crisis</span>
        @break
        
        @default
        <span class="bg-gray-100 text-gray-800 px-3 py-1 text-sm font-medium rounded-full">Unknown Status</span>
    @endswitch
</div>
