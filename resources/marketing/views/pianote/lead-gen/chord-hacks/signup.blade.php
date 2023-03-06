@php
    $reviews = [
        [
            'img' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jessripley.jpg',
            'testimonial' => 'Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.',
            'name' => 'Jess Ripley',
            'location' => 'California, USA',
        ],
        [
            'img' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/nabilabdelmoneim.jpg',
            'testimonial' => 'You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!',
            'name' => 'Nabil Abd El-Moneim',
            'location' => 'British Columbia, Canada',
        ],
        [
            'img' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/xitlalicaballero2.jpg',
            'testimonial' => 'My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.',
            'name' => 'Xitlali Caballero',
            'location' => 'Florida, USA',
        ],
        [
            'img' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/serenadorward.jpg',
            'testimonial' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'location' => 'Ontario, Canada',
        ],
    ];
@endphp

@extends('pianote.lead-gen.chord-hacks.chord-hacks-layout')

@section('meta')
    @parent
    <title>Chord Hacks | Pianote</title>
@stop()

@section('head')
    @parent
    <style>
        h1, h2, h3, h4, h5, h6, li, p {
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }

        header {
            background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/header_long_m.jpg');
            background-size:cover;
        }

        h3 {
            font-size:21px;
        }

        .join.smaller {
            font-size:18px;
            padding:16px 25px;
        }

        input {
            color:#8D8D8D !important;
            font-size:16px !important;
        }

        @media (min-width:426px) {
            header {
                background-size:400px;
            }
        }

        @media (min-width:768px) {
            header {
                background-image:url('https://www.musora.com/musora-cdn/image/width=2500,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/header_long.jpg');
                background-size:cover;
            }

            h3 {
                font-size:24px;
            }

            .join.smaller {
                padding:16px 30px;
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px;
            }
        }
    </style>
@endsection

