<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Success! | Guitareo</title>
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-guitareo.jpg" style="display: none;">
    @include('_partials.layout.favicons.guitareo-favicons')
    @include('_partials.layout._fonts')
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        body {
            text-align:center;
            overflow: hidden;
        }

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:991px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:991px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:991px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:991px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:991px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:991px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:991px) {
            li, p {
                font-size:16px
            }
        }
        .join {
            display: inline-block;
            font: 700 13px/1em "Roboto Condensed",sans-serif;
            text-transform: uppercase;
            background: #00c9ac;
            border: 2px solid #00c9ac;
            border-radius: 50px;
            color: #FFF;
            outline: none;
            cursor: pointer;
            text-align: center;
            user-select: none;
            text-decoration: none;
            transition: background-color .3s;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
            padding: 7px 10px;
        }
        @media (min-width: 768px) {
            .join {
                font-size: 14px;
                padding: 13px 30px;
            }
        }

        .join:hover,
        .join:focus {
            background:#00e0bf;
            border-color:#00e0bf;
        }

        .join.outline {
            background:transparent;
            border:2px solid #00c9ac;
            color:#00c9ac;
        }

        .join.outline:hover,
        .join.outline:focus {
            background:#00c9ac;
            color:#fff;
        }
    </style>
</head>
<body class="p-6 md:p-10">
<h5><strong>Success!</strong></h5>
<h1 class="text-guitareo my-4"><i class="fas fa-check"></i> </h1>
<p class="mb-5">You've been successfully subscribed.<br class="hidden md:inline">
    Check your inbox soon for great emails from Guitareo.</p>

<br><a class="my-2 mx-1 join" href="https://www.musora.com/guitareo">Members Area &raquo;</a>
</body>
</html>
