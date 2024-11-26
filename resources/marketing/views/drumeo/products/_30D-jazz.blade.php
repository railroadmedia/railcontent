    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-jazz/logo.webp"
                        alt="30-Day Double Bass With Ulysses Logo">
                    @php
                        $lines = [
                            'Learn Jazz Drumming',
                            'Improve Your Musicianship ',
                            'Expand Your Vocabulary'
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
                    <h3 class="@if(empty($platformVersion)) pb-6 @endif -mt-3 sm:-mt-1 lg:mt-0">with daily guided workouts.</h3>
                    @if(!empty($platformVersion))
                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever class
{{--                            <br class="inline lg:hidden"> starting October 28th.--}}
                        </strong></h6>
                    @endif
                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative sm:hidden bg-cover bg-top cursor-pointer autoplay-video
                    @if(!empty($platformVersion) && empty($cohort['cohort_trailer'])) hidden @endif
                    "
                        style="padding-bottom: 63%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/header.webp');"
                        @if(empty($platformVersion))
                            x-on:click="trailerM = true;"
                        @else
                            x-on:click="trailer = true;"
                        @endif
                    >
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-drumeo"></i> Play With Real Music
                        <i class="ml-2 fas fa-check text-drumeo"></i> Drum Every Day
                        <i class="ml-2 fas fa-check text-drumeo"></i> Learn By Doing
                    </p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Play With<br>
                            Real Music</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Drum<br> Every
                            Day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Learn<br> By
                            Doing</p>
                    </div>



                    <div class="flex flex-wrap items-left sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full @if(empty($platformVersion)) md:w-1/2 @else sm:w-1/2 @endif text-center sm:pr-2">
{{--                                <a x-on:click="waitlistModal = true;" class="join sold-out medium w-full">JOIN WAITLIST</a>--}}
                                <a href="#final" class="join blue smaller medium w-full anchor-slide">LEARN MORE &raquo;</a>
                                <a href="https://www.musora.com/drumeo/enrollment/30-day-jazz">
                                    <p class="opacity-50 text-xs mt-2 mb-5 sm:mb-0 hover:text-drumeo">
                                        Registration is FREE for Drumeo Members.
                                    </p>
                                </a>
                        </div>
                    @if(!empty($platformVersion))
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                                alt="Image of joined student profiles in 30-Day Double Bass With Ulysses">
                            <p class="inline-block leading-tight text-sm align-middle">Join
                                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
                        </div>
                    @endif
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:inline-block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/header.webp');"
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
{{--                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>--}}
{{--                    <h4 class="px-3 lg:px-5 text-2xl"><strong>October 28th</strong></h4>--}}
{{--                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">--}}
{{--                    <p class="text-sm px-3 lg:px-5">--}}
{{--                        Enrollment closes in <br class="lg:hidden">--}}
{{--                        @if(empty($platformVersion))--}}
{{--                            <span class="text-drumeo" x-data="timer()" x-init="countdown()">--}}
{{--                                <span x-cloak x-show="timeLeft > 0">--}}
{{--                                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                                    <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                                    <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                                </span>--}}
{{--                                <span x-cloak x-show="timeLeft < 0"> A Limited Time! </span>--}}
{{--                            </span>--}}
{{--                        @else--}}
{{--                            <span class="inline text-drumeo" id="countdown" data-countdown-date="2024-10-28 00:00:00">--}}
{{--                                <span id="days" class="hidden"><span id="dayValue"></span> <span id="dayText"></span></span>--}}
{{--                                <span id="hours" class="hidden"><span id="hourValue"></span> <span id="hourText"></span></span>--}}
{{--                                <span id="minutes" class="hidden"><span id="minuteValue"></span> <span id="minuteText"></span></span>--}}
{{--                                <span id="seconds" class="hidden"><span id="secondValue"></span> <span id="secondText"></span></span>--}}
{{--                            </span>--}}
{{--                            <span id="expired" class="hidden">A Limited Time!</span>--}}
{{--                        @endif--}}
{{--                    </p>--}}
                </div>
                <div
                    class="flex flex-wrap md:flex-nowrap items-center justify-evenly w-full md:w-auto md:flex-grow py-4 md:py-3 lg:py-4 text-left md:text-center">
                    @if(empty($platformVersion))
                        <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-start">
                            <i class="far fa-infinity mr-3 md:mr-0 text-drumeo text-2xl"></i>
                            <p class="leading-tight mx-0"><strong class="font-black">Lifetime Access</strong><br>
                                <span class="text-sm"> Yours to play over<br class="hidden md:inline"> and over again.</span>
                            </p>
                        </div>
                    @endif
{{--                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-start">--}}
{{--                        <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-drumeo text-2xl"></i>--}}
{{--                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>--}}
{{--                            <span class="text-sm"> October 28th to<br class="hidden md:inline"> November 27th</span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-start">
                        <i class="far fa-fw mr-3 md:mr-0 fa-clock text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-start">
                        <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play jazz grooves & fills<br class="hidden md:inline">
                                at a gigging level.</span>
                        </p>
                    </div>
                </div>
            </div>
            @if(!empty($platformVersion))
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden">
                    PLUS you get lifetime access!</em></p>
            @endif
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
        <div class="container max-w-4xl mx-auto
        @if(empty($platformVersion)) mb-24 sm:mb-40 lg:mb-36 @endif
        ">
            <h2 class="leading-tight mb-7 sm:mb-12"><strong>Immerse yourself in jazz <br> drumming for 30 days.</strong></h2>
            @php
            if (empty($platformVersion)) {
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/know-exactly.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Jazz drumming engages your brain in different ways. 30-Day Jazz helps you build these pathways by following a simple daily practice schedule. By the end of the month, you’ll be comfortable playing syncopated jazz grooves.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Jazz fits any schedule. You only need 10 minutes per day to improve your jazz independence and musicianship.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/real-music.webp',
                        'title' => 'Play with real music.',
                        'desc' =>
                            'No more painfully dry exercises set to MIDI playalongs. In 30-Day Jazz, you’re playing along with a world class jazz combo. They’ve crafted a custom playalong for you to apply your skills and expand your ears over 30 days.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/lifetime.webp',
                        'title' => 'Lifetime access.',
                        'desc' =>
                            'You can access ALL playalongs, charts, and lessons from 30-Day Jazz for life. That means you can return to your favorite jazz exercises and songs over and over – plus, it means you can work at your own pace.',
                    ],
                ];
            }
            else {
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/know-exactly.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Jazz drumming engages your brain in different ways. 30-Day Jazz helps you build these pathways by following a simple daily practice schedule. By the end of the month, you’ll be comfortable playing syncopated jazz grooves.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Jazz fits any schedule. You only need 10 minutes a day to improve your jazz independence and musicianship.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/q-a.webp',
                        'title' => 'Live support from REAL teachers.',
                        'desc' =>
                            'Each week you’ll have a 60-minute live lesson with Ulysses Owens Jr. Ask questions, get feedback, and connect with other students – you’re learning with students from around the world. Grab a cup of coffee and hang with your drum teacher? Yes please. ',
                    ],
                ];

            }
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
        <h1 class="leading-none sm:-mt-6 lg:-mt-7 hidden md:inline-block"><i class="fal fa-angle-down text-drumeo"></i></h1>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #EFF7FF">
        <div class="container max-w-4xl mx-auto">
            @if(empty($platformVersion))
                <div class="hidden sm:inline-block aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative -mt-32 sm:-mt-64 mb-6 lg:mb-10"
                        x-on:click="trailer = true;"
                >
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                    <img class="rounded-xl overflow-hidden object-cover inset-0 absolute z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/thumb.jpg">
    {{--                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"--}}
    {{--                    x-ref="playToLearnVideo"--}}
    {{--                    x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"--}}
    {{--                    x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"--}}
    {{--                    data-src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/video-reel2.mp4" type="video/mp4" autoplay muted loop playsinline></video>--}}
                </div>
                <div class="sm:hidden inline-block aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative -mt-32 sm:-mt-64 mb-6 lg:mb-10"
                        x-on:click="trailerM = true;">
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                    <img class="rounded-xl overflow-hidden object-cover inset-0 absolute z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/thumb.jpg">
                </div>
            @endif
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-24 sm:h-28 lg:h-36 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-jazz/logo.webp"
                    alt="30-Day Double Bass With Ulysses Logo"
                >
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-drumeo mr-5"></i> Daily guided drum workouts<br>
                    @if(!empty($platformVersion))
                    <i class="fas fa-check text-drumeo mr-5"></i> Weekly LIVE Q&A workshops<br>
                    @endif
                    <i class="fas fa-check text-drumeo mr-5"></i> Flexible weekly schedule<br>
                    @if(empty($platformVersion))
                        <i class="fas fa-check text-drumeo mr-5"></i> Ongoing motivation & support<br>
                        <i class="fas fa-check text-drumeo mr-5"></i> Guaranteed results
                    @endif
                </h4>
            </div>

{{--            @if(!empty($hasProduct) && $hasProduct == 'true')--}}
{{--                <a class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">YOU'RE ENROLLED!</a><br>--}}
{{--            @else--}}
{{--                <a href="#final" class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">LEARN MORE &raquo;</a><br>--}}
{{--            @endif--}}

            @if(!empty($platformVersion))
            <img class="h-7 mr-1 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                alt="Image of joined student profiles in 30-Day Double Bass With Ulysses">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join
                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
            @endif
        </div>
    </section>
    @if(!empty($platformVersion))
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-12 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/screen.webp"
                    alt="Mobile Screen with 30-Day Double Bass With Ulysses">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get LIVE support<br> every step of the
                            way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your
                        lessons, you can ask your instructor at each week’s LIVE Q&A event. Ulysses will be there to
                        help you through any sticking points and keep you motivated to complete the full course.</h6>
{{--                    <div class="text-center sm:text-left">--}}
{{--                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>JOIN Ulysses LIVE: <i--}}
{{--                                    class="fas fa-arrow-down text-drumeo mx-2 inline lg:hidden"></i> <i--}}
{{--                                    class="fas fa-arrow-right text-drumeo mx-2 hidden lg:inline"></i></strong></h6><br--}}
{{--                            class="inline lg:hidden">--}}

{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>NOV</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">2</strong></p>--}}
{{--                        </div>--}}
{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>NOV</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">9</strong></p>--}}
{{--                        </div>--}}
{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>NOV</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">16</strong></p>--}}
{{--                        </div>--}}
{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>NOV</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">23</strong></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img
                    class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/logo.webp"
                    alt="30-Day Double Bass With Ulysses Logo"> <strong> is designed for:</strong></h2>

            @php
                $drummers = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/beginner.webp',
                        'title' => 'Beginner Drummers',
                        'description' =>
                            '30-Day Jazz starts with simple swing patterns on the ride cymbal. If you’re a motivated beginner, you can follow the daily practice regime to learn dozens of jazz patterns by the end of the month.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/drumeo/products/30-day-jazz/intermediate.webp',
                        'title' => 'Intermediate Drummers',
                        'description' =>
                            'So you can play The Beatles and Nirvana but really want to expand your vocabulary on the drums. 30-Day Jazz introduces you to the world of jazz drumming in a fully immersive experience.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/advanced.webp',
                        'title' => 'Advanced Drummers',
                        'description' =>
                            'If you’re highly experienced in one style of drumming, 30-Day Jazz will introduce you to a new world. By the end of the month, you’ll be prepared to play with a live jazz band.',
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

            @if(empty($platformVersion))
            <h2 class="mt-10 lg:mt-24 mb-3"><strong>Playing makes perfect.</strong></h2>
            <h6 class="leading-normal mb-14 md:mb-11">For less than the cost of monthly private lessons<br
                    class="hidden sm:inline"> you’ll get a 30-day program to transform your drumming.</h6>

            <div class="relative" x-data="{
        tableClass: 'private',
        getClass() {
            return {
                'private': this.tableClass === 'private',
                'books': this.tableClass === 'books',
                'online': this.tableClass === 'online'
            };
        }
    }"
                >
                <p
                    class="inline sm:hidden leading-none text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower pt-2">
                    <strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>

                <table :class="getClass()"
                    class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/logo-white.webp"
                                alt="30 day drummer logo"></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tl-xl" @click="tableClass = 'online'"><strong>Private<br> Lessons</strong></td>
                        <td class="cursor-pointer sm:cursor-default" @click="tableClass = 'books'"><strong>Online<br> Courses</strong></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tr-xl" @click="tableClass = 'private'"><strong>Drum<br> Books</strong></td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>24 Play-along Workouts</td>
                        <td>In-Person</td>
                        <td>Self-Directed</td>
                        <td>Self-Directed</td>
                    </tr>
                    @if(!empty($platformVersion))
                    <tr>
                        <td>Live</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td>Sometimes</td>
                        <td>No</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Length</td>
                        <td>30 Days</td>
                        <td>Open Ended</td>
                        <td>Open Ended</td>
                        <td>Open Ended</td>
                    </tr>
                    <tr>
                        <td>Access</td>
                        <td>Lifetime</td>
                        <td>One-Time</td>
                        <td>Varies</td>
                        <td>Lifetime</td>
                    </tr>
                    <tr>
                        <td>Guarantee</td>
                        <td>90 days</td>
                        <td>No</td>
                        <td>Varies</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Investment</td>
                        <td class="rounded-b-xl">
                            <strong>$97</strong><br>
                            <span class="text-xs">Single Payment</span></td>
                        <td class="rounded-bl-xl"><strong>$30-$100</strong><br> <span class="text-xs">Per
                                    Lesson</span></td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/coach-image.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/coach-image.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                        alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Ulysses Owens Jr. </strong></h2>
                    <h6 class="leading-normal my-4 lg:my-6">Ulysses Owens Jr. is a GRAMMY-winning jazz drummer, producer, and educator known for his innovative performances and contributions to jazz.
                        <br><br>
                        He has released eight albums, including "A New Beat," which topped jazz charts in 2024. Owens has authored several books on jazz drumming, developed music products, and created online educational courses.
                        <br><br>
                        He’s an educator at the Juilliard School and he’s here to help you get started playing jazz on the drums.
                    </h6>
                    <div class="flex items-center">
                        <h3 class="ml-0 mr-3"><i class="fad fa-fw fa-graduation-cap text-drumeo"></i></h3>
                        <h6 class="leading-tight mx-0">
                            Small Ensemble Director <strong>@ The Juilliard School</strong>
                        </h6>
                    </div>
                    <div class="flex items-center my-4 sm:my-2">
                        <h3 class="ml-0 mr-3"><i class="fa-brands fa-fw text-drumeo fa-youtube"></i></h3>
                        <h6 class="leading-tight mx-0">
                            <strong>+6M views</strong> on viral jazz videos
                        </h6>
                    </div>
                    <div class="flex items-center">
                        <h3 class="ml-0 mr-3"><i class="fad fa-fw fa-book text-drumeo"></i></h3>
                        <h6 class="leading-tight mx-0">
                            <strong>2x</strong> Published Author
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(empty($platformVersion))
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-5xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 inline-block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 mb-6 sm:mb-8 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png"
                alt="guarantee badge">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="h-48 sm:h-64 lg:h-96 sm:order-1 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/810x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/guarantee-students.webp">
                <div class="mt-4 sm:mt-0 sm:pr-8 sm:text-left">
                    <h3 class="leading-tight mb-4 sm:mb-6"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                            guaranteed.</strong></h3>

                    <p class="leading-normal">30-Day Jazz is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to expand your vocabulary on the drums.
                        <br><br>
                        We think it’ll be your favorite drum course ever –
                        <br><br>
                        So even though it’s only a month, you’ll get three full months to go through everything and make sure it was right for you. If not, just contact our friendly support team for a full refund.
                    </p>
                </div>

            </div>
        </div>
    </section>
    @endif
    <div id="final" class="anchor"></div>

    @if(empty($platformVersion))
        <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
            style="background-color:#eff7ff;">
            <div class="container mx-auto max-w-4xl relative z-50 text-center">
                <img class="h-20 sm:h-28 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/logo.webp"
                    alt="30 day Double Bass With 66Samus logo">
                <h3 class="leading-tight mt-2 sm:mt-4"><strong>Learn jazz drumming in an<br class="sm:hidden"> immersive 30-day experience.</strong></h3>
                <p class="leading-normal my-3 my-4">
                    <i class="fas fa-check text-drumeo ml-3"></i> 20 Guided Workouts<br class="sm:hidden">
                    @if(!empty($platformVersion))
                    <i class="fas fa-check text-drumeo ml-3"></i> 4 Live Q&A Sessions<br class="lg:hidden">
                    @endif
                    @if(empty($platformVersion))
                    <i class="fas fa-check text-drumeo ml-3"></i> 90-Day Money Back Guarantee<br class="sm:hidden">
                    @endif
                    <i class="fas fa-check text-drumeo ml-3"></i> Lifetime Course Access
                </p>
{{--                <a x-on:click="waitlistModal = true;" class="join sold-out medium">JOIN WAITLIST</a>--}}
{{--                <h6 class="leading-normal mb-4 text-drumeo uppercase">--}}
{{--                    @if(empty($platformVersion))--}}
{{--                    <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                        Enrollment closes in--}}
{{--                        <strong>--}}
{{--                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>!--}}
{{--                            <span x-cloak x-show="timeLeft < 0">A Limited Time!</span>--}}
{{--                        </strong>--}}
{{--                    </span>--}}
{{--                    @endif--}}
{{--                </h6>--}}

                    <div class="flex flex-wrap items-start justify-center mx-auto mt-6 sm:mt-10 max-w-3xl">
                        @include('drumeo.products.partials._order-card', [
                            'badge' => 'Launch Special',
                            'header' => '30-Day Jazz',
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/course-only.webp',
                            'imageHeight' => 'h-32 md:h-40 lg:h-44',
                            'fullPrice' => "$".floatval($productPrices['30-day-jazz']->price),
                            'price' => "$".floatval($productPrices['30-day-jazz']->discounted_price),
                            'specialText' => "One time payment.",
                            'cta' => 'GET STARTED',
                            'link' => '/ecommerce/add-to-cart?products[30-day-jazz]=1',
                        ])
{{--                        @include('drumeo.products.partials._order-card', [--}}
{{--                            'highlightBorder' => true,--}}
{{--                            'badge' => 'FREE STICKBAG',--}}
{{--                            'header' => 'Unlimited Lessons',--}}
{{--                            'subheader' => '1 Year Of Drumeo +<br class="sm:hidden"> 5 Bonuses Worth $655',--}}
{{--                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-jazz/unlimited-lessons.webp',--}}
{{--                            'imageHeight' => 'h-32 md:h-40 lg:h-44',--}}
{{--                            'price' => '$20/mo',--}}
{{--                            'specialText' => "Billed annually at $240/yr.",--}}
{{--                            'cta' => 'GET EVERYTHING',--}}
{{--                            'link' => '/ecommerce/add-to-cart?products[30-day-jazz]=1&products[stickbag]=1&products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-double-bass]=1&products[30-day-independence]=1&locked=true',--}}
{{--                            'bonuses' => [--}}
{{--                                '<strong>Drumeo Annual Membership</strong>',--}}
{{--                                '<strong class="text-drumeo">FREE</strong> 30-Day Jazz',--}}
{{--                                '<strong class="text-drumeo">FREE</strong> Drumeo StickBag',--}}
{{--                                '<strong class="text-drumeo">FREE</strong> 30-Day Chops',--}}
{{--                                '<strong class="text-drumeo">FREE</strong> 30-Day Double Bass',--}}
{{--                                '<strong class="text-drumeo">FREE</strong> 30-Day Independence',--}}
{{--                            ],--}}
{{--                        ])--}}
                    </div>

{{--                <a role="link" class="inline-block mt-4" aria-label="Start a monthly membership" href="/ecommerce/add-to-cart?products[30-day-jazz]=1&products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-double-bass]=1&products[30-day-independence]=1&locked=true">--}}
{{--                <p><u><em><strong>Don't want to pay shipping?</strong> <br class="hidden sm:inline"> Click here to join Drumeo and get 30-Day Jazz with no physical bonuses.</em></u></p></a>--}}
            </div>
        </section>
        {{-- <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
            <p class="max-w-3xl px-4 md:px-2 leading-loose">
                <i class="fas fa-info-circle text-drumeo" aria-hidden="true"></i> <b>Shipping Disclaimer –</b> Your physical bonuses may not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is up to the shipping gods.
            </p>
        </section> --}}

        <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
            <div class="container mx-auto relative z-10 max-w-5xl">
                <h2><strong>Still have questions?</strong></h2>
                <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @if(!empty($platformVersion))
                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "Do I need to attend the lessons live?",
                    "desc" => "The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are optional. Plus, you’ll be sent a recording so you can watch anytime.",
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "What if I’m going to miss a day (or two, or more)?",
                    "desc" => "That’s totally fine. The course is meant to be flexible – there are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session to catch up.",
                    ])
                @endif
                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "How much time per week will this course require?",
                    "desc" => "30-Day Jazz gives you guided daily jazz workouts for thirty days. The minimum time required adds up to 60 minutes per week – but you can spend 2+ hours or more including the live session if you’re feeling motivated.",
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "Does it work on acoustic AND electronic drums?",
                    "desc" => "Yes. 30-Day Jazz is built for the beginner-to-advanced drummer looking to become more versatile on the drums. You can complete all of Ulysses’ exercises on either acoustic or electronic and see the full effects on your playing.",
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "What devices can I access the course on?",
                    "desc" => "30-Day Jazz is available on your laptop, tablet, or phone. You’ll also have access through the Musora app after you’ve completed your purchase online.",
                    ])
                </div>
                <div class="inline-block w-full px-3 md:px-4 my-5" style="color:#2a2f34;">
                    <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                        <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                        <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
                </div>
                <div class="inline-block w-full px-3 md:px-4 mb-10" style="color:#2a2f34;">
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
                </div>
            </div>
        </section>
@endif

@component('_partials.components.modal', ['name' => 'waitlistModal'])
@slot('content')
<div class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
    <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
    <p class="mb-4">Enter your email below to get notified<br class="hidden sm:inline"> when the next challenge is announced. </p>
    @include("drumeo.lead-gen.partials.sign-up-form", [
            "recaptchaKey" => $recaptchaKey,
        "formName" => '30 Day Drummer Waitlist',
        "formId" => "Drumeo - Engagement - Trigger - 30 Day Drummer Waitlist - Web Form",
        "buttonText" => "Let Me Know ",
        "stacked" => true,
        "noSocial" => true,
    ])
</div>
@endslot
@endcomponent

@if(empty($platformVersion))
        @include('_partials.components.video-modal', [
            'name' => 'trailerM',
            'video' => '1018759528',
            'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
        ])
@include('_partials.components.video-modal', [
'name' => 'trailer',
'video' => '1025148415',
'vimeo' => true,
])
@else
    @if(!empty($cohort['cohort_trailer']))
        @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => $cohort['cohort_trailer'],
        'styles' => 'aspect-16:9',
        ])
    @endif
@endif
