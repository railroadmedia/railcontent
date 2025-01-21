<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    {!! \App\Analytics\Tracker::trackPageView() !!}
    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-NJR7J6C"></script>
    <title>Check your email | Musora</title>
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.musora-favicons')
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        body {
            padding:50px 25px;
            text-align:center;
            overflow: hidden;
        }

        p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto;
        }

        @media (min-width:40em) {
            p {
                font-size:19px;
            }
        }

        @media (min-width:64em) {
            p {
                font-size:23px;
            }
        }

        h2 {
            font:700 30px/1em "Bebas Neue", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#FFAE00;
        }

        @media (min-width:40em) {
            h2 {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            h2 {
                font-size:50px;
            }
        }

        p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px;
        }

        @media (min-width:40em) {
            p em {
                font-size:14px;
            }
        }
    </style>
    {!! \App\Analytics\Tracker::headBottom() !!}
</head>
<body>
{!! \App\Analytics\Tracker::bodyTop() !!}
<p><strong>You're Almost There!</strong></p>
<h2>Check your email</h2>
<p><em>You should receive an email from hello@musora.com within 10 minutes.
        <br class="hidden md:inline"> If you don’t, then check your spam folder or re-enter your email address again.</em>
</p>
{!! \App\Analytics\Tracker::bodyBottom() !!}
</body>
</html>
