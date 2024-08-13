<div class="px-4">
    <a href="{{ route('batches-request-notification', ['record' => $getRecord()]) }}" class="text-sm text-blue-600">{{$getRecord()->notificationRequests()->count()}} <span class="text-xs">Sent</span></a>
</div>
