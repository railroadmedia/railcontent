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
    <meta property="og:url" content="https://www.singeo.com/improve-any-voice/">
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
                        <p class="text-yellow mt-1 sm:mt-2">@yield('lesson-number')</p>
                    @endif
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons">
                <div class="mb-2 sm:mb-0 w-1/2 sm:w-1/3 float-left px-2 md:px-3">
                    @hasSection('previous')
                        <a class="button block" href="@yield('previous')">
                            <i class="fas fa-chevron-left"></i> Prev
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>

                <div class="complete-lesson mb-2 sm:mb-0 w-full sm:w-1/3 float-left px-2 md:px-3 hidden sm:block">&nbsp;</div>
                <div class="w-1/2 sm:w-1/3 float-left px-2 md:px-3 next-lesson-button">
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
                <h4 class="mb-1 sm:mb-3"><strong>Assets</strong></h4>
                @hasSection('assets')
                    @yield('assets')
                @endif
                @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
                    "title" => "Download All MP3 Exercises",
                    "zipURL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-exercises.zip"
                ])
            </div>
        </div>
    </div>
    <section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background-color:#010611;">
        <div class="container mx-auto">
            <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
                @php
                    $lessons = [
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-1.png',
                            'title' => 'Vocal Lesson #1 - Start Here',
                            'titleColor' => '#f6d31a',
                            'desc' => 'Why You Need To<br class="hidden md:inline"> Exercise Your Voice',
                            'href' => '/improve-any-voice/lessons/1'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-2.png',
                            'title' => 'Vocal Lesson #2',
                            'titleColor' => '#f51a93',
                            'desc' => 'The Most Useful<br class="hidden md:inline"> Vocal Exercise',
                            'href' => '/improve-any-voice/lessons/2'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-3.png',
                            'title' => 'Vocal Lesson #3',
                            'titleColor' => '#50e49e',
                            'desc' => 'The Perfect<br class="hidden md:inline"> Balance Exercise',
                            'href' => '/improve-any-voice/lessons/3'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png',
                            'title' => 'Vocal Lesson #4',
                            'titleColor' => '#19b2f6',
                            'desc' => 'The Strength Building,<br class="hidden md:inline"> Pitch Accuracy Exercise',
                            'href' => '/improve-any-voice/lessons/4'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-5.png',
                            'title' => 'Vocal Lesson #5',
                            'titleColor' => '#ff1c52',
                            'desc' => 'The Range<br class="hidden md:inline"> Builder Exercise',
                            'href' => '/improve-any-voice/lessons/5'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-6.png',
                            'title' => 'Vocal Lesson #6',
                            'titleColor' => '#ff6900',
                            'desc' => 'The Full Vocal<br class="hidden md:inline"> Routine',
                            'href' => '/improve-any-voice/lessons/6'
                        ],
                    ];
                @endphp
                
                @include('singeo.lead-gen.partials._lesson-tiles2')
            </div>
        </div>
    </section>
@stop