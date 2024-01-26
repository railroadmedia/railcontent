@extends('drumeo.lead-gen.lead-gen-layout')

@section('meta')
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/@yield('url-slug')/header-image.jpg" style="display: none;">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="https://www.drumeo.com/courses/@yield('url-slug')/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-shows.css') }}" rel="stylesheet">
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop

@section('content')
    <header class="header stacked">
        <div class="row xlarge" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/@yield('url-slug')/header-image.jpg')">
            <div class="autoplay-video" data-open="trailer"><i class="fas fa-play"></i></div>

            <div class="columns text-container">
                <div class="course-logo">
                    @yield('logo')
                </div>
                <p>@yield('time')-minute video course @yield('theme'),<br class="hide-for-large"> exclusively inside Drumeo.</p>
                @if(auth()->check())
                    <a href="@yield('course-url')" class="join blue">View Course &raquo;</a>
                @else
                    <a href="/choose-your-trial" class="join blue">Explore Drumeo &raquo;</a>
                @endif
                <p class="edge-info"><em>Drumeo includes unlimited access <br class="hide-for-medium"> to {{ Prices::$drumeoCourses }}+ courses and so much more.</em></p>
            </div>
        </div>
    </header>

    <div class="reveal large trailer text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="flex-video widescreen vimeo">
            <iframe class="reset-on-close" src="" data-lazy-load-url="@yield('trailer-url')" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        @if(auth()->check())
            <div class="columns"><a href="@yield('course-url')" class="join blue" data-close aria-label="Close modal">View Course &raquo;</a></div>
        @else
            <div class="columns"><a class="join blue" href="/choose-your-trial">Explore Drumeo &raquo;</a></div>
        @endif
    </div>

    <section class="about-instructor">
        <div class="row">
            <div class="columns medium-5 large-6 float-right">
                <div class="arrow-outline">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/@yield('url-slug')/artist.jpg">
                </div>
            </div>
            <div class="columns end medium-7 large-6 text-wrap">
                @yield('biography')
            </div>
        </div>
    </section>

    <section class="lesson-breakdown text-center">
        <div class="row">
            <h1>@yield('grid-title')</h1>
            <div class="columns tile-wrap small-up-2 medium-up-3">
                @yield('lesson-grid')
            </div>
        </div>
    </section>

    <section class="three-icon">
        <div class="row">
            <h1 class="columns">Become The Drummer That<br class="show-for-medium"> Other Musicians Love</h1>
            <h3 class="columns">Drumeo was built to improve your technique, develop your musicality,<br class="show-for-medium">
                and help you become a complete musician that others LOVE to be around.</h3>

            <div class="columns medium-4">
                <div class="point-icon"><i class="fas fa-signal-alt-3"></i></div>
                <p><strong>Improve Your Skills</strong><br>
                    {{ Prices::$drumeoCourses }}+ step-by-step courses from the
                    world’s best drummers and teachers.</p>
            </div>
            <div class="columns medium-4">
                <div class="point-icon"><i class="fas fa-music"></i></div>
                <p><strong>Play Your Favorite Songs</strong><br>
                    Have more fun with popular song
                    breakdowns and our library of play-alongs.</p>
            </div>
            <div class="columns medium-4">
                <div class="point-icon"><i class="fas fa-smile"></i></div>
                <p><strong>Have More Fun Playing</strong><br>
                    Join a community of drummers to motivate
                    and inspire you towards your biggest goals.</p>
            </div>
        </div>
    </section>

    <section class="final">
        <div class="row">
            <div class="course-logo">
                @yield('logo')
            </div>
            <p class="columns">This course is only available inside Drumeo.</p>
            @if(auth()->check())
                <div class="columns"><a href="@yield('course-url')" class="join blue">View Course &raquo;</a></div>
            @else
                <div class="columns"><a data-open="trial" class="join blue">Explore Drumeo &raquo;</a></div>
            @endif
        </div>
    </section>
@stop
