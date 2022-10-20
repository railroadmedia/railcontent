@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <meta name="robots" content="noindex">
    <title>@yield('subtitle') | @yield('title')</title>
    <meta property="og:title" content="@yield('subtitle') | @yield('title')">
    <meta name="description" content="@yield('meta-description')"/>
    <meta property="og:description" content="@yield('meta-description')">
    <meta property="og:image" content="@yield('image')">
    <meta property="og:url" content="@yield('url')">

    <link rel="stylesheet" href="/marketing/parcel/guitareo/song-in-an-hour.css">
@stop

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function (e) {
            $(document).foundation();

            $('.assignment-row .fa-angle-down').click(function() {
                $(this).parent().parent().toggleClass('active');
            });
        });
    </script>
    <script src="/marketing/parcel/guitareo/modal-autoplay.js"></script>
@stop

@section('body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-color:#000718;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                @yield('lesson-logo')
                <div class="video-row relative my-4 sm:my-7">
                    @hasSection('prev-thumb')
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -10%;width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('prev-thumb')">
                    @endif

                    @hasSection ('video')
                        <div class="aspect-16:9 w-full relative">
                            <iframe class="absolute w-full h-full inset-0" src="@yield('video')" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @endif

                    @hasSection('next-thumb')
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 110%;width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('next-thumb')">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>@yield('subtitle')</strong></h3>
                        <p class="text-guitareo mt-1 sm:mt-2">Lesson @yield('current-lesson-number') of @yield('lesson-total-number')</p>
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons">
                <div class="mb-2 sm:mb-0 w-full sm:w-1/4 float-left px-2 md:px-3">
                    @hasSection('previous')
                        <a class="button outline guitareo block no-underline" href="@yield('previous')">
                            <i class="fas fa-chevron-left"></i> Prev
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>

                <div class="mb-2 sm:mb-0 w-full sm:w-2/4 float-left px-2 md:px-3">
                    <a class="button outline guitareo block no-underline" href="@yield('all-lesson-link')">
                        All Lessons
                        <i class="fas fa-chevron-up"></i>
                    </a>
                </div>
                <div class="w-full sm:w-1/4 float-left px-2 md:px-3 next-lesson-button">
                    @hasSection('next')
                        <a class="button outline guitareo block no-underline" href="@yield('next')">
                            @hasSection('next-text')
                                @yield('next-text')
                            @else
                                Next
                            @endif
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @hasSection('lesson-description')
        <div class="px-3 pt-6 sm:pt-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <p>
                        @yield('lesson-description')
                    </p>
                </div>
            </div>
        </div>
    @endif

    @hasSection('assignments')
        <div class="px-3 pt-6 sm:pt-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <h4 class="mb-1 sm:mb-3"><strong>Assignments</strong></h4>
                    @yield('assignments')
                </div>
            </div>
        </div>
    @endif

    @hasSection('assets')
        <div class="px-3 py-6 sm:py-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <h4 class="mb-1 sm:mb-3"><strong>Assets</strong></h4>
                    @yield('assets')
                </div>
            </div>
        </div>
    @endif
@stop
