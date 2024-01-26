@extends('drumeo.lead-gen.lead-gen-layout')

@section('meta')
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:image" content="@yield('show-tile')" style="display: none;">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="https://www.drumeo.com/shows/@yield('url-slug')/">
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
    <header class="header stacked shows">
        <div class="row xlarge">
            <div class="show-tile autoplay-video" data-open="trailer">
                <img class="tile" src="@yield('show-tile')">
                <div><i class="fas fa-play"></i></div>
                @hasSection('watch-arrow')
                    @yield('watch-arrow')
                @else
                    <img class="arrow" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/watch-free-preview.svg">
                @endif
            </div>
            <div class="columns text-container">
                <p>Enjoy entertaining and educational<br class="hide-for-large"> shows for drummers inside Drumeo.</p>
                @if(auth()->check())
                    <a href="@yield('show-url')" class="join blue">View Show &raquo;</a>
                @else
                    <a href="/choose-your-trial" class="join blue">Explore Drumeo &raquo;</a>
                @endif
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
            <div class="columns"><a href="/choose-your-trial" class="join blue">Explore Drumeo &raquo;</a></div>
        @endif
    </div>

    <section class="lesson-breakdown shows text-center">
        <div class="row">
            @yield('grid-title')

            @hasSection('grid-sub')
                <p class="sub-text">@yield('grid-sub')</p>
            @endif
            <div class="columns tile-wrap small-up-2 medium-up-3">
                @yield('lesson-grid')
            </div>
        </div>
    </section>

    <section class="three-icon">
        <div class="row">
            <h1 class="columns">TV For Drummers</h1>
            <h3 class="columns">Drumeo will keep you entertained with exclusive documentaries, behind-the-scenes <br class="show-for-medium">
                event footage, gear guides, drum solos, performances, video podcasts, and more!</h3>

            <div class="columns medium-4">
                <div class="point-icon"><i class="fas fa-graduation-cap"></i></div>
                <p><strong>Award-Winning<br> Drum Lessons</strong><br>
                    {{ Prices::$drumeoCourses }}+ step-by-step courses from the
                    world’s best drummers and teachers.</p>
            </div>
            <div class="columns medium-4">
                <div class="point-icon"><i class="icon-shows"></i></div>
                <p><strong>Entertaining<br> Shows</strong><br>
                    We’re blending education with entertainment
                    so you always have something to watch.</p>
            </div>
            <div class="columns medium-4">
                <div class="point-icon"><i class="icon-songs"></i></div>
                <p><strong>Song Breakdowns<br> & Play-Alongs</strong><br>
                    Have more fun with popular song
                    breakdowns and our library of play-alongs.</p>
            </div>
        </div>
    </section>

    <section class="final">
        <div class="row">
            <div class="course-logo">
                @yield('logo')
            </div>
            <p class="columns">Enjoy entertaining and educational<br class="hide-for-large"> shows for drummers inside Drumeo.</p>
            @if(auth()->check())
                <div class="columns"><a href="@yield('show-url')" class="join blue">View Show &raquo;</a></div>
            @else
                <div class="columns"><a data-open="trial" class="join blue">Explore Drumeo &raquo;</a></div>
            @endif
        </div>
    </section>
@stop
