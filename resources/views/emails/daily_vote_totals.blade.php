<!DOCTYPE html>
<html>
<head>
    <title>Daily Vote Summary</title>
</head>
<body>
    <h1>Daily Vote Summary</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Choice ID</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($totals as $vote)
                <tr>
                    <td>{{ $vote->choice_id }}</td>
                    <td>{{ $vote->votes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>