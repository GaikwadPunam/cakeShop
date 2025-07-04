<!DOCTYPE html>
<html>
<head>
    <title>Cake List PDF</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Cake List</h2>
    <table width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cakes as $cake)
                <tr>
                    <td>{{ $cake->id }}</td>
                    <td>{{ $cake->name }}</td>
                    <td>{{ $cake->description }}</td>
                    <td>{{ $cake->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
