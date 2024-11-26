    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-double-bass/30DDB-logo-dark.webp"
                        alt="30-Day Double Bass With 66Samus Logo">
                    @php
                        $lines = [
                            'Learn Double Kick',
                            'Improve Your Technique',
                            'Play Heavy Breakdowns'
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

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2 @if(empty($platformVersion)) hidden @endif"><strong>Save your seat in the first-ever class
{{--                            <br class="inline lg:hidden">starting September 2nd.--}}
                        </strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative sm:hidden bg-cover bg-top cursor-pointer autoplay-video"
                        style="padding-bottom: 63%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/header.webp');"
{{--                        @if(empty($platformVersion))--}}
{{--                            x-on:click="trailerM = true;"--}}
{{--                        @else--}}
                            x-on:click="trailer = true;"
{{--                        @endif--}}
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
                            @if(!empty($hasProduct) && $hasProduct == 'true')
                                <a class="join sold-out medium w-full anchor-slide">YOU'RE ENROLLED!</a>
                            @else
{{--                                <a x-on:click="waitlistModal = true;" class="join sold-out medium w-full">JOIN WAITLIST</a>--}}
                                <a href="#final" class="join drumeo medium w-full anchor-slide">ENROLL NOW</a>
{{--                                <a href="https://www.musora.com/drumeo/enrollment/30-day-double-bass">--}}
{{--                                    <p class="opacity-50 text-xs mt-2 mb-5 sm:mb-0 hover:text-drumeo">--}}
{{--                                        Registration is FREE for Drumeo Members.--}}
{{--                                    </p>--}}
{{--                                </a>--}}
                            @endif
                        </div>
{{--                        <div class="w-full sm:w-1/2 lg:pb-5">--}}
{{--                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"--}}
{{--                                loading="lazy" onload="this.classList.remove('opacity-0')"--}}
{{--                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"--}}
{{--                                alt="Image of joined student profiles in 30-Day Double Bass With 66Samus">--}}
{{--                            <p class="inline-block leading-tight text-sm align-middle">Join--}}
{{--                                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:inline-block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/header.webp');"
                            x-on:click="trailer = true;"
                    >
                        <div class="join white smaller absolute  bottom-1  bottom-2 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div
                class="flex flex-wrap md:flex-nowrap text-center border rounded-lg border-gray-300 mt-6 lg:mt-8 mb-2 lg:mb-4">
                <div class="w-full md:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 md:py-3 lg:py-4">
{{--                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>--}}
{{--                    <h4 class="px-3 lg:px-5 text-2xl"><strong>September 2nd</strong></h4>--}}
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
{{--                            <span class="inline text-drumeo" id="countdown" data-countdown-date="2024-09-02 00:00:00">--}}
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
{{--                            <span class="text-sm"> September 2nd to<br class="hidden md:inline"> September 30th</span>--}}
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
                            <span class="text-sm">Play beginner double <br class="hidden md:inline"> bass beats & fills.</span>
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
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight mb-7 sm:mb-12"><strong>Unlock your foot speed &<br> control on the drums.</strong></h2>
            @php
            if (empty($platformVersion)) {
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/know-exactly.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Double Bass pushes you both physically and mentally – it’s easy to get frustrated and give up. That’s why 30-Day Double Bass starts slow and builds your muscles and coordination over 30 days with daily practice. ',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Double Bass fits any schedule. You only need 10 minutes per day to build your endurance and coordination.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/play.webp',
                        'title' => 'Play with real music.',
                        'desc' =>
                            'No more painfully dry exercises set to MIDI playalongs. 30-Day Double Bass includes custom-made music by acclaimed drum composer, Kaz Rodriguez. He’s crafted the perfect song to develop smooth, even feet on the drums.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/lifetime-access.webp',
                        'title' => 'Lifetime access.',
                        'desc' =>
                            'You can access ALL playalongs, charts, and lessons from 30-Day Double Bass for life. That means you can return to your favorite double kick workouts over and over – plus, it means you can work at your own pace.',
                    ],
                ];
            }
            else {
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/know-exactly.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Double Bass pushes you both physically and mentally – it’s easy to get frustrated and give up. That’s why 30-Day Double Bass starts slow and builds your muscles and coordination over 30 days with daily practice. ',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Double Bass fits any schedule. You only need 10 minutes per day to build your endurance and coordination.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/live-support.webp',
                        'title' => 'Live support from REAL teachers.',
                        'desc' =>
                            'Each week you’ll have a 60-minute live lesson with 66Samus. Ask questions, get feedback, and connect with other students – you’re learning with students from around the world. Grab a cup of coffee and hang with your drum teacher? Yes please. ',
                    ],
                ];

            }
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 pt-7">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if(!$loop->last) mb-16 md:mb-20 @else md:mb-0 @endif">
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
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-24 sm:h-28 lg:h-36 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-double-bass/30DDB-logo-dark.webp"
                    alt="30-Day Double Bass With 66Samus Logo">
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
{{--                <a href="#final" class="join drumeo medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>--}}
{{--            @endif--}}
{{--            <img class="h-7 mr-1 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"--}}
{{--                onload="this.classList.remove('opacity-0')"--}}
{{--                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"--}}
{{--                alt="Image of joined student profiles in 30-Day Double Bass With 66Samus">--}}
{{--            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join--}}
{{--                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>--}}
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
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/screen.webp"
                    alt="Mobile Screen with 30-Day Double Bass With 66Samus">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get LIVE support<br> every step of the
                            way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your
                        lessons, you can ask your instructor at each week’s LIVE Q&A event. 66Samus will be there to
                        help you through any sticking points and keep you motivated to complete the full course.</h6>
{{--                    <div class="text-center sm:text-left">--}}
{{--                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>JOIN 66Samus LIVE: <i--}}
{{--                                    class="fas fa-arrow-down text-drumeo mx-2 inline lg:hidden"></i> <i--}}
{{--                                    class="fas fa-arrow-right text-drumeo mx-2 hidden lg:inline"></i></strong></h6><br--}}
{{--                            class="inline lg:hidden">--}}

{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>SEPT</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">8</strong></p>--}}
{{--                        </div>--}}
{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>SEPT</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">15</strong></p>--}}
{{--                        </div>--}}
{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>SEPT</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">22</strong></p>--}}
{{--                        </div>--}}
{{--                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">--}}
{{--                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">--}}
{{--                                <strong>SEPT</strong></p>--}}
{{--                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">29</strong></p>--}}
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
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/30DDB-logo-dark.webp"
                    alt="30-Day Double Bass With 66Samus Logo"> <strong> is designed for:</strong></h2>

            @php
                $drummers = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/beginner.webp',
                        'title' => 'Beginner Double Pedal Players.',
                        'description' =>
                            'Always wanted to play rock and metal songs? 30-Day Double Bass will help you learn the basic coordination and stamina you need to play 8th and 16th note kick patterns to REAL music.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/drumeo/products/30-day-double-bass/intermediate.webp',
                        'title' => 'Intermediate Drummers.',
                        'description' =>
                            'So you can play The Beatles and Nirvana but really want to explore the world of Van Halen, Mötley Crüe and Metallica. 30-Day Double Bass starts you down the path of rock & metal on the drums. ',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/advanced.webp',
                        'title' => 'Advanced Drummers',
                        'description' =>
                            ' If you’re solid on a single pedal but looking for a new challenge, 30-Day Double Bass will open up a new world of music to you. By the end, you’ll be playing new grooves & fills on your feet with control and musicality.',
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
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/30DDB-logo-white.webp"
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
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/coach-image.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/coach-image.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                        alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Samus Paulicelli<br> (aka 66Samus)</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">66Samus is the hero the metal community deserves.
                        <br><br>
                        His world-class double bass work and infectious sense of humor have inspired millions of drummers and garnered +200 million views on his YouTube Channel. And more than entertainment, Samus is a renowned educator.
                        <br><br>
                        His beginner double bass videos have become go-to resources for drummers of all levels looking to learn drumming’s most coveted skill.
                        <br><br>
                        You’re in good <s class="opacity-70">feet</s> hands with 66Samus.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
                                alt="tiktok icon">
                            <h3 class="mt-2"><strong>463K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg"
                                alt="insta icon">
                            <h3 class="mt-2"><strong>368K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>218M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(empty($platformVersion))
{{--    <section class="text-center text-white px-5 sm:px-4 lg:px-6 py-12 sm:py-16 lg:py-20" style="background: linear-gradient(180deg, #0B76DB 0%, #063F75 100%);">--}}
{{--        <div class="container max-w-5xl mx-auto mb-10 sm:mb-20 lg:mb-32">--}}
{{--            <div class="flex flex-wrap sm:flex-nowrap justify-center items-start lg:items-center">--}}
{{--                <img class="h-56 lg:h-96 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"--}}
{{--                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/pearl-demonator.png">--}}
{{--                <div class="mt-5 sm:mt-0 sm:pl-6 lg:pl-7 sm:order-1 text-left">--}}
{{--                    <h3 class="leading-tight mb-4"><strong>No pedal? No problem.</strong></h3>--}}
{{--                    <p class="leading-tight mb-5">The right tools are essential to your craft.--}}
{{--                    <br><br>--}}
{{--                    That’s why we’ve partnered with Pearl to bring you the highest-rated beginner double bass pedal bundled with 30-Day Double Bass.--}}
{{--                        <br><br>--}}
{{--                    The Pearl P932 Demonator has premium-quality features at an entry-level price point:</p>--}}
{{--                    <ul class="list-disc ml-6">--}}
{{--                        <li class="leading-tight mb-3"><strong>Single-chain drive</strong> for a lightweight, responsive action so you can develop speed and control in your playing.</li>--}}
{{--                        <li class="leading-tight mb-3"><strong>A longer footboard</strong> gives you more room to experiment with different techniques and find what works best for you.</li>--}}
{{--                        <li class="leading-tight"><strong>Interchangeable cam</strong> and <strong>adjustable beater angle</strong> let you find the perfect settings for a natural feel and response.</li>--}}
{{--                    </ul>--}}

{{--                    <div class="w-full flex justify-between mt-6 sm:mt-7">--}}
{{--                        <img class="h-7 sm:h-10 lg:h-12 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/sweetwater.webp">--}}
{{--                        <img class="h-7 sm:h-10 lg:h-12 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/thomann.webp">--}}
{{--                        <img class="h-7 sm:h-10 lg:h-12 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/amazon.webp">--}}
{{--                        <img class="h-7 sm:h-10 lg:h-12 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/long-mcquade.webp">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

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
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/810x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/guarantee-students.webp">
                <div class="mt-4 sm:mt-0 sm:pr-8 sm:text-left">
                    <h3 class="leading-tight mb-4 sm:mb-6"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                            guaranteed.</strong></h3>

                    <p class="leading-normal">30-Day Double Bass is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
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
            <div class="container mx-auto max-w-6xl relative z-50 text-center">
                <img class="h-20 sm:h-28 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/30DDB-logo-dark.webp"
                    alt="30 day Double Bass With 66Samus logo">
                <h3 class="leading-tight mt-2 sm:mt-4"><strong>Boost your speed,<br class="sm:hidden"> control, and creativity.</strong></h3>
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

                    <div class="flex flex-wrap items-start justify-center mx-auto mt-6 sm:mt-10">
                        @include('drumeo.products.partials._order-card', [
                            'threeWide' => true,
                            'header' => 'Course<br> Only',
                            'subheader' => '30-Day Double Bass<br> + Free Bonus Worth $30',
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/course-no-pedal.png',
                            'imageHeight' => 'h-32 md:h-40',
                            'fullPrice' => "$".floatval($productPrices['30-day-jazz']->price),
                            'price' => "$".floatval($productPrices['30-day-jazz']->discounted_price),
                            'specialText' => "One time payment.",
                            'cta' => 'GET STARTED',
                            'link' => '/ecommerce/add-to-cart?products[30-day-double-bass]=1',
                            'bonuses' => [
                                '<strong>30-Day Double Bass</strong>',
                                '<strong>FREE</strong> 1-month Drumeo Access',
                            ],
                        ])
{{--                        @include('drumeo.products.partials._order-card', [--}}
{{--                            'threeWide' => true,--}}
{{--                            'highlightBorder' => true,--}}
{{--                            'badge' => 'Best Deal',--}}
{{--                            'header' => 'Course +<br> Unlimited Lessons',--}}
{{--                            'subheader' => '30-Day Double Bass<br> + Drumeo & 3 Bonuses',--}}
{{--                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/course.png',--}}
{{--                            'imageHeight' => 'h-32 md:h-40',--}}
{{--                            'price' => '$240',--}}
{{--                            'specialText' => "Renews annually at $240.",--}}
{{--                            'cta' => 'ENROLL NOW',--}}
{{--                            'link' => '/ecommerce/add-to-cart?products[30-day-double-bass]=1&products[quietkick-double-bass]=1&products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-independence]=1&locked=true',--}}
{{--                            'bonuses' => [--}}
{{--                                '<strong>30-Day Double Bass</strong>',--}}
{{--                                '<strong>Drumeo Annual Membership</strong>',--}}
{{--                                '<strong>FREE</strong> Double QuietKick',--}}
{{--                                '<strong>FREE</strong> 30-Day Chops',--}}
{{--                                '<strong>FREE</strong> 30-Day Independence',--}}
{{--                            ],--}}
{{--                        ])--}}
{{--                        @include('drumeo.products.partials._order-card', [--}}
{{--                            'threeWide' => true,--}}
{{--                            'badge' => 'Double Pedal',--}}
{{--                            'header' => 'Course + Pedal +<br> Unlimited Lessons',--}}
{{--                            'subheader' => '30-Day Double Bass + Double Pedal<br> + Drumeo & 3 Bonuses',--}}
{{--                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/demonator.png',--}}
{{--                            'imageHeight' => 'h-32 md:h-40',--}}
{{--                            'fullPrice' => '$1020',--}}
{{--                            'price' => '$499',--}}
{{--                            'specialText' => "Renews annually at $240.",--}}
{{--                            'cta' => 'GET EVERYTHING',--}}
{{--                            'link' => '/ecommerce/add-to-cart?products[30-day-double-bass]=1&products[pearl-demonator]=1&products[quietkick-double-bass]=1&products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-independence]=1&promo-code=pearl-annual-bundle&locked=true',--}}
{{--                            'bonuses' => [--}}
{{--                                '<strong>30-Day Double Bass</strong>',--}}
{{--                                '<strong>Drumeo Annual Membership</strong>',--}}
{{--                                '<strong>Pearl Demonator Double Pedal</strong>',--}}
{{--                                '<strong>FREE</strong> Double QuietKick',--}}
{{--                                '<strong>FREE</strong> 30-Day Chops',--}}
{{--                                '<strong>FREE</strong> 30-Day Independence',--}}
{{--                            ],--}}
{{--                        ])--}}

                    </div>

{{--                <a role="link" class="inline-block mt-4" aria-label="Start a monthly membership" href="/ecommerce/add-to-cart?products[30-day-double-bass]=1&products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-independence]=1&locked=true">--}}
{{--                <p><u><em><strong>Don't want to pay shipping?</strong> Click here to join Drumeo<br class="hidden sm:inline"> and get 30-Day Double Bass with no physical bonuses.</em></u></p></a>--}}
            </div>
        </section>
        {{-- <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
            <p class="max-w-3xl px-4 md:px-2 leading-loose">
                <i class="fas fa-info-circle text-drumeo" aria-hidden="true"></i> <b>Shipping Disclaimer –</b> Your physical bonuses may not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is up to the shipping gods.
            </p>
        </section> --}}
        <section class="text-center py-10 text-white" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
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
{{--        @include('_partials.components.video-modal', [--}}
{{--            'name' => 'trailerM',--}}
{{--            'video' => '999638868',--}}
{{--            'vimeo' => true,--}}
{{--            'styles' => 'pb-[177%] bg-white',--}}
{{--        ])--}}
        @include('_partials.components.video-modal', [
            'name' => 'trailer',
            'video' => '1010405112',
            'vimeo' => true,
        ])
    @else
        @include('_partials.components.video-modal', [
            'name' => 'trailer',
            'video' => $cohort['cohort_trailer'],
            'styles' => 'aspect-16:9',
        ])
    @endif
