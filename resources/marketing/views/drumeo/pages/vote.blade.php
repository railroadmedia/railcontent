<!DOCTYPE html>
<html lang="en">
<head>
    @if(Carbon\Carbon::create(2023, 11, 19, 20, 59, 0, 'America/Vancouver') < Carbon\Carbon::now())
        <meta http-equiv="Refresh" content="0; url='https://www.drumeo.com/beat/drumeo-awards-2022-winners/'" />
    @else
        <meta http-equiv="Refresh" content="0; url='https://www.drumeo.com/beat/drumeo-awards-2023/'" />
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
</head>
<body>
</body>
</html>
