@extends('pianote.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    <title>Chord Hacks | Pianote</title>
    <meta property="og:title" content="Chord Hacks">

    <meta name="description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/chord-hacks">
@stop

@section('head')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .splide__pagination__page.is-active {
            background:#01050F;
            transform:none !important;
        }

        .splide__pagination__page {
            margin:3px 10px !important;
            opacity:1 !important;
        }

        @media (min-width:768px) {
            .splide__pagination__page {
                margin:3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }
    </style>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop

@section('body-data')
    x-data ='{
    trailer : false,
    }'
@endsection

@section('page-body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7 lg:py-12" style="background-color:#000a1e;">
        <div class="container mx-auto max-w-3xl clearfix">
            <div class="text-center sm:px-3">
                <img class="h-8 sm:h-10" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/logo.svg">
                <h3 class="mt-4 leading-tight"><strong>
                        Congratulations! Your free lessons <br class="hidden sm:inline">
                        will be landing in your inbox soon!</strong></h3>
                <p class="leading-normal mt-2 mb-8">
                    Before you get started, here’s a <br class="inline sm:hidden">
                    message from Lisa!</p>
                <div class="max-w-xs mx-auto px-10 sm:px-7 relative">
                    <img class="absolute top-0 right-0 -mx-14 -my-3 h-14" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" style="filter: sepia()saturate(20)brightness(.8)hue-rotate(-17deg);">
                    <div class="w-full relative rounded-xl overflow-hidden border-4 border-white" style="padding-bottom: 172%;">
                        <iframe class="fixed inset-0 h-full w-full absolute" src="//player.vimeo.com/video/847164746?h=857e80c5e2" frameborder="0" allowfullscreen title="intro-video"></iframe>
                    </div>
                </div>
                <p class="mt-8 max-w-lg">Here’s what you need to do now:
                    <br><br>
                    <strong>✓ Check your inbox.</strong> Your access link will be emailed to the email address you provided. If you don’t see it in your inbox, check your spam or junk folder. Make sure you add us to your contacts or safe sender so you never miss a lesson!
                    <br><br>
                    <strong>✓ Get to your piano!</strong> You’re here to learn right?! You’ll be following along with Lisa for all of the lessons. That means you’ll want to be at your piano when you watch them. You can watch them on ANY device.
                    <br><br>
                    <strong>✓ Tell your friends and family.</strong> If you like the lessons, or you know someone who also wants to learn the piano, please <a target="_blank" href="/chord-hacks"><u><strong>share this link with them!</strong></u></a> Learning is more fun when it’s done together. And having a buddy learn with you will set you up for greater success.
                    <br><br>
                    We’ll see you in Lesson 1!!</p>
            </div>
        </div>
    </div>
    <section class="text-center px-3 py-5 sm:py-7" style="background-color:#FFAC00;">
        <div class="container mx-auto max-w-5xl">
            <h5 class="mb-4">
                Start playing the piano with a  <br class="inline sm:hidden">
                free trial to Pianote.</h5>
            <a class="join pianote smaller anchor-slide" href="#customize-anchor">FREE FOR 30 DAYS <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Learn the piano by<br class="inline sm:hidden"> <u>playing the piano</u>.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3 mb-8 sm:mb-10">With Pianote, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.</p>
            <div class="aspect-16:9 cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative z-20 mb-7" x-on:click="trailer = true;">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e" type="video/mp4" autoplay muted loop playsinline></video>
            </div>

            @php
                $songItems = [
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/5000-songs-icon.svg',
                        'fa-icon' => 'fa-music',
                        'title' => 'Play your favorite songs.',
                        'desc' => 'Get 1000+ note-for-note song breakdowns for every style, era, and skill level.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/tempo-icon.svg',
                        'fa-icon' => 'fa-piano-keyboard',
                        'title' => 'Know what to practice.',
                        'desc' => 'Develop your core skills, techniques, and musicality to play beautifully in any setting.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/loop-icon.svg',
                        'fa-icon' => 'fa-users',
                        'title' => 'Study with the best.',
                        'desc' => 'Lifetime teachers, touring performers, recording professionals, and trending stars.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/no-drums-icon.svg',
                        'fa-icon' => 'fa-video',
                        'title' => 'Track & share your progress.',
                        'desc' => 'Start your own personal progress thread to track & share how far you’ve come!',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/play-it-right-icon.svg',
                        'fa-icon' => 'fa-whistle',
                        'title' => 'Get personal feedback.',
                        'desc' => 'Get weekly live streams, student lesson plans, and access to a global piano community.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices-icon.svg',
                        'fa-icon' => 'fa-heart',
                        'title' => 'Happy student guarantee.',
                        'desc' => 'If Pianote is not working for you, cancel your membership and get a refund. Zero questions.',
                    ],

                ];
            @endphp

            <div class="text-center w-full max-w-4xl sm:w-auto mt-6 lg:mt-0 mx-auto mb-5">
                <div class="flex flex-wrap">
                    @foreach ($songItems as $songItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                            <div class="flex sm:inline-block">
                                <div class="w-14 sm:w-full flex-shrink-0">
                                    <i class="fal {!! $songItem['fa-icon'] !!} text-3xl sm:text-4xl text-pianote"></i>
{{--                                                                        <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">--}}
                                </div>
                                <div class="text-left sm:text-center">
                                    <p class="mb-1 sm:my-2"><strong>{!!$songItem['title']!!}</strong></p>
                                    <p class="text-sm">{!! $songItem['desc'] !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 relative z-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>

    @php
        $testimonials = [
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
            'title' => "Such a fantastic and welcoming student community.",
            'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
            'name' => 'Ian Kershaw',
            'video' => '660596700',
            'location' => 'United Kingdom',
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
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/xitlalicaballero2.jpg',
            'title' => "I’m six years old. My biggest moment is when I play Für Elise.",
            'description' => "My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.",
            'name' => 'Xitlali Caballero',
            'video' => '660596752',
            'location' => 'Florida, USA',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/nabilabdelmoneim.jpg',
            'title' => "I’m a lot better at using both hands and it opened up more songs.",
            'description' => "You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!",
            'name' => 'Nabil Abd El Moneim',
            'video' => '660596735',
            'location' => 'British Columbia, Canada',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
            'title' => "I’m blown away by the program you’ve created.",
            'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
            'name' => 'Jess Ripley',
            'location' => 'California, USA',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/anselmdesouza.jpg',
            'title' => "Helped coordinate my left and right hands.",
            'description' => "I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined Pianote and went back to the basics.<br><br>Pianote helped coordinate my left and right hands. The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging.",
            'name' => 'Anselm de Souza',
            'location' => 'Singapore',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/johnmaclean.jpg',
            'title' => "My 6 year old daughter started dancing as I played.",
            'description' => "Before Pianote and The Method, I was completely lost in terms of knowing how to become a better musician. All I would do is try to play songs, but without any of the structure and practice that is required to actually improve. And with face to face lessons I wasn’t really progressing much between the lessons. But having access to the video tutorials online lets me go back as often as I need to.<br><br>My biggest breakthrough has been independent hand control – allowing me to hear rich music that I’m creating for the first time. And gaining that confidence has allowed me to start to improvise the pieces that I learn.<br><br>The lightbulb moment happened when my 6 year old daughter started dancing as I played! You must be doing something right if someone dances to music that you’re playing, right?",
            'name' => 'John Maclean',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
            'title' => "If I was taught this way as a child, I would have never quit.",
            'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'location' => 'Ontario, Canada',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'desktopGrid' => true,
        'header' => 'Trusted by pianists<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
    ])
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-plus-logo-light.svg",
        "logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-white.png",
        "songs" => "1000+ popular songs.",
        "firstPoint" => "Unlimited piano lessons.",
        "thirdPoint" => "Direct access to real teachers.",
        "fifthPoint" => "Lesson access for singing, guitar, and drums.",
        "plusAnnualLink" => "/chord-hacks/ty-annual",
        "plusMonthlyLink" => "/chord-hacks/ty-monthly",
    ])
    @include('musora.sales.components.trial-explanation', [
        'instrument' => 'piano',
    ])
    @include('pianote._partials.faq')
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
@stop
