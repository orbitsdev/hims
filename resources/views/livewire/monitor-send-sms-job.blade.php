<x-admin-layout>

<div>
    <div class="container">
        <h1>Job Queue Monitoring</h1>
    
        <!-- Display Pending Jobs -->
        <h2>Pending Jobs</h2>
        @if ($pendingJobs->isEmpty())
            <p>No pending jobs.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Queue</th>
                        <th>Payload</th>
                        <th>Attempts</th>
                        <th>Reserved At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingJobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->queue }}</td>
                            <td>{{ json_decode($job->payload)->data->commandName }}</td>
                            <td>{{ $job->attempts }}</td>
                            <td>{{ $job->reserved_at ? \Carbon\Carbon::createFromTimestamp($job->reserved_at)->toDateTimeString() : 'Not reserved' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    
        <!-- Display Failed Jobs -->
        <h2>Failed Jobs</h2>
        @if ($failedJobs->isEmpty())
            <p>No failed jobs.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Connection</th>
                        <th>Queue</th>
                        <th>Payload</th>
                        <th>Exception</th>
                        <th>Failed At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($failedJobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->connection }}</td>
                            <td>{{ $job->queue }}</td>
                            <td>{{ json_decode($job->payload)->data->commandName }}</td>
                            <td>{{ $job->exception }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job->failed_at)->toDateTimeString() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</x-admin-layout>
