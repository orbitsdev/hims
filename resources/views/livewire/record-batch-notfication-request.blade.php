<x-admin-layout>
    
    <div class="flex  justify-end">
        <x-filament::button  class="mt-4 mb-6"   href="{{route('batches',['record'=> $record->record])}}"
        tag="a" icon="heroicon-m-backspace">
            BACK
        </x-filament::button>
    
    </div>
    <div class="bg-white p-8">
        <table class="min-w-full divide-y divide-gray-300">
            <thead>
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Message</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">To</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Send at</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($record->notificationRequests as $request)
                    <tr>
                        <td class="whitespace-normal py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                            {{ $request->message }} 
                        </td>
                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">
                            {{ $request->email }}
                        </td>
                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">
                            {{ $request->created_at->format('F d, Y H:i:s A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 text-center">
                            No notifications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    
    
</x-admin-layout>