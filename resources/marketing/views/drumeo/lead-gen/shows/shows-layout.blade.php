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

            // swap modal state
            $(".start-trial").click(function (e) {
                e.stopPropagation();
                $(this).parent().addClass('hide');
                $('iframe.trial').addClass('active');
            });

            // reset modal state on close
            $('.reveal-overlay').on('click', function (e) {
                if (e.target !== this) {
                    return;
                }

                $('.pre-trial').removeClass('hide');
                $('iframe.trial').removeClass('active');
            });
            $(document).keyup(function(e) {
                if (e.which === 27) {
                    $('.pre-trial').removeClass('hide');
                    $('iframe.trial').removeClass('active');
                }
            });
        });

        // redirect to members area when cart complete
        function checkUrl() {
            if($('iframe.trial').contents().get(0).location.href.indexOf('members') > -1) {
                window.location.href = "https://www.musora.com/drumeo/courses";
            }
        }
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
                    <a data-open="trial" class="join blue">Explore Drumeo &raquo;</a>
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
            <div class="columns"><a data-close data-open="trial" class="join blue">Explore Drumeo &raquo;</a></div>
        @endif
    </div>

    <div class="reveal large trial text-center" id="trial" data-reveal data-reset-on-close="false">
        <div class="pre-trial">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <h1>You'll <u>learn the drums faster</u> with<br> the best teacher in the world.</h1>
            <div class="artist-wrap shows large-up-3 medium-up-2 small-up-1">
                @yield('artists')

                <div class="columns artist blue">
                    <div class="plus"><i class="fas fa-plus"></i></div>
                    <p><strong>And Many More...</strong><br>
                        Performances, Challenges, Solos & Bootcamps</p>
                </div>
            </div>
            <div class="awards columns">
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/badge-modern-drummer.png">
                </div>
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/badge-shopper-approved.png">
                </div>
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/badge-drummies.png">
                </div>
            </div>
            <a class="join blue start-trial">Start Free Trial &raquo;</a>
            <p class="disclaimer">Credit card required. You’ll get unlimited access FREE for 7 days before continuing with<br class="show-for-large">
                a monthly membership for ${{ Prices::$drumeoEdgeFull }}/month. Cancel anytime during or after your trial.</p>
        </div>

        <iframe class="trial" name="cartIframe" onload="checkUrl();" src="/laravel/public/shopping-cart/api/query?products[DLM-Trial]=1,month,1&locked=true" frameborder="none"></iframe>
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
                    {{ Prices::$courses }}+ step-by-step courses from the
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
            <div class="awards columns">
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/badge-modern-drummer.png">
                </div>
                <div class="columns small-4">
                    <a target="_blank" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;"><img src="https://dpwjbsxqtam5n.cloudfront.net/sales/badge-shopper-approved.png"></a>
                </div>
                <div class="columns small-4">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/badge-drummies.png">
                </div>
            </div>
        </div>
    </section>
@stop
