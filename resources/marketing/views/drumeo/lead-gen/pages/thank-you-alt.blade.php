<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Check your email | Drumeo</title>
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @include('drumeo._partials._fonts')
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
            font:700 30px/1em "Roboto Condensed", sans-serif;
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
</head>
<body>
<p><strong>Thanks for sticking around</strong></p>
<h2>WE’RE SO GLAD YOU’RE HERE!</h2>
<p><em>You’ll continue to get free lessons and tips from<br class="show-for-medium">
        Drumeo in your inbox. You can unsubscribe any time.</em>
</p>
<div class="social-media">
    <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
    <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
</div>
</body>
</html>
