<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

    <div class="container mx-auto py-6 px-8 rounded-lg">
        <!-- Title & Image -->
        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-bold text-red-600">{{ $guide->title }}</h1>
            <div>
                @if($guide->getImage() !== asset('images/placeholder-image.jpg'))
                    <img src="{{ $guide->getImage() }}" alt="First Aid Image" class="w-24 h-24 object-cover border-2 border-gray-300">
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-red-700 bg-gray-200 p-2 rounded">Description</h2>
            <p class="text-gray-800 px-2">{{ $guide->content }}</p>
        </div>

        <!-- Related Condition -->
        @if($guide->condition)
        <div class="mb-4 break-inside-avoid">
            <h2 class="text-lg font-semibold text-red-700 bg-gray-200 p-2 rounded">Related Condition</h2>
            <p class="px-2 text-gray-800"><strong>Condition:</strong> {{ $guide->condition->name ?? 'N/A' }}</p>
            <p class="px-2 text-gray-800"><strong>Description:</strong> {{ $guide->condition->description ?? 'N/A' }}</p>
        </div>
        @endif

        <!-- Treatments -->
        @if($guide->condition && $guide->condition->treatments->count() > 0)
        <div class="mb-4 break-inside-avoid">
            <h2 class="text-lg font-semibold text-red-700 bg-gray-200 p-2 rounded">Recommended Treatments</h2>
            @foreach($guide->condition->treatments as $treatment)
            <div class="border-l border-r px-2 border-b py-2">
                <p class="font-semibold">{{ $treatment->name }}</p>
                <p class="text-gray-800">@markdown($treatment->description)</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <footer class="text-center text-gray-600 mt-8">
        <p>First Aid Guide Generated Automatically</p>
    </footer>
</body>
</html>
