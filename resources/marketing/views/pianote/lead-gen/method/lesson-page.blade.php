@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Pianote Method | Pianote</title>
    <meta name="description" content="Master the fundamentals -- so you can play anything you want on the piano.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/method/og-image.png" style="display: none;">
    <meta property="og:title" content="Pianote Method">
    <meta property="og:description" content="Master the fundamentals -- so you can play anything you want on the piano.">
    <meta property="og:url" content="https://www.pianote.com/method">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link rel="stylesheet" href="/marketing/parcel/pianote/lead-gen.css">
    <link rel="stylesheet" href="https://www.drumeo.com/laravel/public/assets/members-area/css/gulp/lead-gen.css">

    <style>
        a:hover {
            text-decoration:none;
        }
        .lesson-contents .video-wrapper .lesson-resources a {
            border-color:#F61A30;
            color: #F61A30;
            border-radius:200px;
        }
        .lesson-contents .video-wrapper .lesson-resources a:hover {
            background:#F61A30;
            border-color:#F61A30;
            color: #fff;
        }
        .lesson-nav .lesson-tile.special p {
            color: #F61A30;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.nav')

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <section class="lesson-nav">
        <div class="container mx-auto clearfix">
            <div class="float-left w-1/2 px-2 md:px-3 md:w-1/4 lesson-tile">
                <a href="/method/why-people-fail">
                    <div class="thumb">
                        <div class="icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <img src="https://i.vimeocdn.com/video/1021902360-173520b20a2a6312f51c6ec89b28fe4307c4dd2c93a9fabfd7a87f1651178834-d_480"></div>
                    <p>Why People Fail</p>
                </a>
            </div>
            @if(Carbon\Carbon::create(2020, 12, 30, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
                <div class="float-left w-1/2 px-2 md:px-3 md:w-1/4 lesson-tile locked">
                    <div class="thumb">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                            <span class="date">Dec 30th</span>
                        </div>
                        <img src="https://i.vimeocdn.com/video/1021923548-9cccfec33c0593e8fdd90e96ae934648e5e66b4154bbd6dbb48ef1e4c9fbb813-d_480"></div>
                    <p>Play A Song In ONE Lesson</p>
                </div>
            @else
                <div class="float-left w-1/2 px-2 md:px-3 md:w-1/4 lesson-tile">
                    <a href="/method/play-a-song">
                        <div class="thumb">
                            <div class="icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <img src="https://i.vimeocdn.com/video/1021923548-9cccfec33c0593e8fdd90e96ae934648e5e66b4154bbd6dbb48ef1e4c9fbb813-d_480"></div>
                        <p>Play A Song In ONE Lesson</p>
                    </a>
                </div>
            @endif
            @if(Carbon\Carbon::create(2020, 12, 31, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
                <div class="float-left w-1/2 px-2 md:px-3 md:w-1/4 lesson-tile locked">
                    <div class="thumb">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                            <span class="date">Dec 31st</span>
                        </div>
                        <img src="https://i.vimeocdn.com/video/1021923527-cfde0a06f7b4bca5ff6ffa5ff36b23776a7e11a40321047cd66c021d009b91af-d_480"></div>
                    <p>How To Guarantee Success</p>
                </div>
            @else
                <div class="float-left w-1/2 px-2 md:px-3 md:w-1/4 lesson-tile">
                    <a href="/method/guarantee-success">
                        <div class="thumb">
                            <div class="icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <img src="https://i.vimeocdn.com/video/1021923527-cfde0a06f7b4bca5ff6ffa5ff36b23776a7e11a40321047cd66c021d009b91af-d_480"></div>
                        <p>How To Guarantee Success</p>
                    </a>
                </div>
            @endif

            <div class="float-left w-1/2 px-2 md:px-3 md:w-1/4 lesson-tile special">
                <a href="/">
                    <div class="thumb">
                        <img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/method/thumb.png">
                    </div>
                    {{--<p>Coming In <span class="tzcd"></span>!</p>--}}
                    <p>Learn More &raquo;</p>
                </a>
            </div>
        </div>
    </section>
    <section class="lesson-contents">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-2 md:px-3">
                <div class="float-left w-full px-2 md:px-3 no-padding video-wrapper">
                    <div class="lesson-title">
                        <h1>@yield('title')</h1>
                    </div>

                    <div class="aspect-16:9 w-full relative">
                        @yield('video')
                    </div>
                    <div class="lesson-description">
                        <p>@yield('description')</p>
                    </div>
                    <div class="lesson-resources text-center">
                        @yield('resources')
                    </div>
                    <div class="lesson-resources text-center">
                        <div class="fb-comments" data-href="{{ env("APP_URL") . "method" }}" data-mobile="true" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('pianote.sales.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script type="text/javascript" src="/marketing/js/modal-autoplay-bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            // countdown function
            $(function () {
                $('.tzcd').countdown('2021/01/01 09:00:00')
                    .on('update.countdown', function (event) {
                        var format = '%-MM';
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
            });
        });
    </script>
    @yield('scripts')
@stop
