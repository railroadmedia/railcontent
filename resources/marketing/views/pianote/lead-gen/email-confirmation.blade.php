<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Here's a gift | Pianote</title>
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">
    @include('pianote._partials._fonts')
    @include('_partials.layout.favicons.pianote-favicons')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        body {
            padding:20px;
            text-align:center;
            overflow: hidden;
        }

        p {
            font:400 16px/1.4em "Open Sans", sans-serif;
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
            text-transform:uppercase;
            color:#F61A30;
        }

        @media (min-width:40em) {
            h2 {
                font-size:40px;
            }
        }

        @media (min-width:64em) {
            h2 {
                font-size:50px;
            }
        }

        p em {
            line-height:1.4em;
            max-width:600px;
            display:inline-block;
            font-size:13px;
        }

        @media (min-width:40em) {
            p em {
                font-size:15px;
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
            body {
                padding:30px;
            }
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
        .join {
            display: inline-block;
            font: 700 20px/1em "Roboto Condensed",sans-serif;
            text-transform: uppercase;
            background: #F61A30;
            border-radius: 50px;
            color: #FFF;
            padding: 14px 7%;
            outline: none;
            cursor: pointer;
            text-align: center;
            user-select: none;
            text-decoration: none;
            transition: background-color .3s;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
        }
        @media (min-width: 768px) {
            .join {
                font-size: 28px;
            }
            }
    </style>
</head>
<body>
<p><strong>You’re Still In!</strong></p>
<h2 class="my-3 md:my-5">THANK YOU. <br class="inline sm:hidden">AND HERE’S A GIFT</h2>
<p><em>Thanks for choosing to remain on our email list.<br>
        We’ll keep sending you free lessons, tips, and tutorials.
        <br><br>
        In the meantime, enjoy this free lesson series and start learning popular songs today!</em></p>
<a class="inline-block" href="/learn-songs/lessons"><img class="w-full max-w-xl lg:max-w-2xl rounded-xl mx-auto my-5 hover:opacity-90" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/learn-3-songs-ad.jpg"></a><br>
<a href="/learn-songs/lessons" class="join hover:opacity-90">CLICK HERE &raquo;</a>
<div class="social-media">
    <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
    <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
</div>
</body>
</html>
