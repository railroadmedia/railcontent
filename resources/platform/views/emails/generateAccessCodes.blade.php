<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<table>
    <thead>
    <tr>
        <td style="font-weight: bold">Product Name: {{ $product->getName() }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold">Product Id: {{ $product->getId() }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold">Source: {{ $source }}</td>
    </tr>
    </thead>

    <tbody>
    @foreach($accessCodeData as $oneCode)
        <tr>
            <td style="font-size:1.05em;">{{ $oneCode['code'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