@section('page-body')
    <header class="py-6 md:py-24 bg-center md:bg-top bg-no-repeat" style="background-color:#021536;">
        <div class="max-w-4xl mx-auto px-2 md:px-4 lg:px-0">
            <div class="max-w-lg mx-auto md:mx-0 text-center md:text-left">
                <div class="px-1">
                    <img class="h-6 sm:h-8 lg:h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/logo.svg" alt="logo white">
                    <h3 class="font-extrabold leading-tight text-white mt-80 md:mt-6">
                        The easier way to learn piano chords so you can play popular songs!
                    </h3>
                    <h6 class="my-4" style="color: rgba(208, 226, 231, 0.8);">
                        Enter your email below for your free beginner lessons.
                    </h6>
                </div>
                <div class="md:pr-20">
                    @include("pianote._partials._sign-up-form", [
                    "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                    "formName" => 'Chord Hacks',
                        "buttonText" => "Get started for free",
                        'stacked' => true,
                        'inputBorder' => '1px solid #7A8491',
                        'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    ])
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 sm:px-6 lg:px-6 py-10 lg:py-20 relative overflow-hidden">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-wrap flex-col md:flex-row md:items-center">
                <div class="md:w-1/2 max-w-lg mx-auto md:max-w-auto">
                    <h3 class="font-extrabold md:mt-10 leading-tight">
                        Learn to play piano <br class="sm:hidden">quicker with chords!
                    </h3>
                    <p class="uppercase my-4 lg:my-6 text-xs tracking-widest" style="color: #ABB5C2;">
                        course overview
                    </p>
                    <p class="mb-8 lg:mb-10">
                        Start playing the songs you love without having to sit through any boring music theory. Chords are the “secret weapon” to help you learn faster, play more songs, and have fun! In just 6 fun lessons, you’ll improve your skills and learn the most popular chords so you can play your favorite songs on the piano.
                    </p>
                    <div class="flex flex-wrap mb-10 text-left">
                        <div class="w-1/2 mb-6 pl-2 md:pl-4" style="border-left:3px solid #FF0000;">
                            <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">date</p>
                            <span class="md:text-sm lg:text-base">Start anytime.</span>
                        </div>
                        <div class="w-1/2 pl-4">
                            <div class="mb-6 pl-2 md:pl-4" style="border-left:3px solid #FF0000;">
                                <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">skill level</p>
                                <span class="md:text-sm lg:text-base">For beginners.</span>
                            </div>
                        </div>
                        <div class="w-1/2 pl-2 md:pl-4 mb-6 md:mb-0" style="border-left:3px solid #FF0000;">
                            <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">cost</p>
                            <span class="md:text-sm lg:text-base">Lifetime access for free!</span>
                        </div>
                        <div class="w-1/2 pl-4">
                            <div class="pl-2 md:pl-4" style="border-left:3px solid #FF0000;">
                                <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">result</p>
                                <span class="md:text-sm lg:text-base">Play your first song.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 sm:mt-0 relative">
                    <img class="max-w-2xl md:max-w-md lg:max-w-2xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/collage.png" alt="collage">
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 lg:py-20 px-2">
        <div class="max-w-lg sm:max-w-4xl lg:max-w-6xl mx-auto">
            <p class="text-center uppercase mb-4 text-xs tracking-widest" style="color: #ABB5C2;">
                What you'll get
            </p>
            <h3 class="text-center leading-tight font-extrabold mb-10 px-2 sm:px-4 lg:px-0">
                6 videos so you can understand the basics of piano <br class="hidden sm:inline">chords and use that knowledge to play real songs.
            </h3>
            <div class="flex flex-wrap mb-14">
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <div class="relative mb-4">
                        <img class="relative z-0 rounded-lg lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/Lesson1.jpg" alt="lesson-1">
                    </div>
                    <p>
                        What is a chord? And how do they make songs? In this lesson you’ll start playing chords right away!
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/Lesson2.jpg" alt="lesson-2">
                    <p>
                        This might be the most important piano lesson you ever have. It’ll change how you think about music and chords. Inversions are the “secret weapon” to sounding better.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/Lesson3.jpg" alt="lesson-3">
                    <p>
                        Music is more than just the notes. It’s also the rhythm. You’ll discover how to use rhythm to make your playing more beautiful.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/Lesson4.jpg" alt="lesson-4">
                    <p>
                        You have two hands. Use them! This can be a challenge for a lot of players, but you’ll be shown exactly how to play with both hands at the same time. Nothing to fear here!
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/Lesson5.jpg" alt="lesson-2">
                    <p>
                        Time to get fancy and sound amazing. You’ll learn tips and tricks to unlock your creativity and maybe even start writing your own music.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/Lesson6.jpg" alt="lesson-3">
                    <p>
                        We’ll pull back the curtain on pop music and show you how everything you’ve learned until now can be used to play your favorite songs.
                    </p>
                </div>
            </div>
            <h5 class="font-extrabold text-center italic">
                You’ll get 6 FREE lessons in total.
            </h5>
        </div>
    </section>

    <section class="pt-32 pb-20 relative" style="background: #FBF2F2;">
        <div class="h-10 absolute left-0 right-0" style="background: linear-gradient(to top left, #FBF2F2 calc(50% - 1px), #FBF2F2, #fff calc(50% + 1px)); top: -1px;"></div>
        <div class="px-10 text-center">
            <h3 class="font-extrabold text-center mb-10">
                The easiest way to get started on the piano.
            </h3>
            <div class="max-w-sm md:max-w-5xl mx-auto flex flex-col md:flex-row md:gap-8 mb-8">
                <div class="text-center flex-1 mb-8">
                    <img class="h-16 lazyload" data-src="https://pianote.s3.amazonaws.com/lead-gen/getting-started-2022/guide-icon.svg" alt="guided icon">
                    <h5 class="font-extrabold my-4">
                        Guided Lessons
                    </h5>
                    <p>
                        You’ll know exactly what to play and practice to get the best start on the piano.
                    </p>
                </div>
                <div class="text-center flex-1 mb-8">
                    <img class="h-16 lazyload" data-src="https://pianote.s3.amazonaws.com/lead-gen/getting-started-2022/learn-icon.svg" alt="learn icon">
                    <h5 class="font-extrabold my-4">
                        Learn Anytime
                    </h5>
                    <p>
                        The online structure allows you to learn and progress at your own pace.
                    </p>
                </div>
                <div class="text-center flex-1">
                    <img class="h-16 lazyload" data-src="https://pianote.s3.amazonaws.com/lead-gen/getting-started-2022/questions-icon.svg" alt="sheet icon">
                    <h5 class="font-extrabold my-4">
                        Your Questions Answered
                    </h5>
                    <p>
                        Got questions? You’ll be able to ask a real teacher.
                    </p>
                </div>
            </div>
            <a class="join blue smaller anchor-slide" href="#final">I’M READY TO START MY PIANO JOURNEY!</a>
        </div>
    </section>

    <section class="py-20" style="background:#01050F;">
        <div class="max-w-sm md:max-w-4xl mx-auto px-4 sm:px-0 text-white lg:gap-10 relative flex flex-col md:flex-row lg:block items-center justify-center text-right">
            <picture>
                <source media="(min-width:768px)" srcset="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/coach.jpg">
                <img class="rounded-lg lg:absolute lg:left-10 lg:top-0 h-72 md:h-96 lg:h-full mb-10 md:mb-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/coach.jpg" alt="jared profile">
            </picture>

            <div class="max-w-md inline-block text-left md:pl-8 lg:pl-0">
                <p class="uppercase mb-2 tracking-widest" style="color: #ABB5C2;">
                    Meet your piano teacher
                </p>
                <h1 class="font-extrabold mb-6">
                    Lisa Witt
                </h1>
                <div class="font-bold text-white mb-8">
                    <img class="h-6 mr-2 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/youtube_icon.svg" alt="youtube icon">
                    1M Subscribers
                    <img class="h-6 ml-6 mr-2 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/youtube_icon.svg" alt="youtube icon">
                    24M Views
                </div>
                <p>
                    Lisa Witt might just be the happiest piano teacher on the internet.<br><br>
                    With 20 years of teaching experience, her online lessons have helped millions of students around the world.<br><br>
                    Lisa’s contagious enthusiasm will have you excited from the very first time you sit down to play -- and it will make learning the piano a super fun and engaging experience.<br><br>
                    Start your piano journey with Lisa today.
                </p>
            </div>
        </div>
    </section>

    <section class="pb-20" style="background:#01050F;">
        <div class="max-w-5xl mx-auto text-center text-white px-4">
            <p class="uppercase tracking-widest" style="color: #ABB5C2;">
                LISA HAS HELPED THOUSANDS OF STUDENTS REACH THEIR GOALS
            </p>
            <h3 class="font-extrabold leading-7 md:leading-9 my-6">
                Read what students are saying about Pianote, Lisa <br class="hidden md:inline-block">& her approach to online piano education.
            </h3>
            <div class="flex flex-wrap max-w-md mx-auto sm:max-w-full">
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2 mb-8 md:mb-4 lg:mb-0">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-top bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/sales/2022/testimonials/jessripley.jpg">
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “I’m blown away by the program you’ve created.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span style="color:#FF0000;">Jess Ripley</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">california, usa</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="JessRipley">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2 mb-8 md:mb-4 lg:mb-0">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-top bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/sales/2022/testimonials/nabilabdelmoneim.jpg" >
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “I’m a lot better at using both hands and it opened up more songs.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span style="color:#FF0000;">Nabil Abd El-Moneim</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">british columbia, canada</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="NabilAbdEl-Moneim">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2 mb-8 sm:mb-0">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-top bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/sales/2022/testimonials/xitlalicaballero2.jpg">
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “I’m six years old. My biggest moment is when I play Für Elise.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span style="color:#FF0000;">Xitlali Caballero</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">florida, usa</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="XitlaliCaballero">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-top bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/sales/2022/testimonials/serenadorward.jpg">
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “If I was taught this way as a child, I would have never quit.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span style="color:#FF0000;">Serena Dorward</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">ontario, canada</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="SerenaDorward">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 md:py-14 relative" style="background:#01050F;">
        <div class="container mx-auto relative z-20">
            <p class="text-center uppercase tracking-wide mb-14" style="color:#ABB5C2;">
                Frequently asked questions
            </p>
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

        {{-- gradient --}}
        <div class="absolute bottom-0 -top-10 w-full z-10" style="background: linear-gradient(180deg, rgba(1, 5, 15, 0.5) 0%, rgba(3, 37, 70, 0.5) 100%);">

        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center customize px-4 lg:px-6 relative z-50 overflow-hidden text-white py-20" style="background:#01050F;">
        <div class="max-w-5xl mx-auto flex flex-wrap flex-col md:flex-row md:items-center">
            <div class="max-w-lg mx-auto text-center sm:text-left w-full md:w-1/2 sm:pl-5">
                <img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/logo.svg" alt="logo">
                <h3 class="pt-4 md:pt-5 leading-7 md:leading-9 font-extrabold mb-6">
                    6 beginner piano lessons.
                    Learn your favorite songs on the piano.
                    Study at your own pace.
                </h3>
                <p class="text-left mb-4 sm:mb-5 mx-auto inline-block sm:leading-loose">
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> Unlock the piano keyboard.<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> Play your favorite songs on the piano.<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> No music theory required.<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> 100% free -- lifetime access!<br>

                    Enter your email below for your 6 free lessons.
                </p>
                <div class="max-w-md md:max-w-auto lg:w-96 mx-auto md:mx-0">
                    @include("pianote._partials._sign-up-form", [
                    "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                    "formName" => 'Chord Hacks',
                        "buttonText" => "Get started for free",
                        'stacked' => true,
                        'inputBorder' => '1px solid #7A8491',
                        'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    ])
                </div>
            </div>
            <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 md:mt-0 relative">
                <img class="max-w-2xl md:max-w-md lg:max-w-2xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/collage.png" alt="collage">
            </div>
        </div>
    </section>

    @foreach ($reviews as $review)
        <div class="reveal large relative" style="background: transparent;" id="{{ str_replace(' ', '', $review['name']) }}" data-reveal data-reset-on-close="false">
            <div class="px-10 sm:px-20 relative" style="background: transparent;">
                <div class="max-w-xl mx-auto rounded-lg overflow-hidden" style="background: #051124;">
                    <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=700,quality=85/{{ $review['img'] }}" alt="{{ $review['name'] }}">
                    <p class="italic p-4 text-white">
                        “{!! $review['testimonial'] !!}”
                    </p>
                    <p class="uppercase font-bebas tracking-wider leading-5 mb-4 text-center">
                        <span style="color:#FF0000;">{{ $review['name'] }}</span><br>
                        <span class="text-sm" style="color:#ABB5C2;">{{ $review['location'] }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
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
