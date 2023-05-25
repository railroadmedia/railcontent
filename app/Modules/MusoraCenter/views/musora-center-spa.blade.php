<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1">
    <title>Musora Center</title>
    <link rel="icon" href="/dist/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100:300,400,500,700,900|Material+Icons" rel="stylesheet">
    @foreach(glob('dist/js/*.js') as $asset)
        <link href="{{ $asset }}" rel="preload" as="script">
    @endforeach
</head>
<body>
<noscript>
    <strong>We're sorry but Musora Center doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>

<input id="userInfoDataElement"
       type="hidden"
       data-user="{{ json_encode($user) }}">

<input id="countryList"
       type="hidden"
       value="{{ json_encode(\Railroad\Location\Services\CountryListService::allWeCanShipTo()) }}">

<input id="musoraWebAppURL"
       type="hidden"
       value="{{ $musoraWebAppURL }}">

<div id="app"></div>

<script src="https://js.stripe.com/v3/"></script>

<!-- built files will be auto injected -->
@foreach(glob('dist/js/*.js') as $asset)
    <script type="text/javascript" src="{{ $asset }}"></script>
@endforeach

</body>
</html>
