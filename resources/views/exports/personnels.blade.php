<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Personnel Export</title>
</head>
<body>
    <table align="left">
        <thead>
            <tr style="background-color: #106c3b; color: white;">
                <th style="background-color: #106c3b; color: white;" align="left" width="40">ID</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Name</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Email</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Department</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personnels as $personnel)
                <tr>
                    <td align="left" width="40">{{ $personnel->id }}</td>
                    <td align="left" width="40">{{ $personnel->user->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $personnel->user->email ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $personnel->department->name ?? 'N/A' }}</td>
                    <td align="left" width="40">
                        @if($personnel->image)
                            <img src="{{ asset('storage/' . $personnel->image) }}" alt="Personnel Image" width="40">
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
