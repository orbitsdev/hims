<!-- resources/views/livewire/queue-monitor.blade.php -->

<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Queued Jobs</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Queue</th>
                <th>Attempts</th>
                <th>Reserved At</th>
                <th>Available At</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->queue }}</td>
                    <td>{{ $job->attempts }}</td>
                    <td>{{ $job->reserved_at }}</td>
                    <td>{{ $job->available_at }}</td>
                    <td>{{ $job->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Failed Jobs</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Connection</th>
                <th>Queue</th>
                <th>Payload</th>
                <th>Exception</th>
                <th>Failed At</th>
                <th>Retry</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->failedJobs as $failedJob)
                <tr>
                    <td>{{ $failedJob->id }}</td>
                    <td>{{ $failedJob->connection }}</td>
                    <td>{{ $failedJob->queue }}</td>
                    <td>{{ $failedJob->payload }}</td>
                    <td>{{ $failedJob->exception }}</td>
                    <td>{{ $failedJob->failed_at }}</td>
                    {{-- <td><button wire:click="retryJob({{ $failedJob->id }})">Retry</button></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
