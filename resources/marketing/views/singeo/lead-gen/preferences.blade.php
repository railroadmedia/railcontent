<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Updated! | Singeo</title>
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2022/og-image.jpg"/>

    @include('_partials.layout._fonts')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">
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
            color:#9a00ee;
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

        .social-links a {
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
            .social-links a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0;
            }
        }

        @media (min-width:64em) {
            .social-links a {
                width:90px;
                height:90px;
                line-height:90px;
                font-size:45px;
            }
        }
    </style>
</head>
<body>
<h2>Success!</h2>
<p><em>Your preferences have been updated successfully. Thank you!</em></p>
<br><a class="my-2 mx-1 join smaller" href="https://www.musora.com/singeo">Members Area &raquo;</a>
</body>
</html>
