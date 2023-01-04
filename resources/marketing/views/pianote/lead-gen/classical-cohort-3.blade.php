@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Classical Cohort</title>
    <meta property="og:title" content="Classical Cohort">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">

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
    </style>
@stop()
@section('global-body')
    @include('pianote._partials._nav')
    <section class="text-center text-white py-5 md:py-10 lg:py-16 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto text-center">
            <h2><strong>Classical Cohort - <br class="inline sm:hidden">Week 3 - Romantic</strong></h2>
            <div class="flex flex-wrap my-5 sm:my-7">
                <div class="w-full lg:w-9/12">
                    <div class="w-full relative aspect-16:9">
                        <iframe class="absolute w-full h-full" src="https://www.youtube.com/embed/muPbCm1iQuI" frameborder="0" allowfullscreen allow="autoplay" title="pianote-video"></iframe>
                    </div>
                </div>
                <div class="w-full lg:w-3/12 h-96 lg:h-auto">
                    <div class="w-full h-full relative">
                        <iframe class="absolute w-full h-full" src="https://www.youtube.com/live_chat?v=muPbCm1iQuI&embed_domain=www.pianote.com" frameborder="0" allowfullscreen allow="autoplay" title="pianote-video"></iframe>
                    </div>
                </div>
            </div>
            <a class="join" href="/trial">Start Your Free Trial &raquo;</a>
        </div>
    </section>

    @include('pianote._partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
