@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <title>GuitarQuest | Your Guitar Journey Starts Here</title>
    <meta name="description" content="Rob Scallon’s online guitar lessons for getting started on the guitar and making your favorite musical projects come to life."/>

    <meta property="og:url" content="https://www.guitareo.com/guitar-quest"/>
    <meta property="og:title" content="GuitarQuest | Your Guitar Journey Starts Here"/>
    <meta property="og:description" content="Rob Scallon’s online guitar lessons for getting started on the guitar and making your favorite musical projects come to life."/>
    <meta property="og:image" content="{{ imgix("https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/share-image.png", ["auto" => "format", "w" => 1500]) }}"/>

    <style>
        .hover-yellow:hover {
            transition:background-color .3s;
            background-color:#FFB500!important;
        }
    </style>

    <link href="{{ asset('assets/marketing/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/marketing/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/marketing/guitar-quest.css') }}" rel="stylesheet">

@stop()

@section('layout-scripts')
    @parent
    <script src="{{ asset('assets/marketing/svg-polyfil.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/marketing/nav-footer.js') }}"></script>
    <script src="/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Countdown
            $('.tzcd-full').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
        
        // $(document).on('mouseleave', function(e){
        //     if( e.clientY < 0 )
        //         document.getElementById("exitPop").click();
        //         document.getElementById("exitPop").remove();
        // });
        $(document).ready(function () {
            $(".infusion-form").submit(function(event) {
                if(event.originalEvent != null) {
                    var formId = $(this).find('input[name="inf_form_xid"]').val();

                    dataLayer.push({
                        'event': 'gtm.formSubmit',
                        'formId': formId,
                        'formSuccess': true
                    });
                }
            });
        });
    </script>
@stop()

@section('layout-body')
    <!-- Guitareo Nav -->
    @include("guitareo.sales.partials._nav")
    <!-- Guitar Quest Nav -->
    @include("products.guitar-quest.partials._nav")


    <main>
        @yield('top-promo-banner')
        <!-- Your Quest Section --> 
        @include("products.guitar-quest.partials.sections._your-quest")

        @yield('promo-banner')

        <!-- Fixed Image Featues (x3) -->
        @include("products.guitar-quest.partials.sections._fixed-image-features")

        <!-- Your Map Section -->
        @include("products.guitar-quest.partials.sections._your-map")

        <!-- Your Skills Section -->
        @include("products.guitar-quest.partials.sections._your-skills")

        <!-- Your Teacher Section -->
        @include("products.guitar-quest.partials.sections._your-teacher")

        <!-- Your Way -->
        @include("products.guitar-quest.partials.sections._your-way")

        <!-- Start Here -->
        @yield('final')

        <!-- Trailer Modal -->
        @include("products.guitar-quest.partials._trailer-modal")

    </main>
    {{--<div id="exitPop" class="tw-opacity-0" x-on:click.prevent="modalOpen = 'exitModal';"></div>--}}
    {{--<div x-show.transition.opacity="modalOpen === 'exitModal'"--}}
            {{--x-cloak--}}
            {{--class="tw-overflow-y-scroll tw-p-4 tw-fixed tw-inset-0 tw-bg-black tw-bg-opacity-75 tw-z-250 soft-block">--}}
        {{--<button class="tw-text-white tw-text-4xl md:tw-text-7xl tw-cursor-pointer tw-ml-auto tw-mb-6"--}}
                {{--x-on:click.prevent="modalOpen = false;">--}}
            {{--<i class="fas fa-times"></i>--}}
        {{--</button>--}}
        {{--<div x-show.transition="modalOpen === 'exitModal'"--}}
                {{--x-on:click.away="modalOpen = false;"--}}
                {{--class="tw-flex tw-flex-wrap tw-items-start tw-max-w-screen tw-mx-auto tw-bg-white tw-p-3 md:tw-p-6 tw-rounded-lg tw-max-w-lg tw-text-center">--}}
            {{--<img style="filter:invert(1)" class="tw-h-8 md:tw-h-10 tw-mx-auto" src="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-white.png">--}}
            {{--<br>--}}
            {{--<h1 style="color:#9101f6;" class="tw-w-full tw-uppercase tw-leading-none tw-text-6xl md:tw-text-8xl font-bison-bold tw-mt-2">* WAIT *</h1>--}}
            {{--<br>--}}
            {{--<h2 class="tw-w-full tw-uppercase tw-leading-none tw-text-3xl md:tw-text-5xl font-bison-bold">GET YOUR FIRST MISSION FREE!</h2>--}}
            {{--<br>--}}
            {{--<p class="tw-w-full tw-text-md md:tw-text-xl tw-my-3">Enter your email to start your GuitarQuest <br class="tw-hidden md:tw-inline">--}}
                {{--for free, no credit card required.</p>--}}
            {{--<div class="tw-w-full">--}}
                {{--@include("lead-gen.partials._sign-up-form-tw", [--}}
                        {{--"stacked" => true,--}}
                        {{--"formId" => "Guitareo - Engagement - Trigger - Song Hour - Web Form",--}}
                        {{--"formName" => 'Song Hour',--}}
                        {{--"redirectURL" => "/song-in-an-hour/thank-you",--}}
                        {{--"buttonText" => "Send My First Mission "--}}
                   {{--])--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    @include("guitareo.sales.partials._footer")
@stop