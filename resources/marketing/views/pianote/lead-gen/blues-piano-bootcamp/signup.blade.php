@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Chord Hacks | Pianote</title>
    <meta property="og:title" content="Chord Hacks">

    <meta name="description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/chord-hacks">
@endsection

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>
        header .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
    </style>
@endsection

@section('page-body')
    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:linear-gradient(to right, #077dff, #343fff, #5a09ff);">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left pr-0 sm:pr-6">
                    <img class="h-5 sm:h-6 lg:h-7 mb-1 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/logo.svg" alt="logo" fetchpriority="high">
                    <h2 class=""><strong>The essential keys</strong></h2>
                    <h3 class="sm:-mt-1 lg:mt-0"> to playing blues piano</h3>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-2"><strong>Sign up for 4 FREE play-along lessons</strong></h6>

                    <div class="mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top" style="padding-bottom: 75%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image-m.png" alt="header image" fetchpriority="high" />
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check"></i> Learn by doing
                        <i class="ml-2 fas fa-check"></i> No theory required
                        <i class="ml-2 fas fa-check"></i> Free lifetime access</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle"></i><br> No theory <br> required</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle"></i><br> Free lifetime <br>access</p>
                    </div>

                    <div class="mt-6 sm:mt-5 lg:mt-10">
                        @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                        "formName" => 'Chord Hacks',
                            "buttonText" => "start for free",
                            'stacked' => true,
                            'inputBorder' => '1px solid #747474',
                            'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/chord-hacks/thank-you/"
                        ])
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="relative bg-contain bg-top" style="padding-bottom: 102%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image.png" alt="header image" fetchpriority="high" />
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border rounded-lg border-gray-300 mt-8 lg:mt-12 mb-2 lg:mb-4" style="background-color:#fbfdff;">
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-indigo-700 text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm">Start anytime!</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-indigo-700 text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes a day for just 5 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-piano-keyboard text-indigo-700 text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Skill Level</strong><br>
                            <span class="text-sm">Beginner.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-indigo-700 text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play your first song.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <p class=" mb-5 sm:mb-8" style="color:#abb5c2">SEE MORE LESSONS</p>
            <div class="flex flex-wrap items-start justify-center text-left">
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">Now it’s time to work on that left hand. This can be a sticking point for a lot of piano players, but don’t worry - just do what Lisa does!</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">You have two hands. Use them! You’ll be playing beautiful music with both hands in this 10-minute lesson. Just hit play and follow along.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">How do you make your chords sounds extra special? Add some fills! They sound complicated but are easy to do. You’ll learn Lisa’s favorite.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">This might be the most important piano lesson you have. It will change how you think about and see piano chords. Are you ready?! (Of course you are!)</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">Piano chords changed my life.
                        <br><br>
                        I grew up learning classical piano through the Royal Conservatory. I didn’t know what chords were, or how they were used in composition.
                        <br><br>
                        I just had to read the notes on the page and play them.
                        <br><br>
                        That all changed the day I discovered chords and chord inversions.
                        <br><br>
                        Suddenly I could start improvising, creating my own rhythms and melodies, and eventually write my own music. Music became something I “created” rather than something I “played”.
                        <br><br>
                        Chords gave me the ability and confidence to do what we all dream of doing…
                        <br><br>
                        Sit down at the piano and “just play”.
                        <br><br>
                        If you’ve ever dreamt of playing popular songs for your family and friends without spending months learning every note. Or if you’ve ever wanted to explore improvisation and song-writing. Or if you just want to sit and play the keys and see what comes out…
                        <br><br>
                        You need to try Easy Chords.
                        <br><br>
                        Over 30 days, I’ll guide you through the stages I used to learn and feel comfortable playing piano chords. You’ll discover how chord inversions will transform your playing and make it easier to play the songs you love.
                        <br><br>
                        Come join me.
                    </p>
                    <img class="float-right h-12 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/lisa-witt-signature.png" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>

            <h3 class="leading-tight mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What students are saying about<br class="inline lg:hidden"> Lisa and her teaching style:</strong></h3>
            <div class="flex flex-wrap text-left">

                @php
                    $testimonials = [
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
                        'title' => "I’m blown away by the program you’ve created.",
                        'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
                        'name' => 'Jess Ripley',
                        'location' => 'California, USA',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
                        'title' => "If I was taught this way as a child, I would have never quit.",
                        'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                        'name' => 'Serena Dorward',
                        'location' => 'Ontario, Canada',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
                        'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
                        'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
                        'name' => 'Jayde McIntosh',
                        'video' => '660596722',
                        'location' => 'Australia',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
                        'title' => "Such a fantastic and welcoming student community.",
                        'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                        'name' => 'Ian Kershaw',
                        'video' => '660596700',
                        'location' => 'United Kingdom',
                        ],
                    ]
