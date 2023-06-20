@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Grooves Of John Bonham | Drumeo</title>
    <meta property="og:title" content="Grooves Of John Bonham | Drumeo">
    <meta name="description" content="The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)">
    <meta property="og:description" content="The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/grooves-of-john-bonham/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/grooves-of-john-bonham/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-shows.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="text-white relative overflow-hidden text-center py-5 md:py-8 px-4 md:px-6" style="background:#0f1012 url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/header-image.jpg) center top/cover;">
        <div class="container mx-auto relative z-20">
            <i class="fas fa-play play-button autoplay-video mt-32 md:mt-40 lg:mt-52 mb-6 md:mb-28 lg:mb-36" data-open="trailer"></i>
            <h4>BREAKING DOWN THE GROOVES OF</h4>
            <h1 class="tracking-widest lg:tracking-wider my-0.5"><strong>JOHN BONHAM</strong></h1>
            <h6 class="text-yellow-400 uppercase">With Brian Tichy</h6>

            <h5 class="leading-normal my-3 md:my-5">Learn 10 of Led Zeppelin’s most famous <br class="inline md:hidden"> grooves in this FREE Drumeo series.</h5>
            <div class="mx-auto text-center max-w-3xl">
                @include("drumeo.lead-gen.partials.sign-up-form-rc", [
                    "recaptchaKey" => $recaptchaKey,
                    "formName" => 'Grooves Of John Bonham',
                    "formId" => "Drumeo - Engagement - Trigger - Grooves Of John Bonham - Web Form",
                    "buttonText" => "Hook Me Up ",
                ])
            </div>
        </div>
    </header>

    <section class="px-4 py-7 md:py-10" style="background: #eeeff0;">
        <div class="container mx-auto max-w-5xl clearfix">
            <div class="flex flex-wrap items-center justify-center mx-auto">
                <img class="h-72 md:h-auto rounded-xl w-auto md:w-3/12 lg:w-4/12 md:order-1 mb-5 md:mb-0" src="https://live.staticflickr.com/3558/3555264805_941b7466e2_c.jpg" alt="john-bonham">
                <p class="text-left md:pr-3 lg:pr-8 w-full md:w-9/12 lg:w-8/12">Twelve seconds.
                    <br><br>
                    That’s all it took for John Bonham’s drumming to change music forever. His fiery debut fill on “Good Times Bad Times” set the stage for what would become the most celebrated career in rock drumming history. And now it’s your turn to learn the grooves that changed music.
                    <br><br>
                    In this free course, you’ll get a note-for-note breakdown of Bonzo’s most popular beats. And more than that, you’ll hear exactly what made John Bonham’s playing one of a kind.
                    <br><br>
                    Your instructor, Brian Tichy (Whitesnake), has studied John Bonham’s playing with precision to bring you the ultimate guide to Led Zeppelin’s legendary drum grooves.
                    <br><br>
                    By the end of this course, you’ll be a certified Bonham expert -- able to replicate his most famous beats with confidence. Plus, you’ll learn the fascinating details of how these legendary grooves came to be.</p>
            </div>
        </div>
    </section>

    <section class="lesson-breakdown text-center">
        <div class="container mx-auto max-w-5xl">
            <h1>    Play The Led Zeppelin<br> Grooves That You Love
            </h1>
            <div class="w-full px-2 md:px-3 tile-wrap flex flex-wrap justify-center">
                <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/when-the-levee-breaks.jpg);">
                        <p>When The Levee<br> Breaks Groove</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/fool-in-the-rain.jpg);">
                        <p>Fool In The<br> Rain Groove</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/bonham-triplets.jpg);">
                        <p>Bonham Triplets</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/good-times-bad-times.jpg);">
                        <p>Good Times,<br> Bad Times</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/black-dog.jpg);">
                        <p>Black Dog</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/the-immigrant-song.jpg);">
                        <p>Immigrant Song</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/stairway-to-heaven.jpg);">
                        <p>Stairway<br> To Heaven</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/rock-n-roll.jpg);">
                        <p>Rock N' Roll</p>
                    </div>
                </div>    <div class="w-1/2 md:w-1/3 px-2 md:px-3 tile">
                    <div class="thumb" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/the-grooves-of-bonham/moby-dick.jpg);">
                        <p>Moby Dick - Studio Fury Lick</p>
                    </div>
                </div>            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#000a1e",
        "textColor" => "white"
    ])

    <section class="text-white relative overflow-hidden text-center py-24 md:py-32 lg:py-44 px-4 md:px-6" style="background:#030d17 url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/bg-customize.jpg) center top/cover;">
        <div class="container mx-auto relative z-20">
            <h4>BREAKING DOWN THE GROOVES OF</h4>
            <h1 class="tracking-widest lg:tracking-wider my-0.5"><strong>JOHN BONHAM</strong></h1>
            <h6 class="text-yellow-400 uppercase">With Brian Tichy</h6>

            <h5 class="leading-normal my-3 md:my-5">Learn 10 of Led Zeppelin’s most famous <br class="inline md:hidden"> grooves in this FREE Drumeo series.</h5>
            <div class="mx-auto text-center max-w-3xl">
                @include("drumeo.lead-gen.partials.sign-up-form-rc", [
                    "recaptchaKey" => $recaptchaKey,
                    "formName" => 'Grooves Of John Bonham',
                    "formId" => "Drumeo - Engagement - Trigger - Grooves Of John Bonham - Web Form",
                    "buttonText" => "Hook Me Up ",
                ])
            </div>
        </div>
        {{--<div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10" style="    background: linear-gradient(to bottom, rgba(18, 80, 161, 0.3) 0%, rgba(5, 46, 87, 0.9) 100%);"></div>--}}
    </section>

    <div class="reveal max-w-4xl" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/320570405?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
