<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Students Export</title>
</head>
<body>
    <table align="left">
        <thead>
            <tr style="background-color: #106c3b; color: white;">
                <th style="background-color: #106c3b; color: white;" align="left" width="40">ID</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Name</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Email</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Course</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Section</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Department</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Personal Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td align="left" width="40">{{ $student->id }}</td>
                    <td align="left" width="40">{{ $student?->user?->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $student?->user?->email ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $student?->course?->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $student?->section?->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $student?->department?->name ?? 'N/A' }}</td>
                    <td align="left" width="40">
                        {{ $student->personalDetail?->first_name ?? 'N/A' }} {{ $student->personalDetail?->last_name ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
