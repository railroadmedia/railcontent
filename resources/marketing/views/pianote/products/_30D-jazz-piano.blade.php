<header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
            <div class="w-full sm:w-7/12 text-center lg:text-left">
                <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                    alt="30-Day Double Bass With Ulysses Logo">
                @php
                    $lines = [
                        'Learn Jazz Essentials',
                        'Sound Like a Jazz Pianist',
                        'Make Music That Swings'
                        ];
                @endphp

                <h2 class="rotater-text overflow-hidden">
                    <strong>
                        @foreach (range(1, 5) as $i)
                            @foreach ($lines as $line)
                                <span
                                    class="relative nowrap delay-1000 ease-in-out">{{ $line }}</span><br>
                            @endforeach
                        @endforeach
                    </strong>
                </h2>
                <h3 class="-mt-3 sm:-mt-1 lg:mt-0">in just 10 minutes a day.</h3>

                <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat now.</strong></h6>

                <div class="mt-6 mb-5 rounded-xl overflow-hidden relative sm:hidden bg-cover bg-top cursor-pointer autoplay-video
                    @if(!empty($platformVersion) && empty($cohort['cohort_trailer'])) hidden @endif
                    "
                    style="padding-bottom: 63%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/header.webp');"
                    x-on:click="trailer = true;"
                >
                    <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                </div>

                <p class="hidden lg:inline">
                    <i class="fas fa-check text-pianote"></i> Improve your musicianship
                    <i class="ml-2 fas fa-check text-pianote"></i> Learn by doing
                    <i class="ml-2 fas fa-check text-pianote"></i> Practice every day
                </p>
                <div class="flex inline lg:hidden">
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Improve your <br>
                        musicianship</p>
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Learn by <br> doing</p>
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Practice <br> every day</p>
                </div>

                <div class="flex flex-wrap items-left sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                    <div class="w-full sm:w-1/2 text-center sm:pr-2">
                        @if(!empty($hasProduct) && $hasProduct == 'true')
                            <a class="join sold-out medium w-full anchor-slide">YOU'RE ENROLLED!</a>
                        @else
                            {{--                                <a x-on:click="waitlistModal = true;" class="join sold-out medium w-full">JOIN WAITLIST</a>--}}
                            <a href="#final" class="join pianote medium w-full anchor-slide">ENROLL NOW</a>
                            <a href="https://www.musora.com/pianote/enrollment/30-day-double-bass">
                                <p class="opacity-50 text-xs mt-2 mb-5 sm:mb-0 hover:text-pianote">
                                    Registration is FREE for Pianote Members.
                                </p>
                            </a>
                        @endif
                    </div>
                    <div class="w-full sm:w-1/2 lg:pb-5">
                        <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                            loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/review.webp"
                            alt="Image of joined student profiles in 30-Day Double Bass With Ulysses">
                        <p class="inline-block leading-tight text-sm align-middle">Join
                            {{ number_format($nPackOwners ?? 0) }} pianists who<br> have already registered.</p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-5/12 hidden sm:inline-block">
                <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                    style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/header.webp');"
                    x-on:click="trailer = true;"
                >
                    <div class="join white smaller absolute  bottom-1  bottom-2 left-1
                        @if(!empty($platformVersion) && empty($cohort['cohort_trailer'])) hidden @endif
                        "><i class="fas fa-play"></i> Watch Trailer</div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-wrap md:flex-nowrap text-center border rounded-lg border-gray-300 mt-6 lg:mt-8 mb-2 lg:mb-4">
            <div class="w-full md:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 md:py-3 lg:py-4">
                <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                <h4 class="px-3 lg:px-5 text-2xl"><strong>November 4th</strong></h4>
                <hr class="border-gray-300 my-4 md:my-2 lg:my-4">
                <p class="text-sm px-3 lg:px-5">
                    Enrollment closes in <br class="lg:hidden">
                        <span class="inline text-pianote" id="countdown" data-countdown-date="2024-09-02 00:00:00">
                                <span id="days" class="hidden"><span id="dayValue"></span> <span id="dayText"></span></span>
                                <span id="hours" class="hidden"><span id="hourValue"></span> <span id="hourText"></span></span>
                                <span id="minutes" class="hidden"><span id="minuteValue"></span> <span id="minuteText"></span></span>
                                <span id="seconds" class="hidden"><span id="secondValue"></span> <span id="secondText"></span></span>
                            </span>
                        <span id="expired" class="hidden">A Limited Time!</span>
                </p>
            </div>
            <div
                class="flex flex-wrap md:flex-nowrap items-center justify-evenly w-full md:w-auto md:flex-grow py-4 md:py-3 lg:py-4 text-left md:text-center">
                <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-start">
                    <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                    <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                        <span class="text-sm"> November 4th to<br class="hidden md:inline"> December 3rd</span>
                    </p>
                </div>
                <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-start">
                    <i class="far fa-fw mr-3 md:mr-0 fa-clock text-pianote text-2xl"></i>
                    <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                        <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span>
                    </p>
                </div>
                <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-start">
                    <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-pianote text-2xl"></i>
                    <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                        <span class="text-sm">Play an original <br class="hidden md:inline"> jazz standard.</span>
                    </p>
                </div>
            </div>
        </div>
        <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden">
                PLUS you get lifetime access!</em></p>
    </div>
