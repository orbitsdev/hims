<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Staff Export</title>
</head>
<body>
    <table align="left">
        <thead>
            <tr style="background-color: #106c3b; color: white;">
                <th style="background-color: #106c3b; color: white;" align="left" width="40">ID</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Name</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Email</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Position</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Department</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Employment Type</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Personal Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staff as $member)
                <tr>
                    <td align="left" width="40">{{ $member->id }}</td>
                    <td align="left" width="40">{{ $member->user->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $member->user->email ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $member->position ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $member->department->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $member->employment_type ?? 'N/A' }}</td>
                    <td align="left" width="40">
                        {{ $member->personalDetail->first_name ?? 'N/A' }} {{ $member->personalDetail->last_name ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
