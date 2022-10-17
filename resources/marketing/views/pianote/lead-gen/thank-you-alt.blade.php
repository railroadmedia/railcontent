<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Check your email | Pianote</title>
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    @include('members.partials._fonts')
    @include('members.partials._favicons')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/parcel/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        p {
            font-family:'Open Sans', sans-serif;
            font-size:15px;
        }

        @media (min-width:40em) {
            p {
                font-size:18px;
            }
        }

        @media (min-width:64em) {
            p {
                font-size:20px;
            }
        }

        h2 {
            font-size:36px;
        }

        @media (min-width:40em) {
            h2 {
                font-size:48px;
            }
        }

        @media (min-width:64em) {
            h2 {
                font-size:60px;
            }
        }

        p em {
            font-size:14px;
        }

        @media (min-width:40em) {
            p em {
                font-size:16px;
            }
        }
    </style>
</head>
<body class="text-center overflow-hidden p-7 sm:p-9">
    <p class="leading-normal"><strong>Thanks for sticking around</strong></p>
    <h2 class="text-pianote uppercase font-bebas leading-none my-2 sm:my-3">We’re so glad<br class="inline sm:hidden"> you’re here!</h2>
    <p class="leading-normal"><em>You’ll continue to get free lessons and tips from Pianote in your inbox. You can unsubscribe
            <br class="hidden md:inline">
            any time. In the meantime, here’s one of our most popular lessons you might enjoy:</em></p>
    <div class="max-w-xl mx-auto mt-4 sm:mt-6">
        <div class="w-full relative aspect-16:9">
            <iframe class="absolute w-full h-full" src="https://www.youtube.com/embed/TZteV8UW3ds" frameborder="0" allowfullscreen allow="autoplay" title="pianote-video"></iframe>
        </div>
    </div>
</body>
</html>
