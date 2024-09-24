<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medical Report</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <header class="bg-gradient-to-r from-green-500 to-teal-600 text-white py-4 px-6 flex items-center justify-between">
        <div class="flex items-center">
          <img src="{{ asset('images/sksu1.png') }}" alt="University Logo" class="w-12 h-12 mr-4 rounded-full">
          <h1 class="text-xl font-bold">Isulan Sultan Kudarate University</h1>
        </div>
        <div class="text-right">
          <p class="text-sm">Medical Report </p>
          <p class="text-xs font-light">Generated: {{ date('Y-m-d') }}</p>

        </div>

      </header>

  <div class="container mx-auto py-6 rounded-lg">

    <div class="grid grid-cols-12 gap-x-8 ">
      <div class="col-span-12">
        <div class="flex justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold mb-2">Medical Report - {{$record->record->academicYearAndSemester()}}</h1>
                <p class="text-gray-600 mb-4">Date of Examination: {{ $record->created_at->format('F j, Y') }}</p>
            </div>
            <div class=" col-span-3 ">
                <img src="{{ $record->getUploadImage() }}" alt="Patient Image" class="w-40 h-40 object-cover border-2 border-gray-300 ">
               </div>

        </div>



        <div class="mb-2">
            <h2 class="text-xl font-semibold text-green-700  bg-gray-200 p-2 rounded">Personal Information</h2>
            <div class="border-l border-r ">
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Name</span> <span class="ml-4 py-2 inline-block col-span-9">{{ $record->first_name }} {{ $record->middle_name }} {{ $record->last_name }}</span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Email</span> <span class="ml-4 py-2 inline-block col-span-9">{{ $record->email }}  </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Age</span> <span class="ml-4 py-2 inline-block col-span-9">{{ $record->age }}  </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Date of Birth</span> <span class="ml-4 py-2 inline-block col-span-9"> {{ $record->birthDateFormat() }} </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Address</span> <span class="ml-4 py-2 inline-block col-span-9">  {{ $record->address }}</span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Civil Status</span> <span class="ml-4 py-2 inline-block col-span-9"> {{ $record->civil_status }} </span></p>


            </div>
          </div>

          <div class="mb-2">
            <h2 class="text-xl font-semibold text-green-700  bg-gray-200 p-2 rounded">Medical Details</h2>
            <div class="border-l border-r ">

              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Past Illness:</span> <span class="ml-4 py-2 inline-block col-span-9">{{ $record->past_illness }} </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Allergies:</span> <span class="ml-4 py-2 inline-block col-span-9">{{ $record->allergies }}  </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Temperature:</span> <span class="ml-4 py-2 inline-block col-span-9"> {{ $record->temperature }} °C </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Blood Pressure:</span> <span class="ml-4 py-2 inline-block col-span-9">  {{ $record->systolic_pressure }} mmHg</span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">BP Risk Level</span> <span class="ml-4 py-2 inline-block col-span-9">  {{ $record->getBloodPressureStatus() }} </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Heart Rate</span> <span class="ml-4 py-2 inline-block col-span-9"> {{ $record->heart_rate }} bpm </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Diagnoses</span> <span class="ml-4 py-2 inline-block col-span-9">   @if($record->condition)
                  {{ $record->condition?->name }}</span></p>
                  @endif </span></p>
              <p class="font-normal grid grid-cols-12 px-2 border-b "><span class="text-gray-400 col-span-2 inline-block border-r  py-2 ">Remarks:</span> <span class="ml-4 py-2 inline-block col-span-9"> {{ $record->remarks }}  </span></p>


            </div>
          </div>
          @if($record->condition)
          <div class="mb-2">
              <h2 class="text-xl font-semibold text-green-700  bg-gray-200 p-2 rounded">TREATMENTS</h2>
                  @foreach ($record->condition->treatments as  $treatment)
                  <div class="border-l font-normal grid grid-cols-12 px-2 border-b">

                      <p class="col-span-2 py-2 border-r ">
                          {{$treatment->name}}

                        </p>
                        <div class="col-span-9 py-2 ml-4">
                            @markdown($treatment->description ?? '')

                        </div>
                    </div>



                  @endforeach
          </div>
          <div class="mb-2">
              <h2 class="text-xl font-semibold text-green-700  bg-gray-200 p-2 rounded">FirstAid and Guide</h2>
                  @foreach ($record->condition->firstAidGuides as  $firstAidAndGuide)
                  <div class="border-l font-normal grid grid-cols-12 px-2 border-b">

                      <p class="col-span-2 py-2 border-r ">
                          {{$firstAidAndGuide->title}}

                        </p>
                        <div class="col-span-9 py-2 ml-4">
                            @markdown($firstAidAndGuide->content ??'')

                        </div>
                    </div>



                  @endforeach
          </div>

          @endif
      </div>


    </div>



    <div class="text-center text-gray-600 mt-8">
      <p>Report Generated by {{ $record->physician_name }}</p>
      <p>Release By: {{ $record->release_by }}</p>
    </div>
  </div>
</body>
</html>
