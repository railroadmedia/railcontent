<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">

</head>

<body class="">

    <script>
        function onFrameLoaded(){
            window.location.href = "{{get_legacy_brand_base_url('drumeo')}}/30-day-drummer";
        }
    </script>

    <iframe onload="onFrameLoaded(this);" src="{{ get_legacy_brand_base_url('drumeo') . '?blank_response&user_id=' . user()->id .
        '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            style="position: absolute; left: -999px;">
    </iframe>
</body>
</html>

