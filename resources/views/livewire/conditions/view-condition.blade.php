<div>

    <h1 class="text-2xl py-2">
        Condition Details
 </h1>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
     <h1 class="text-2xl font-bold mb-4">{{ $record->name }}</h1>
     <div class="prose">
         {{-- {!! \Illuminate\Support\Str::markdown($treatment->description) !!} --}}
         @markdown($record->description??'')
     </div>
 </div>


 @if(count($record->treatments) > 0)
 <h1 class="text-2xl border-t mt-4 py-2">
        Treatments
 </h1>
 @foreach ($record->treatments as $treatment )
 <div class="max-w-4xl mx-auto bg-white p-8 ">
    <h1 class="text-2xl font-bold mb-4">{{ $treatment->name }}</h1>
    <div class="prose">

        @markdown($treatment->description ??'')
    </div>
 </div>
 @endforeach
 @endif
 </div>
