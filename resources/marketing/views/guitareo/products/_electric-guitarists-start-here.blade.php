    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/guitareo/products/electric-guitarists-start-here/logo.webp"
                        alt="30-Day Double Bass With 66Samus Logo">
                    @php
                        $lines = [
                            'Learn electric guitar essentials',
                            'Release your inner rockstar',
                            'Play riffs, chords, and solos'
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

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative sm:hidden bg-cover bg-top cursor-pointer autoplay-video"
                        style="padding-bottom: 63%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/header.webp');"
{{--                            x-on:click="trailer = true;"--}}
                    >
{{--                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>--}}
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-guitareo"></i> Play music right away
                        <i class="ml-2 fas fa-check text-guitareo"></i> Develop your technique
                        <i class="ml-2 fas fa-check text-guitareo"></i> Practice every day
                    </p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-guitareo"></i><br> Play music <br> right away</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-guitareo"></i><br> Develop your <br> technique</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-guitareo"></i><br> Practice <br> every day</p>
                    </div>

                    <div class="flex flex-wrap items-left sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            @if(!empty($hasProduct) && $hasProduct == 'true')
                                <a class="join sold-out medium w-full anchor-slide">YOU'RE ENROLLED!</a>
                            @else
{{--                                <a x-on:click="waitlistModal = true;" class="join sold-out medium w-full">JOIN WAITLIST</a>--}}
                                <a href="#final" class="join guitareo medium w-full anchor-slide">ENROLL NOW</a>
                            @endif
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                                alt="Image of joined student profiles in 30-Day Double Bass With 66Samus">
                            <p class="inline-block leading-tight text-sm align-middle">Join
                                {{ number_format($nPackOwners ?? 0) }} guitarists who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:inline-block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/header.webp');"
{{--                            x-on:click="trailer = true;"--}}
                    >
{{--                        <div class="join white smaller absolute  bottom-1  bottom-2 left-1"><i class="fas fa-play"></i> Watch Trailer</div>--}}
                    </div>
                </div>
            </div>

            <div
                class="flex flex-wrap md:flex-nowrap text-center border rounded-lg border-gray-300 mt-6 lg:mt-8 mb-2 lg:mb-4">
                <div class="w-full md:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 md:py-3 lg:py-4">
                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5 text-2xl"><strong>October 7th</strong></h4>
                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                        Enrollment closes in <br class="lg:hidden">
                         <span class="inline text-guitareo" id="countdown" data-countdown-date="2024-10-07 00:00:00">
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
                        <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-guitareo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> October 7th to<br class="hidden md:inline"> November 1st</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-start">
                        <i class="far fa-fw mr-3 md:mr-0 fa-clock text-guitareo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-start">
                        <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-guitareo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play basic riffs,  <br class="hidden md:inline"> chords, and solos.</span>
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
            <h2 class="leading-tight mb-7 sm:mb-12"><strong>Set yourself up for success<br> on the electric guitar.</strong></h2>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/know-exactly.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'When starting a new instrument, it can be a little tricky to get your hands working together. Electric Guitarists Start Here builds your coordination over 30 days with daily practice. All you have to do is play along! ',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'It’s not easy trying to fit guitar practice between work, family, and life! That’s why Electric Guitarists Start Here is perfect for any schedule. You only need 10 minutes per day to start playing music.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/sound-good.webp',
                        'title' => 'Sound good from the start.',
                        'desc' =>
                            'Learn the foundations, but make it fun! You’ll get all the essential skills under your fingers by playing music every day – no extra theory or homework required. Just you rocking it on the electric guitar.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/build.webp',
                        'title' => 'Build your skills.',
                        'desc' =>
                            'Over 30 days, you’ll start off with single string riffs. Next, you’ll learn some power chords and open chords. Finally, you’ll add a little star power with an intro to soloing.',
                    ],
                ];
            @endphp
            <div class="timeline-container guitareo max-w-4xl lg:max-w-4xl mx-auto relative px-4 pt-7">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20 @if(!$loop->last) mb-16 md:mb-20 @else md:mb-0 @endif">
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
        <h1 class="leading-none sm:-mt-6 lg:-mt-7 hidden md:inline-block"><i class="fal fa-angle-down text-guitareo"></i></h1>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #EFF7FF">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-24 sm:h-28 lg:h-36 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/guitareo/products/electric-guitarists-start-here/logo.webp"
                    alt="30-Day Double Bass With 66Samus Logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-guitareo mr-5"></i> Daily guided workouts<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> Flexible schedule<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> FREE for Guitareo members<br>
                </h4>
            </div>

            @if(!empty($hasProduct) && $hasProduct == 'true')
                <a class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">YOU'RE ENROLLED!</a><br>
            @else
                <a href="#final" class="join guitareo medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>
            @endif
            <img class="h-7 mr-1 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                alt="Image of joined student profiles in 30-Day Double Bass With 66Samus">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join
                {{ number_format($nPackOwners ?? 0) }} guitarists who<br> have already registered.</p>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img
                    class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/logo.webp"
                    alt="30-Day Double Bass With 66Samus Logo"> <strong> is designed for:</strong></h2>

            @php
                $drummers = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/brand-new.webp',
                        'title' => 'Brand-New<br> Guitar Players ',
                        'description' =>
                            'If you haven’t learned anything on the electric guitar yet, this challenge is for you! You’ll learn all the essentials in just 30 days – from how to hold the instrument to basic soloing.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/guitareo/products/electric-guitarists-start-here/acoustic.webp',
                        'title' => 'Acoustic<br> Guitar Players ',
                        'description' =>
                            'Want to transfer your acoustic skills to the electric guitar? Electric Guitarists Start Here shows you the way. You’ll get helpful tips like how to get your amp dialed in and sounding great.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/beginner.webp',
                        'title' => 'Beginner<br> Guitar Players ',
                        'description' =>
                            'If you already know a handful of riffs and chords, Electric Guitarists Start Here is great for improving your technique. In just 10 minutes a day, you’ll build the skills to take your playing to the next level!',
                    ],
                ];
            @endphp

            <div class="flex flex-col sm:flex-row text-left justify-center">
                @foreach ($drummers as $drummer)
                    <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                        <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                            style="background-image:url('{{ $drummer['image'] }}'); object-position: 60% 0">
                            <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong>
                                    <i class="fas fa-check-circle text-guitareo text-3xl"></i><br>{!! $drummer['title']  !!}</strong></h6>
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
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/coach.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/electric-guitarists-start-here/coach.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                        alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-guitareo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Ayla Tesler-Mabé</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Ayla has been making waves in the world of guitar as a professional guitarist, vocalist, multi-instrumentalist, and composer since the age of 14.
                        <br><br>
                        She loves exploring various musical styles, as seen through her work with Calpurnia and Ludic, as well as her debut EP “Let Me Out!!”
                        <br><br>
                        Ayla’s approachable teaching style makes learning guitar accessible, engaging, and fun. Who better to jumpstart your electric guitar journey?
                    </h6>
                    <div class="flex justify-around text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
                                alt="tiktok icon">
                            <h3 class="mt-2"><strong>105K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>25M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg"
                                alt="insta icon">
                            <h3 class="mt-2"><strong>314K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>

    @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => '995994882',
        'vimeo' => true,
    ])
