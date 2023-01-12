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
                window.location.href = "https://musora.com/drumeo/courses";
            }
        }
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
                    <a data-open="trial" class="join blue">Explore Drumeo &raquo;</a>
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
            <div class="columns"><a data-close data-open="trial" class="join blue">Explore Drumeo &raquo;</a></div>
        @endif
    </div>

    <div class="reveal large trial text-center" id="trial" data-reveal data-reset-on-close="false">
        <div class="pre-trial">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <h1>You'll <u>learn the drums faster</u> with<br> the best teacher in the world.</h1>
            <div class="artist-wrap large-up-3 medium-up-2 small-up-1">
                @yield('artists')

                <div class="columns artist blue">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/jared-falk.jpg">
                    <p><strong>And Many More...</strong><br>
                        courses, play-alongs, & song breakdowns</p>
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
                a monthly membership for ${{ Prices::$plusSubscriptionMonthlyFull }}/month. Cancel anytime during or after your trial.</p>
        </div>

        <iframe class="trial" name="cartIframe" onload="checkUrl();" src="/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true" frameborder="none"></iframe>
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
