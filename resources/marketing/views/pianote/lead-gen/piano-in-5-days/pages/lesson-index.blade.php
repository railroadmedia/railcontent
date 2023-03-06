@extends('pianote.lead-gen.piano-in-5-days.piano-in-5-days-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('page-body')
    <header class="header text-center text-white py-12 md:py-18 lg:py-20 px-4 bg-center bg-no-repeat relative" style="background-color:#010519; background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/bottom_bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-16 md:h-20 lg:h-44" src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/logo.png">
        </div>
    </header>

    @php
        $dayOne = [
            [
                'url' => '/piano-in-5-days/lessons/day-1-welcome-to-the-piano',
                'img' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-01-1643338235.jpg',
                'title' => 'Welcome To The Piano'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-1-practice-video-1',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day1-1.jpg',
                'title' => 'Practice Video 1'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-1-practice-video-2',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day1-2.jpg',
                'title' => 'Practice Video 2'
            ],
        ];

        $dayTwo = [
            [
                'url' => '/piano-in-5-days/lessons/day-2-you-can-play-a-melody',
                'img' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-04-1643338334.jpg',
                'title' => 'You Can Play A Melody'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-2-practice-video-1',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day2-1.jpg',
                'title' => 'Practice Video 1'
            ],
        ];

        $dayThree = [
            [
                'url' => '/piano-in-5-days/lessons/day-3-you-can-use-both-hands',
                'img' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-06-1643338374.jpg',
                'title' => 'You Can Use Both Hands'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-3-practice-video-1',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day3-1.jpg',
                'title' => 'Practice Video 1'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-3-practice-video-2',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day3-2.jpg',
                'title' => 'Practice Video 2'
            ],
        ];

        $dayFour = [
            [
                'url' => '/piano-in-5-days/lessons/day-4-reading-music',
                'img' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-09-1643338442.jpg',
                'title' => 'Reading Music'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-4-practice-video-1',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4-1.jpg',
                'title' => 'Practice Video 1'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-4-practice-video-2',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4-2.jpg',
                'title' => 'Practice Video 2'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-4-practice-video-3',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4-3.jpg',
                'title' => 'Practice Video 3'
            ],
        ];

        $dayFive = [
            [
                'url' => '/piano-in-5-days/lessons/day-5-you-can-play-piano',
                'img' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-13-1643338576.jpg',
                'title' => 'You Can Play Piano'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-5-practice-video-1',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5-1.jpg',
                'title' => 'Practice Video 1'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-5-practice-video-2',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5-2.jpg',
                'title' => 'Practice Video 2'
            ],
            [
                'url' => '/piano-in-5-days/lessons/day-5-practice-video-3',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5-3.jpg',
                'title' => 'Practice Video 3'
            ],
        ];

        $benefit = [
            [
                'url' => '/piano-in-5-days/lessons/tips-for-success',
                'img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/benefit.jpg',
                'title' => 'Tips For Success'
            ],
        ];
    @endphp

    <div class="text-white py-10 md:py-20 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container mx-auto">
            <h5 class="text-center leading-normal max-w-xl lg:max-w-2xl">Simply click on the first lesson<br class="inline md:hidden"> below to get started.</h5>
            <div class="mx-auto lg:max-w-6xl px-0 md:px-2 my-8">
                <h4 class="font-bold">Day 1</h4>
                <hr class="mt-2 mb-5" />
                <div class="flex flex-wrap items-start mb-7">
                    @foreach ($dayOne as $day)
                        @include('pianote.lead-gen.piano-in-5-days.pages.lesson-tile', [
                            "url" => $day['url'],
                            "img" => $day['img'],
                            "title" => $day['title'],
                        ])
                    @endforeach
                </div>

                <h4 class="font-bold">Day 2</h4>
                <hr class="mt-2 mb-5" />
                <div class="flex flex-wrap items-start mb-7">
                    @foreach ($dayTwo as $day)
                        @include('pianote.lead-gen.piano-in-5-days.pages.lesson-tile', [
                            "url" => $day['url'],
                            "img" => $day['img'],
                            "title" => $day['title'],
                        ])
                    @endforeach
                </div>

                <h4 class="font-bold">Day 3</h4>
                <hr class="mt-2 mb-5" />
                <div class="flex flex-wrap items-start mb-7">
                    @foreach ($dayThree as $day)
                        @include('pianote.lead-gen.piano-in-5-days.pages.lesson-tile', [
                            "url" => $day['url'],
                            "img" => $day['img'],
                            "title" => $day['title'],
                        ])
                    @endforeach
                </div>

                <h4 class="font-bold">Day 4</h4>
                <hr class="mt-2 mb-5" />
                <div class="flex flex-wrap items-start mb-7">
                    @foreach ($dayFour as $day)
                        @include('pianote.lead-gen.piano-in-5-days.pages.lesson-tile', [
                            "url" => $day['url'],
                            "img" => $day['img'],
                            "title" => $day['title'],
                        ])
                    @endforeach
                </div>

                <h4 class="font-bold">Day 5</h4>
                <hr class="mt-2 mb-5" />
                <div class="flex flex-wrap items-start mb-7">
                    @foreach ($dayFive as $day)
                        @include('pianote.lead-gen.piano-in-5-days.pages.lesson-tile', [
                            "url" => $day['url'],
                            "img" => $day['img'],
                            "title" => $day['title'],
                        ])
                    @endforeach
                </div>

                <h4 class="font-bold">Bonus Lesson</h4>
                <hr class="mt-2 mb-5" />
                <div class="flex flex-wrap items-start">
                    @foreach ($benefit as $day)
                        @include('pianote.lead-gen.piano-in-5-days.pages.lesson-tile', [
                            "url" => $day['url'],
                            "img" => $day['img'],
                            "title" => $day['title'],
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <section class="text-center py-12 md:py-20 lg:py-24 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://pianote.s3.amazonaws.com/shop/header-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="h-10 sm:h-20 lg:h-24 mb-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,q_60,quality=85/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
                <h3><strong>Start your free 7-day trial.</strong></h3>
                <h5 class="leading-normal"><em class="opacity-70">Cancel anytime. 90-Day Money Back Guarantee</em></h5>
                <a class="join my-5 md:my-7" href="/choose-plan">Get Started &raquo;</a>
            </div>
        </div>
    </section>
@endsection
