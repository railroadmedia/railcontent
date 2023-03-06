@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    <meta name="robots" content="noindex">
    <title>@yield('subtitle') | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">
@stop

@section('scripts')
    @parent
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
                        <iframe class="absolute w-full h-full" src="@yield('video')" frameborder="0" allowfullscreen></iframe>
                    </div>

                    @hasSection('next-thumb')
                        <img class="absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 110%;width: 80%;" src="@yield('next-thumb')">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>@yield('subtitle')</strong></h3>
                    <p class="text-yellow mt-1 sm:mt-2">Lesson @yield('current-lesson-number') of @yield('total-lesson-number')</p>
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons flex">
                <div class="mb-2 sm:mb-0 w-1/2 sm:w-1/3 px-2 md:px-3">
                    @hasSection('previous')
                        <a class="button block" href="@yield('previous')">
                            <i class="fas fa-chevron-left"></i> Prev
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
                <div class="complete-lesson w-2/4 px-1 md:px-3">
                    @hasSection ('all-lesson-link')
                        <a class="button white outline block" href="@yield('all-lesson-link')">
                            All Lessons <i class="fas fa-chevron-up"></i>
                        </a>
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="w-1/2 sm:w-1/3 px-2 md:px-3 next-lesson-button">
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

    @hasSection ('description')
        <div class="px-3 pt-6 sm:pt-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    @yield('description')
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
    @hasSection('assignments')
    <div class="px-3 py-6 sm:py-10">
        <div class="container mx-auto clearfix" style="max-width:920px">
            <div class="text-left lesson-text">
                <h4 class="mb-1 sm:mb-3"><strong>Assignments</strong></h4>
                @yield('assignments')
            </div>
        </div>
    </div>
@endif
    <section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background-color:#010611;">
        <div class="container mx-auto">
            <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
                @yield('lesson-tiles')
            </div>
        </div>
    </section>
    <section class="text-center py-12 md:py-20 text-white bg-center bg-cover lazyload" style="background-color:#030d17;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://singeo.s3.amazonaws.com/products/singing-starter-kit/final-bg.jpg">
        <div class="container mx-auto">
            <div class="w-full px-3 md:px-4 text-center">
                <img class="h-16 sm:h-20 lg:h-24 mb-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,q_60,quality=85/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png">
                <h3><strong>Put your beautiful new voice to work.</strong></h3>
                <h5 class="mt-3 leading-normal">
                    Build your control, range, and confidence with the Singing Starter Kit.<br class="hidden sm:inline">
                    Click below for your exclusive discount. <br class="hidden sm:inline lg:hidden">
                    Only for Improve Any Voice students.</h5>
                <a class="join my-5 md:my-7" href="/singing-starter-kit-discount">CLAIM MY DISCOUNT &raquo;</a>
            </div>
        </div>
    </section>
@stop