//                @endphp
                @foreach ($testimonials as $key => $testimonial)
                    <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                        <div class="sm:flex items-start p-5 bg-white rounded-lg">
                            <img class="h-14 sm:h-16 lg:h-20 rounded-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=160,quality=95/{{ $testimonial['image'] }}" alt="testimonial {{ $key }}" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <p class="sm:pl-4"><strong>{{ $testimonial['name'] }}</strong><br>
                                <em class="leading-tight inline-block mb-1 opacity-60">{{ $testimonial['location'] }}</em><br>
                                “{!! $testimonial['description']  !!}”
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <span class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" data-open="waitlistModal">JOIN WAITLIST</span><br>

            {{--                <a href="#final"--}}
            {{--                    class="join medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>--}}

            <img class="h-7 mr-1 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/piano-players.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
        </div>
    </section>
    <section class="py-8 md:py-16 lg:py-20 relative" style="background:linear-gradient(to bottom,#01050F, #02142a);">
        <div class="container mx-auto relative z-20">
            <div class="flex flex-wrap max-w-6xl mx-auto px-2 lg:px-3">
                <div class="px-3 md:px-4 w-full md:w-5/12 lg:w-5/12">
                    <h4 class="mb-3 text-white">
                        <strong>Is this really free?</strong>
                    </h4>
                    <p style="color:#ABB5C2;">
                        Yes! We love sharing videos to help piano players -- and deep down we hope you’ll see some of the value that we provide inside Pianote juuuuust in case you ever want to consider joining!
                    </p>
                </div>
                <div class="px-3 md:px-4 w-full md:w-7/12 lg:w-7/12">
                    <h4 class="mt-7 md:mt-0 mb-3 text-white">
                        <strong>Why do I need to give my email address?</strong>
                    </h4>
                    <p style="color:#ABB5C2;">
                        Secretly, we’re hoping to start a relationship with you. This is our way of saying “Hey we create awesome piano lessons, can we show you?” Don’t worry, we won’t send you spam or share your email address with anybody else. You’ll get exactly what’s promised on this page along with ongoing piano videos, free lessons, and some special offers. And if you don’t like our emails, you can unsubscribe at any time.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center justify-center">
                <div class="text-center w-full sm:w-7/12 lg:w-1/3 mb-7 lg:mb-0">
                    <img class="h-20 md:h-24 lg:h-28 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h4 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5"><strong>
                            20 Guided Play-Along Lessons.<br>
                            Feedback From Real Teachers.<br>
                            Lifetime Course Access.
                        </strong></h4>
                    <div class="w-full mx-auto sm:mx-0">
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Master your chord changes & inversions.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Course runs June 5 to July 5.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i>  Choose your best option to get started.</p>
                    </div>
                    <div class="max-w-md md:max-w-auto mx-auto md:mx-0">
                        @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                        "formName" => 'Chord Hacks',
                            "buttonText" => "start for free",
                            'stacked' => true,
                            'inputBorder' => '1px solid #7A8491',
                        "redirectURL" => "/chord-hacks/thank-you/"
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "demoVid",
        "video" => '//player.vimeo.com/video/830711083?h=701c01c83f&autoplay=1',
        "title" => 'demoVid'
    ])
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
