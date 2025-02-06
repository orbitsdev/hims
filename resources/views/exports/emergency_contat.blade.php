<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Emergency Contacts Export</title>
</head>
<body>
    <table align="left">
        <thead>
            <tr style="background-color: #106c3b; color: white;">
                <th style="background-color: #106c3b; color: white;" align="left" width="40">ID</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Name</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Contact</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Address</th>
                <th style="background-color: #106c3b; color: white;" align="left" width="40">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td align="left" width="40">{{ $contact->id }}</td>
                    <td align="left" width="40">{{ $contact->name ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $contact->contact ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $contact->address ?? 'N/A' }}</td>
                    <td align="left" width="40">{{ $contact->textStatus() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
