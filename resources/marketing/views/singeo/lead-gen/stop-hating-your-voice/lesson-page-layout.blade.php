@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <meta name="robots" content="noindex">
    <title>@yield('title') | Improve Any Voice</title>
    <title>4 Exercises Guaranteed To Improve ANY Voice!</title>
    <meta name="description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series."/>

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/og-image.jpg">
    <meta property="og:title" content="4 Exercises Guaranteed To Improve ANY Voice!">
    <meta property="og:description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series.">
    <meta property="og:url" content="https://www.singeo.com/stop-hating-your-voice/">
    <link rel="stylesheet" href="{{ asset('/assets/marketing/lead-gen.css') }}">
@stop

@section('scripts')
    @parent
    
    <script type="text/javascript" src="/assets/js/modal-autoplay.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).foundation();

            $('.assignment-row .fa-angle-down').click(function () {
                $(this).parent().parent().toggleClass('active');
            });
        });
    </script>
@stop

@section('body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-color:#000718;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <div class="video-row relative mb-4 sm:mb-7">
                    @hasSection('prev-thumb')
                        <img class="absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -10%;width: 80%;" src="@yield('prev-thumb')">
                    @endif

                    <div class="aspect-16:9 w-full relative">
                        @yield('video')
                    </div>

                    @hasSection('next-thumb')
                        <img class="absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 110%;width: 80%;" src="@yield('next-thumb')">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>@yield('title')</strong></h3>
                    @hasSection('lesson-number')
                        <p class="text-pink mt-1 sm:mt-2">@yield('lesson-number')</p>
                    @endif
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons flex">
                <div class="w-1/4 px-1 md:px-3">
                    @hasSection('previous')
                        <a class="button block" href="@yield('previous')">
                            <i class="fas fa-chevron-left"></i> Prev
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>

                <div class="complete-lesson w-2/4 px-1 md:px-3">
                    <a class="button white outline block" href="/stop-hating-your-voice/lessons">
                        All Lessons <i class="fas fa-chevron-up"></i>
                    </a>
                </div>
                <div class="w-1/4 px-1 md:px-3 next-lesson-button">
                    @hasSection('next')
                        <a class="button block" href="@yield('next')">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="px-3 py-6 sm:py-10">
        <div class="container mx-auto clearfix" style="max-width:920px">
            <div class="text-left lesson-text">
                @hasSection('description')
                    <p class="mb-3 sm:mb-7">
                    @yield('description')
                    </p>
                @endif

                <h4 class="mb-1 sm:mb-3"><strong>Assets</strong></h4>
                @hasSection('assets')
                    @yield('assets')
                @endif
                @include('singeo.lead-gen.stop-hating-your-voice._assignment-resources', [
                    "title" => "Download All MP3 Exercises",
                    "zipURL" => "https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/mp3s.zip"
                ])
            </div>
        </div>
    </div>

    <section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background-color:#010611;">
        <div class="container mx-auto">
            <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
                <a href="/stop-hating-your-voice/lessons/1" class="px-1 md:px-4 w-full sm:w-1/3 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/its-normal-thumb.jpg);">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>It's Normal!</strong></h6>
                </a>
                <a href="/stop-hating-your-voice/lessons/2" class="px-1 md:px-4 w-full sm:w-1/3 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/get-control-thumb.jpg);">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Get Control</strong></h6>
                </a>
                <a href="/stop-hating-your-voice/lessons/3" class="px-1 md:px-4 w-full sm:w-1/3 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/find-your-new-voice-thumb.jpg);">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Find Your New Voice</strong></h6>
                </a>
            </div>
        </div>
    </section>

    <section class="text-center py-12 md:py-20 lg:py-24 text-white bg-center bg-cover lazyload" style="background-color:#030d17;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/final-bg.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="h-10 sm:h-20 lg:h-24 mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1300,q_60,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png">
                <h3><strong>Put your beautiful new voice to work.</strong></h3>
                <h5 class="mt-3 leading-normal">Build your control, range, and confidence with the Singing Starter Kit.<br>
                    Click below for your exclusive discount. Only for How To Stop Hating Your Voice students.</h5>
                <a class="join my-5 md:my-7" href="/singing-starter-kit-discount">CLAIM MY DISCOUNT &raquo;</a>
            </div>
        </div>
    </section>
@stop