</header>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
    <div class="container max-w-4xl mx-auto">
        <h2 class="leading-tight mb-7 sm:mb-12"><strong>Discover the beautiful, exciting <br> world of jazz piano.</strong></h2>
        @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/know-exactly.webp',
                        'title' => 'Know what to learn, and when. ',
                        'desc' =>
                            'Jazz, like life, is all about the journey. 30-Day Jazz Piano shows you the exact steps and skills to work on – in the perfect order for jazz beginners. All you have to do is play along!',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Can you really learn jazz piano in just 10 minutes a day? Yes, you can! 30-Day Jazz Piano is perfect for any schedule. And you’ll be playing REAL jazz right from Day 1.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/play.webp',
                        'title' => 'Build your skills.',
                        'desc' =>
                            'Over 30 days, you’ll start off with jazz basics. Next, you’ll move on to comping and the walking bass line. Finally, you’ll put all your techniques together to play an original jazz standard written by Kevin Castro!',
                    ],
                ];
        @endphp
        <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 pt-7">
            @foreach ($gettings as $key => $getting)
                @if ($getting['position'] === 'right')
                    <div
                        class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                        <div class="content relative text-left sm:pl-10 md:pl-0">
                            <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                            <p>{{ $getting['desc'] }}</p>
                        </div>
                        <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                            onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                            alt="{{ $getting['title'] }}" />
                    </div>
                @else
                    <div
                        class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if(!$loop->last) mb-16 md:mb-20 @else md:mb-0 @endif">
                        @if (empty($getting['special']))
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        @else
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                style="background-image:url('{{ $getting['img'] }}')"></div>
                        @endif
                        <div class="content relative text-left sm:pl-10 md:pl-0 md:mb-10">
                            <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                            <p>{{ $getting['desc'] }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <h1 class="leading-none sm:-mt-6 lg:-mt-7 hidden md:inline-block"><i class="fal fa-angle-down text-pianote"></i></h1>
</section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #EFF7FF">
    <div class="container max-w-4xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
            <img class="h-24 sm:h-28 lg:h-36 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                alt="30-Day Double Bass With Ulysses Logo">
            <h4 class="leading-loose text-left">
                <i class="fas fa-check text-pianote mr-5"></i> Daily guided workouts<br>
                <i class="fas fa-check text-pianote mr-5"></i> Flexible schedule<br>
                <i class="fas fa-check text-pianote mr-5"></i> FREE for Musora members
            </h4>
        </div>

        @if(!empty($hasProduct) && $hasProduct == 'true')
            <a class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">YOU'RE ENROLLED!</a><br>
        @else
            <a href="#final" class="join pianote medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>
        @endif
        <img class="h-7 mr-1 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/review.webp"
            alt="Image of joined student profiles in 30-Day Double Bass With Ulysses">
        <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join
            {{ number_format($nPackOwners ?? 0) }} pianists who<br> have already registered.</p>
    </div>
</section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-6xl mx-auto">
        <h2 class="mb-6 sm:mb-10 lg:mb-14"><img
                class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                alt="30-Day Double Bass With Ulysses Logo"> <strong> is designed for:</strong></h2>

        @php
            $drummers = [
                [
                    'image' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/pianote/products/30-day-jazz-piano/intermediate.webp',
                    'title' => 'Intermediate Piano Players.',
                    'description' =>
                        'If you’re already comfortable on the keyboard and want to start exploring the world of jazz, this challenge is for you! In just 30 days, you’ll learn techniques that’ll help you sound like a jazz pianist.',
                ],
                [
                    'image' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/beginner.webp',
                    'title' => 'Beginner Piano Players ',
                    'description' =>
                        'Just starting out on the piano? You can still swing! Some of the workouts in 30-Day Jazz Piano might feel a bit challenging, but Kevin shows you how to simplify them with a few modifications.',
                ],
                [
                    'image' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/advanced.webp',
                    'title' => 'Advanced Piano Players ',
                    'description' =>
                        'You’ve got a bunch of classical pieces under your fingers. But you’re looking for something a little more… cool. In just 10 minutes a day, 30-Day Jazz Piano will help you play jazz with confidence.',
                ],
            ];
        @endphp

        <div class="flex flex-col sm:flex-row text-left justify-center">
            @foreach ($drummers as $drummer)
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                        style="background-image:url('{{ $drummer['image'] }}'); object-position: 60% 0">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img
                                    class="h-8 transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg"
                                    alt="plus icon"><br>{{ $drummer['title'] }}</strong></h6>
                        <div class="absolute inset-0 z-0"
                            style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">{{ $drummer['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
    <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
            <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/coach-image.png">
                <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/coach-image.png"
                    loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                    style="width: 130%;transform: translate(-44%, -7%);"
                    src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                    alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>

            <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                style="background-color:#00101d;">
                <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                <h2 class="text-center sm:text-left"><strong>Kevin Castro</strong></h2>
                <h6 class="leading-normal my-4 lg:my-6">Kevin Castro holds a degree in Jazz and Contemporary Popular Music from the prestigious MacEwan University.
                    <br><br>
                    He’s also toured with rising stars and JUNO-Award winners (JESSIA, Elijah Woods), played at TikTok Headquarters in New York and LA, and even recorded a demo for Jennifer Lopez.
                    <br><br>
                    But Kevin’s real passion comes from sharing his experience and knowledge with students.
                    <br><br>
                    And he’ll be with you at every stage of your jazz journey.
                </h6>
                <div class="flex items-center">
                    <h3 class="ml-0 mr-3"><i class="fad fa-fw fa-graduation-cap text-pianote"></i></h3>
                    <h6 class="leading-tight mx-0">
                        Small Ensemble Director <strong>@ The Juilliard School</strong>
                    </h6>
                </div>
                <div class="flex items-center my-4 sm:my-2">
                    <h3 class="ml-0 mr-3"><i class="fa-brands fa-fw text-pianote fa-youtube"></i></h3>
                    <h6 class="leading-tight mx-0">
                        <strong>+6M views</strong> on viral jazz videos
                    </h6>
                </div>
                <div class="flex items-center">
                    <h3 class="ml-0 mr-3"><i class="fad fa-fw fa-book text-pianote"></i></h3>
                    <h6 class="leading-tight mx-0">
                        <strong>2x</strong> Published Author
                    </h6>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="final" class="anchor"></div>

@component('_partials.components.modal', ['name' => 'waitlistModal'])
    @slot('content')
        <div class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
            <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
            <p class="mb-4">Enter your email below to get notified<br class="hidden sm:inline"> when the next challenge is announced. </p>
            @include("pianote.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                    'formName' => 'Read Music in 30 Days Waitlist',
                    'formId' => 'Pianote - Engagement - Trigger - Read Music in 30 Days Waitlist - Web Form',
                "buttonText" => "Let Me Know ",
                "stacked" => true,
                "noSocial" => true,
            ])
        </div>
    @endslot
@endcomponent

    @if(!empty($cohort['cohort_trailer']))
        @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => $cohort['cohort_trailer'],
        'styles' => 'aspect-16:9',
        ])
    @endif
