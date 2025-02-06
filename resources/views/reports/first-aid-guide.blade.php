<!DOCTYPE html>
<html lang="en">
<head>
  <title>First Aid Guide</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @media print {
      .break-inside-avoid {
        break-inside: avoid;
      }
      .page-break-before {
        page-break-before: always;
      }
      .content {
        padding-top: 2cm;
      }
    }
  </style>
</head>
<body class="bg-white">
  <header class="bg-gradient-to-r from-red-500 to-orange-600 text-white py-4 px-6 flex items-center justify-between">
    <div class="flex items-center">
      <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="w-12 h-12 mr-4 rounded-full">
      <h1 class="text-xl font-bold">First Aid & Emergency Guide</h1>
    </div>
    <div class="text-right">
      <p class="text-sm">First Aid Report</p>
      <p class="text-xs font-light">Generated: {{ date('Y-m-d') }}</p> 
    </div>
  </header>

  <div class="container mx-auto py-6 rounded-lg">
    <div class="grid grid-cols-12 gap-x-8">
      <div class="col-span-12">
        <div class="flex justify-between mb-6">
          <div>
            <h1 class="text-xl font-bold">{{ $guide->title ?? 'N/A' }}</h1>
            <p class="text-gray-600 mb-4">Condition: {{ $guide->condition->name ?? 'N/A' }}</p>
          </div>
          <div class="col-span-3">
            @if($guide->getImage() !== asset('images/placeholder-image.jpg'))
              <img src="{{ $guide->getImage() }}" alt="First Aid Image" class="w-24 h-24 object-cover border-2 border-gray-300">
            @endif
          </div>
        </div>

        <!-- Description Section -->
        <div class="mb-2 break-inside-avoid py-2">
          <h2 class="text-xl font-semibold text-red-700 bg-gray-200 p-2 rounded">Description</h2>
          <div class="border-l border-r">
            <div class="text-gray-800 px-2 py-2">@markdown($guide->content ?? 'No details available')</div>
          </div>
        </div>

        <!-- Related Condition -->
        @if($guide->condition)
        <div class="mb-2 break-inside-avoid py-2">
          <h2 class="text-xl font-semibold text-red-700 bg-gray-200 p-2 rounded">Related Condition</h2>
          <div class="border-l border-r">
            <p class="font-normal grid grid-cols-12 px-2 border-b">
              <span class="text-gray-400 col-span-2 inline-block border-r py-2">Condition:</span>
              <span class="ml-4 py-2 inline-block col-span-9">{{ $guide->condition->name ?? 'N/A' }}</span>
            </p>
            <p class="font-normal grid grid-cols-12 px-2 border-b">
              <span class="text-gray-400 col-span-2 inline-block border-r py-2">Description:</span>
              <div class="ml-4 py-2 inline-block col-span-9">
                @markdown($guide->condition->description ?? 'No description available')
              </div>
            </p>
          </div>
        </div>
        @endif

        <!-- Treatments Section -->
        @if($guide->condition && $guide->condition->treatments->count() > 0)
        <div class="mb-2 break-inside-avoid py-2">
          <h2 class="text-xl font-semibold text-red-700 bg-gray-200 p-2 rounded">Recommended Treatments</h2>
          @foreach($guide->condition->treatments as $treatment)
          <div class="border-l font-normal grid grid-cols-12 px-2 border-b">
            <p class="col-span-2 py-2 border-r">{{ $treatment->name ?? 'N/A' }}</p>
            <div class="col-span-9 py-2 ml-4">
              @markdown($treatment->description ?? 'No Treatment Description')
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>

    <div class="text-center text-gray-600 mt-8">
      <p>First Aid Guide Generated Automatically</p>
    </div>
  </div>
</body>
</html>
