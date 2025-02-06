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
  <!-- Header Section -->
  <header class="bg-gradient-to-r from-green-500 to-green-700 text-white py-4 px-6 flex items-center justify-between">
    <div class="flex items-center">
      <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="w-12 h-12 mr-4 rounded-full">
      <h1 class="text-xl font-bold">First Aid & Emergency Guide</h1>
    </div>
    <div class="text-right">
      <p class="text-sm">First Aid Guide</p>
      <p class="text-xs font-light">Generated: {{ date('Y-m-d') }}</p>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto py-6 rounded-lg">
    <!-- Title and Overview -->
    <div class="flex justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-green-800">{{ $guide->title ?? 'N/A' }}</h1>
        <p class="text-gray-600">Condition: <span class="font-semibold">{{ $guide->condition->name ?? 'N/A' }}</span></p>
      </div>
      <div>
        @if($guide->getImage() !== asset('images/placeholder-image.jpg'))
          <img src="{{ $guide->getImage() }}" alt="First Aid Image" class="w-24 h-24 object-cover border-2 border-gray-300 rounded">
        @endif
      </div>
    </div>

    <!-- Description Section -->
    <div class="mb-6 break-inside-avoid">
      <h2 class="text-xl font-semibold text-green-700 bg-gray-200 p-2 rounded">Description</h2>
      <p class="text-gray-800 px-4 py-2">@markdown($guide->content ?? 'No details available')</p>
    </div>

    <!-- Related Condition Section -->
    @if($guide->condition)
    <div class="mb-6 break-inside-avoid">
      <h2 class="text-xl font-semibold text-green-700 bg-gray-200 p-2 rounded">Related Condition</h2>
      <div class="px-4 py-2">
        <p class="text-gray-800"><strong>Condition Name:</strong> {{ $guide->condition->name ?? 'N/A' }}</p>
        <p class="text-gray-800 mt-2">@markdown($guide->condition->description ?? 'No description available')</p>
      </div>
    </div>
    @endif

    <!-- Treatments Section -->
    @if($guide->condition && $guide->condition->treatments->count() > 0)
    <div class="mb-6 break-inside-avoid">
      <h2 class="text-xl font-semibold text-green-700 bg-gray-200 p-2 rounded">Recommended Treatments</h2>
      @foreach($guide->condition->treatments as $treatment)
      <div class="border-l font-normal px-4 py-2 border-b">
        <p class="text-lg font-semibold text-green-800">{{ $treatment->name ?? 'N/A' }}</p>
        <p class="text-gray-800 mt-1">@markdown($treatment->description ?? 'No Treatment Description')</p>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  <!-- Footer Section -->
  <footer class="text-center text-gray-600 mt-8">
    <p>First Aid Guide Generated Automatically</p>
    <p class="text-sm text-gray-500">Stay calm and follow the instructions carefully.</p>
  </footer>
</body>
</html>
