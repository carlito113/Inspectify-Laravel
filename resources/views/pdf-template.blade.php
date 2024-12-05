<!DOCTYPE html>
<html>
<head>
    <title>Revenue Report</title>
</head>
<body>
    <h1>Revenue Report</h1>
    <table revenues="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Revenue Name</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revenues as $revenue)
                <tr>
                    <td>{{ $revenue->id }}</td>
                    <td>{{ $revenue->name }}</td>
                    <td>{{ $revenue->amount }}</td>
                    <td>{{ $revenue->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
