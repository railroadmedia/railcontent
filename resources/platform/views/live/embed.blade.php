<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Roboto+Condensed:wght@400;700&display=swap"
        rel="stylesheet"
    >

    @include('members.partials._favicons')

    <link rel="stylesheet" href="{{ mix('css/packages.css') }}">

</head>

<body>
    <div id="app">
        <div class="" style="width: 440px; height: 820px;">
            <chat
                api-key="{{ $apiKey }}"
                token="{{ $token }}"
                user-id="{{ current_user()->getId() }}"
                chat-channel-name="{{ $chatChannelName }}"
                questions-channel-name="{{ $questionsChannelName }}"
                :is-administrator="{{ json_encode(boolval($isAdministrator)) }}"
                :user-data="{{ json_encode($userData) }}"
                embed-url="{{ $embedUrl }}"
            ></chat>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>

    <script src="{{ mix('assets/members/js/manifest.js') }}"></script>
    <script src="{{ mix('assets/members/js/vendor.js') }}"></script>
    <script src="{{ mix('assets/members/js/app.js') }}"></script>
</body>
</html>
