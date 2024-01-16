<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    {!! \App\Analytics\Tracker::trackPageView() !!}
    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-WP9MPV8"></script>
    <title>Check your email | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.drumeo-favicons')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <style>
        body {
            padding:30px;
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
            color:#0b76db;
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

        .social-media a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 10px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px;
        }

        @media (min-width:40em) {
            .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0;
            }
        }

        @media (min-width:64em) {
            .social-media a {
                width:90px;
                height:90px;
                line-height:90px;
                font-size:45px;
            }
        }
    </style>
    {!! \App\Analytics\Tracker::headBottom() !!}
</head>
<body>
{!! \App\Analytics\Tracker::bodyTop() !!}
<p><strong><i class="fas fa-check"></i> Success!</strong></p>
<h2>Check your email</h2>
<p><em>You should receive an email from team@drumeo.com within 10 minutes.
        <br class="show-for-medium"> If you don’t, then check your spam folder or re-enter your email address again.</em>
</p>
<div class="social-media">
    <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
    <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
</div>
{!! \App\Analytics\Tracker::bodyBottom() !!}
</body>
</html>
