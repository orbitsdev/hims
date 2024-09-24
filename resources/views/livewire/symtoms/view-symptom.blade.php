<div>


    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
     <h1 class="text-2xl font-bold mb-4">{{ $record->name }}</h1>
     <div class="prose">
         {{-- {!! \Illuminate\Support\Str::markdown($treatment->description) !!} --}}
         @markdown($record->description ?? '')
     </div>
 </div>

 </div>
