<div class="w-full max-w-6xl bg-white p-12  fade-in">
    <!-- Blood Pressure Level Header -->
   

    <!-- Blood Pressure Level Details -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 mb-12">
      <div class="bg-gray-50 p-8  text-center">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Level Name</h2>
        <p class="text-3xl font-bold text-gray-900">{{ $record->level_name }}</p>
      </div>
      <div class="bg-gray-50 p-8  text-center">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Systolic Range</h2>
        <p class="text-3xl font-bold text-gray-900">{{ $record->systolic_min }} - {{ $record->systolic_max ?? 'No upper limit' }}</p>
      </div>
      <div class="bg-gray-50 p-8  text-center">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Diastolic Range</h2>
        <p class="text-3xl font-bold text-gray-900">{{ $record->diastolic_min }} - {{ $record->diastolic_max ?? 'No upper limit' }}</p>
      </div>
      <div class="bg-gray-50 p-8  text-center">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Age Range</h2>
        <p class="text-3xl font-bold text-gray-900">{{ $record->age_min }} - {{ $record->age_max ?? 'No upper limit' }}</p>
      </div>
    </div>

    <!-- Suggestions Section -->
    <div class="bg-green-50 p-10 ">
      <h3 class="text-4xl font-bold text-gray-900 mb-6">Personalized Suggestions</h3>
      <ul class="space-y-6">
        @foreach ($record->suggestions as $suggestion)
          <li class="bg-white p-6 rounded-lg  text-lg text-gray-800">
            {{ $suggestion->suggestion }}
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Action Button Section -->
   
  </div>