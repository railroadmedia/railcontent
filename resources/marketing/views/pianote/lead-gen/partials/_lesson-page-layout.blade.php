@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <title>@yield('subtitle') | @yield('title') | Pianote</title>
    <meta name="description" content="@yield('meta-description')">

    <meta property="og:image" content="@yield('meta-img')" style="display: none;">
    <meta property="og:title" content="@yield('subtitle') | @yield('title') | Pianote">
    <meta property="og:description" content="@yield('meta-description')">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

@endsection

@section('head')
    <link href="/marketing/parcel/pianote/lead-gen-learn-songs.css" rel="stylesheet">

    @yield('extra-style')
@endsection

@section('scripts')
    <script type="text/javascript" src="/marketing/parcel/pianote/modal.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/parcel/pianote/modal-autoplay-alt.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.assignment-row .fa-angle-down').click(function () {
                $(this).parent().parent().toggleClass('active');
            });
        });
    </script>
@endsection

@section('page-body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-color:#00101d;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <a href="/classical-piano/lessons">
                    <img class="mx-auto inline-block h-8 md:h-16 lg:h-20 mb-2" src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/@yield('lesson-logo')" alt="lesson logo">
                </a>
                <div class="video-row relative my-4 sm:my-7">
                    @hasSection('prev-thumb')
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -10%; width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('prev-thumb')" alt="prev-thumb">
                    @endif

                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="@yield('video')" frameborder="0" allowfullscreen></iframe>
                    </div>

                    @hasSection('next-thumb')
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translateY(-50%); left: 110%; width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('next-thumb')" alt="next-thumb">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>@yield('subtitle')</strong></h3>
                    <p class="mt-1 sm:mt-2">@yield('caption')</p>
                    <p class="text-pianote mt-1 sm:mt-2"><em>Lesson @yield('current-lesson-number') of @yield('lesson-total-number')</em></p>
                </div>
            </div>
            <div class="flex justify-between text-center mt-3 sm:mt-7 clearfix lesson-buttons">
                <div class="mb-2 sm:mb-0 w-full sm:w-1/4 px-2 md:px-3">
                    @hasSection('previous')
                        <a class="button outline block" href="@yield('previous')">
                            <i class="fas fa-chevron-left"></i> Prev
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
                <div class="mb-2 sm:mb-0 w-full sm:w-1/2 px-2 md:px-3">
                    @hasSection('lesson-index-url')
                        <a class="button outline block white" href="@yield('lesson-index-url')">
                            Back To Lessons
                        </a>
                    @endif
                </div>
                <div class="w-full sm:w-1/4 px-2 md:px-3 next-lesson-button">
                    @hasSection('next')
                        <a class="button outline block" href="@yield('next')">
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
        <div class="px-3 py-6 sm:py-10 text-white" style="background-color:#00101d;">
            <div class="container mx-auto clearfix" style="max-width:700px">
                <div class="text-left lesson-text">
                    @yield('lesson-description')
                </div>
            </div>
        </div>
    @endif

    @hasSection ('assets')
        <div class="px-3 py-6 sm:py-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <h4 class="mb-1 sm:mb-3"><strong>Assets</strong></h4>
                    @hasSection('assets')
                        @yield('assets')
                    @endif

                    @hasSection('all-course-resource')
                        @yield('all-course-resource')
                    @endif
                </div>
            </div>
        </div>
    @endif

    @hasSection('series')
        <div class="text-center text-white py-12 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
            <div class="container mx-auto max-w-5xl series-boxes">
                <h3 class="leading-normal mb-8 max-w-xl lg:max-w-2xl"><strong>Other lessons in this series:</strong></h3>

                @yield('series')
            </div>
        </div>
    @endif

    @yield('offers')
@endsection
