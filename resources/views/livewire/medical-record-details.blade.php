<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<x-student-layout>
<div class="container mx-auto ">
    <div class="flex justify-end ">
        <a href="{{ route('user.medical-records') }}" class="text-gray-400 hover:text-kaitoke-green-600 inline-flex items-center">
            <i class="fa-regular fa-circle-xmark text-3xl"></i>
        </a>
    </div>

    <!-- Medical Record Details (Wrap in a div to target print) -->

        <!-- Medical Details Section -->
<div class="mb-2 break-inside-avoid py-2">
    <h2 class="text-xl font-semibold text-green-700 bg-gray-200 p-2 rounded">Medical Details</h2>
    <div class="border-l border-r">
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Past Illness:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->past_illness ?? '' }}</span>
      </p>
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Allergies:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->allergies ?? '' }}</span>
      </p>
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Temperature:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->temperature ?? '' }} °C</span>
      </p>
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Blood Pressure:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->systolic_pressure ?? '' }} / {{ $record->diastolic_pressure ?? '' }} mmHg</span>
      </p>
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">BP Risk Level:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->getBloodPressureStatus() ?? '' }}</span>
      </p>
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Heart Rate:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->heart_rate ?? '' }} bpm</span>
      </p>
      
      <!-- Diagnoses Section -->
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Diagnoses:</span>
        <span class="ml-4 py-2 inline-block col-span-9">
          {{ $record->condition?->name ?? '' }}
          @if($record->condition?->description)
            <p class="text-gray-600 mt-2">@markdown($record->condition->description)</p>
          @endif
        </span>
      </p>
  
      <!-- Symptoms Section -->
      @if($record->condition?->symptoms->isNotEmpty())
      <div class="mb-2 break-inside-avoid py-2">
        <h2 class="text-md font-semibold text-green-700 bg-gray-200 p-2 rounded">Symptoms</h2>
        @foreach ($record->condition->symptoms as $symptom)
        <div class="border-l font-normal grid grid-cols-12 px-2 border-b">
          <p class="col-span-2 py-2 border-r">{{ $symptom->name ?? '' }}</p>
          <div class="col-span-9 py-2 ml-4">
            @markdown($symptom->description ?? '')
          </div>
        </div>
        @endforeach
      </div>
      @endif
  
      <!-- Treatments Section -->
      @if($record->condition?->treatments->isNotEmpty())
      <div class="mb-2 break-inside-avoid py-2">
        <h2 class="text-md font-semibold text-green-700 bg-gray-200 p-2 rounded">Treatments</h2>
        @foreach ($record->condition->treatments as $treatment)
        <div class="border-l font-normal grid grid-cols-12 px-2 border-b">
          <p class="col-span-2 py-2 border-r">{{ $treatment->name ?? '' }}</p>
          <div class="col-span-9 py-2 ml-4">
            @markdown($treatment->description ?? '')
          </div>
        </div>
        @endforeach
      </div>
      @endif
  
      <!-- First Aid and Guide Section -->
      @if($record->condition?->firstAidGuides->isNotEmpty())
      <div class="mb-2 break-inside-avoid py-2">
        <h2 class="text-md font-semibold text-green-700 bg-gray-200 p-2 rounded">First Aid and Guide</h2>
        @foreach ($record->condition->firstAidGuides as $firstAidGuide)
        <div class="border-l font-normal grid grid-cols-12 px-2 border-b">
          <p class="col-span-2 py-2 border-r">{{ $firstAidGuide->title ?? '' }}</p>
          <div class="col-span-9 py-2 ml-4">
            @markdown($firstAidGuide->content ?? '')
          </div>
        </div>
        @endforeach
      </div>
      @endif
  
      <p class="font-normal grid grid-cols-12 px-2 border-b">
        <span class="text-gray-400 col-span-2 inline-block border-r py-2">Remarks:</span>
        <span class="ml-4 py-2 inline-block col-span-9">{{ $record->remarks ?? '' }}</span>
      </p>
    </div>
  </div>
  
</div>
</x-student-layout>
