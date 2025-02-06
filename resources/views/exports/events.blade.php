<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Events Export</title>
</head>
<body>
    <table align="left">
        <thead>
            <tr style="background-color: #106c3b; color: white;">
                <th style="background-color: #106c3b; color: white;" align="left" width="40">ID</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Title</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Description</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Event Date</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Academic Year</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Semester</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Created By</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Published</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td align="left" width="40">{{ $event->id }}</td>
                    <td align="left" width="40">{{ $event->title ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $event->description ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $event->event_date ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $event->academicYear->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $event->semester->name_in_text ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $event->user->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $event->is_published ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
