<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<table>
    <thead>
    <tr>
        <td style="font-weight: bold">'{{ $codeType }} ' codes</td>
    </tr>
    </thead>

    <tbody>
    @foreach($actionCodeData as $oneCode)
        <tr>
            <td style="font-size:1.05em;">{{ $oneCode['code'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
