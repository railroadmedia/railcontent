@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo Recital</title>
    <meta property="og:title" content="Drumeo Recital">

    <meta name="description" content="We can’t wait to see your submission. Don’t be shy! Submit today!">
    <meta property="og:description" content="We can’t wait to see your submission. Don’t be shy! Submit today!">

    <meta property="og:url" content="https://www.drumeo.com/recitals/">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <style>

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

        @media (min-width:1024px) {
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

        @media (min-width:1024px) {
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

        @media (min-width:1024px) {
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

        @media (min-width:1024px) {
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

        @media (min-width:1024px) {
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

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }

        .google-form {
            height: 2550px;
        }
        @media (min-width:768px) {
            .google-form {
                height: 2420px;
            }
        }
        .promo-banner {
            display: block;
            text-align: center;
            width: 100%;
            transition: opacity 0.5s;
            overflow: hidden;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            z-index: 1;
            padding: 4px 0;
        }
        .promo-banner:hover, .promo-banner:active, .promo-banner:focus {
            color: #eee;
        }
        .promo-banner .container {
            position: relative;
        }
        .promo-banner .logo {
            display: inline-block;
            vertical-align: middle;
            width: auto;
            margin-right: 5px;
            height: 30px;
        }
        @media (min-width: 768px) {
            .promo-banner .logo {
                height: 50px;
            }
        }
        .promo-banner .text {
            display: inline-block;
            vertical-align: middle;
        }
        .promo-banner p {
            font: 400 14px/1.4em 'Open Sans', sans-serif;
            vertical-align: middle;
            display: inline-block;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            .promo-banner p {
                font-size:16px;
            }
        }
        .promo-banner p strong {
            font-weight: 900;
        }

    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="promo-banner text-white" style="background:linear-gradient(to bottom, #01325b, #01101d);">
        <div class="container mx-auto relative z-10">
            <div class="text text-center">

                <p class="leading-none">
                    <strong>Share your progress with the community!</strong> <br>
                        Submission deadline <strong class="text-drumeo">May 31st, 2022.</strong></p>
            </div>
        </div>
    </div>
    <section class="text-center text-white py-5 md:py-10 lg:py-16 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto max-w-5xl">
            <img class="h-24 sm:h-32 lg:h-40 mb-3" src="https://drumeo-assets.s3.amazonaws.com/promos/may/recitals-logo2.png">
            <h3 class="leading-tight"><strong>Share your progress with the<br>  Drumeo Community!</strong></h3>
            <a class="join blue smaller anchor-slide my-5 md:my-7" href="#form">Submit Now &raquo;</a>
            <div class="flex flex-wrap items-start justify-center mx-auto max-w-4xl">
                <div class="flex flex-wrap items-start flex-image mx-auto w-full md:w-4/12 lg:w-5/12 md:order-1 mb-5 md:mb-0 justify-center">
                    <img class="h-60 md:h-auto" src="https://drumeo-assets.s3.amazonaws.com/promos/november/recital-spread.png">
                </div>
                <div class="text-left md:pr-3 lg:pr-8 w-full md:w-8/12 lg:w-7/12">
                    <p class="mx-auto">With close to 30,000 Drumeo members, this will no doubt be our biggest Drum Recital yet!
                        <br><br>
                        This amazing community event is all about sharing your progress with your fellow community members and your drum instructors.
                        <br><br>
                        Don’t worry, we’ve made it super easy to submit your performance this year.
                        <br><br>
                        You can choose to submit ANY video clip of you playing the drums.
                        <br><br>
                        Any song, beat, fill, or rudiment!
                        <br><br>
                        Anything that you learned this year and you’re proud of.
                        <br><br>
                        That’s it!
                        <br><br>
                        Then all that’s left is to join Jared, Dave, Kyle, and the rest of the Drumeo community to cheer on your peers at the recitals, dates to be announced soon!
                        <br><br>
                        We can’t wait to see your submission. Don’t be shy! Submit today!</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 md:py-10 lg:py-16" style="background:#000 url(https://drumeo-assets.s3.amazonaws.com/promos/november/recital-bg.jpg) center center/cover;">
        <div class="container mx-auto max-w-3xl">
            <div id="form" class="anchor"></div>
            <iframe class="google-form w-full" src="https://docs.google.com/forms/d/e/1FAIpQLScRKA6Dwt57208VCZr6h1nr2zOvvVoPawVt5sRQ7BZISEGzrw/viewform?embedded=true" height="2177" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
            <div class="max-w-2xl mx-auto px-5 md:px-3 mt-5">
                <a class="join blue smaller outline w-full mx-auto" href="/members">RETURN TO MEMBER’S AREA &raquo;</a>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

@stop
