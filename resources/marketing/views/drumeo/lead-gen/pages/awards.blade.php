@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo Awards 2021 Winners | Drumeo</title>
    <meta property="og:title" content="Drumeo Awards 2021 Winners">

    <meta name="description" content="The Drumeo Awards highlights inspirational drummers at the top of their game.">
    <meta property="og:description" content="The Drumeo Awards highlights inspirational drummers at the top of their game.">

    <meta property="og:url" content="https://www.drumeo.com/awards/">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/beat/awards/fb-share-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
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

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
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

        .text-light-navy {
            color: #a1afc9;
        }
        .chrome {
            background:#222 -webkit-gradient(linear, left top, right top, from(#222), to(#222), color-stop(0.5, #fff)) 0 0 no-repeat;
            background-image:-webkit-linear-gradient(-40deg, transparent 0%, transparent 40%, #fff 50%, transparent 60%, transparent 100%);
            background-size:100px;
            -webkit-background-clip:text;
            animation:3s shine infinite linear;
            color:rgba(252, 208, 91, 0.8);
        }
        .items-start:nth-child(even) .chrome {
            animation-delay: 0.8s;
        }
        @-webkit-keyframes shine {
            0% {
                background-position:-20%;
            }
            10% {
                background-position:top left;
            }
            90% {
                background-position:top right;
            }
            100% {
                background-position:120%;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")


    <section class="text-white pt-8 pb-14 sm:pt-14 sm:pb-32 lg:pt-16 lg:pb-32 px-4 bg-cover bg-top lazyload" style="background-color:#000;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/beat/awards/header-bg.jpg">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-1/2 lg:w-5/12 text-center">
                    <img class="h-28 sm:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/beat/awards/drumeo-awards-logo.png">
                    <h1 class="my-1.5 sm:my-3 font-bebas text-5xl sm:text-6xl lg:text-7xl" style="color:#fcd05b"><span style="color: #0c0b0b;-webkit-text-stroke: 1px #fcd05b;">2021</span> WINNERS</h1>
                    <p class="hidden sm:inline-block text-left max-w-sm px-4">The Drumeo Awards highlights inspirational drummers at the top of their game. Learn about this year's winners below.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-7/12">
                    <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                        <iframe class="absolute w-full h-full" src="https://www.youtube.com/embed/4Nt6t0E-5jg" frameborder="0" allowfullscreen allow="autoplay" title="drumeo-video"></iframe>
                    </div>
                    <p class="text-center inline-block sm:hidden mx-auto mt-3 sm:mt-0">The Drumeo Awards highlights inspirational drummers at the top of their game. Learn about this year's winners below.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-white pb-20 sm:px-5" style="background-color:#02050e;">
        <div class="container mx-auto max-w-5xl">
            <div class="py-6 sm:py-8 px-4 sm:px-8 lg:px-12" style="background-color:#272727;">
                <img class="h-14 sm:h-20 lg:h-24 -mt-12 sm:-mt-16 mb-3 lg:mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/beat/awards/drummer-of-the-year-logo.png">
                <p class="leading-tight max-w-xl m-0">Drumeo’s Drummer Of The Year awards - chosen by you, the community - celebrate those who stand out in different musical styles, and recognize exceptional performances, recordings, and your favorite drummer overall.</p>
            </div>

            <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12 mb-16 sm:mb-24" style="background-color:#1c1a1d;">
                @php
                    $videoModals = [
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/travis-barker.jpg",
                        "award" => "Drummer Of The Year",
                        "winner" => "Travis Barker",
                        "description" => "It’s not an overstatement to say Travis worked with everyone this year. From Machine Gun Kelly and Bebe Rexha to Avril Lavigne and Willow Smith, Barker was on speed dial in the music industry in 2021. His playing and influence transcends his punk rock roots and he’s one of the most sought after drummers in the world – especially this past year. You voted Travis Barker 2021’s Drummer Of The Year, and it’s a much deserved win!<br><br> This award goes to someone who checked all the boxes with recording projects, live or virtual events, online presence, and all-around excellence in their contributions to music. This drummer is likely to be a household name – at least among drummers – because they’ve been relentless in their pursuit of the art form over the past year and beyond.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/mario-duplantier.jpg",
                        "award" => "Drum Recording Of The Year",
                        "winner" => "Mario Duplantier",
                        "description" => "You voted Mario Duplantier’s work on Gojira’s 2021 album, Fortitude, as Drum Recording Of The Year. With different approaches to his parts in each song – but a conscious flow with how the tracks roll together – Duplantier’s playing is tasteful, groovy, and deliberate. His writing stands out on the single “Born For One Thing” in particular.<br><br> All incredible nominees in this category either played on a single track or a full album that made an outstanding contribution to music via the drums. They have been recognized in their respective musical genres and this award was created to celebrate exceptional recorded music.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/mario-duplantier.jpg",
                        "award" => "Drum Performance Of The Year",
                        "winner" => "Mario Duplantier",
                        "description" => "The only drummer to win in two categories this year, Mario Duplantier also took home the Drum Performance Of The Year Award for his drum solo, “Cyclone.” Combining dynamics, raw power, authenticity and tribal elements into a 2.5 minute video, the Gojira drummer reinforces the fact that drums are amazing all on their own.<br><br> <a href='https://www.youtube.com/watch?v=La_xNrBKmu8'><u>Watch the full solo here</u></a>. The winner of this award qualifies by putting on a must-watch performance during the year, either with a full band or flying solo, at an event or in a studio video. Each 2021 nominee had something special about their performance, whether it was their technical ability, their energy, or their innovation. You chose Duplantier!",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/el-estepario-siberiano.jpg",
                        "award" => "Online Creator Of The Year",
                        "winner" => "El Estepario Siberiano",
                        "description" => "El Estepario (just a nickname, of course) blew up this year on Instagram, Youtube and beyond. While he’s been making drum videos for 10+ years, he’s been taking his content and drumming career to the next level. A prolific creator and insane player, he finds creative ways to approach the drums and still shreds on a tiny kit.<br><br> This award goes to a drummer who has built their profile independently, has created a strong online community, and is constantly inspiring people with their videos, playing, and personality.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/anderson-paak.jpg",
                        "award" => "Soul/Funk Drummer Of The Year",
                        "winner" => "Anderson .Paak",
                        "description" => "A new project formed in 2021 with Bruno Mars, Silk Sonic released an album based around .Paak’s drum beats, and his contributions to drumming have recently highlighted excellence in the genre. Like Karen Carpenter and other drummer-vocalists whose talents behind the kit sometimes end up flying under the mainstream radar, we’re excited that you voted Anderson .Paak as the soul/funk drummer of the year.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/questlove.jpg",
                        "award" => "R&B/Hip-Hop Drummer Of The Year",
                        "winner" => "Questlove",
                        "description" => "You voted Questlove R&B/Hip-Hop Drummer Of The Year! Not only was he the Musical Director of the 2021 Academy Awards while continuing his regular stint on Jimmy Fallon, but the Roots drummer kept expanding his career by directing an award-winning documentary (Summer Of Soul) and releasing his latest book, Music Is History. Questlove doesn’t just bring it as a drummer; he’s totally elevated his game as a completely well-rounded creative and advocate for the arts and his communities.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/aaron-spears.jpg",
                        "award" => "Pop Drummer Of The Year",
                        "winner" => "Aaron Spears",
                        "description" => "Step aside, Britney – you aren’t the only Spears at the top of pop. Aaron Spears – your 2021 Pop Drummer Of The Year – took on a Vegas residency with Usher, drummed on The Masked Singer and played with Ariana Grande, among other initiatives that made the past year a win in more ways than one.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/billy-freeman.jpg",
                        "award" => "Country Drummer Of The Year",
                        "winner" => "Billy Freeman",
                        "description" => "A humble guy whose name you may not see adorning all the magazine covers, Billy Freeman was so busy in 2021 he was impossible to ignore. Tours with Dustin Lynch, a new album and singles, and a stint on Jimmy Kimmel gave Freeman a lot to take on. He’s your Country Drummer Of The Year.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/larnell-lewis.jpg",
                        "award" => "Contemporary Drummer Of The Year",
                        "winner" => "Larnell Lewis",
                        "description" => "Lewis had a big year his “Enter Sandman” video went viral, he put on a clinic at PASIC and he participated in a live stream for the Juno Awards (Canada’s Grammys). Snarky Puppy won a Grammy for their latest album while Lewis performed on JAZZFM with The Jeremy Ledbetter Trio, and he was busy coaching drums online as well.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/nate-smith.jpg",
                        "award" => "Jazz Drummer Of The Year",
                        "winner" => "Nate Smith",
                        "description" => "With a new album and accompanying tour dates, a cover story in Jazzism Magazine, an appearance on Seth Meyers and a masterclass, Nate Smith had a busy 2021. A versatile drummer who could’ve also appeared in several categories outside of jazz, he brings a unique crossover edge to the style.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/matt-garstka.jpg",
                        "award" => "Progressive Drummer Of The Year",
                        "winner" => "Matt Garstka",
                        "description" => "On top of Animals As Leaders releasing new music for the first time in five years, Matt Garstka participated in drum camps and clinics, released drum transcriptions, and even streamed on Twitch. A technical yet tasteful player, Garstka continues to break the mold in prog drumming, and at only 32 years old, his best years may still be yet to come.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/jay-weinberg.jpg",
                        "award" => "Metal Drummer Of The Year",
                        "winner" => "Jay Weinberg",
                        "description" => "Jay Weinberg of Slipknot is your Metal Drummer Of The Year. Despite ongoing pandemic challenges, Slipknot released their first new track in over two years and persevered with Knotfest, while Weinberg launched a cool ‘jam with Jay’ initiative.",
                        ],
                        [
                        "last-child" => true,
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/chad-smith.jpg",
                        "award" => "Rock Drummer Of The Year",
                        "winner" => "Chad Smith",
                        "description" => "Chad Smith had a busy year with a Red Hot Chili Peppers release, several supergroup collaborations, work on Eddie Vedder’s solo recordings, a track on Miley Cyrus’ Metallica covers album, and a feature on the Netflix documentary Count Me In.",
                        ],
                     ]
                @endphp
                @foreach($videoModals as $videoModal)
                    <div class="flex items-start {{--award-container cursor-pointer--}} relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif" style="border-color:#404040">
                        <img class="hidden sm:block h-52 lg:h-72 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/{{ $videoModal['image'] }}">
                        <div class="sm:pl-6">
                            <h3 class="text-center sm:text-left uppercase font-bebas chrome" {{--style="color: #fcd05b;"--}}>{{ $videoModal['award'] }}</h3>
                            <img class="block sm:hidden h-52 mx-auto my-3 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/{{ $videoModal['image'] }}">
                            <div {{--class="blur-wrap transition duration-500 filter blur"--}}>
                                <h5 class="text-center sm:text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
                                <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
                            </div>
                        </div>
                        {{--<h2 class="text-shadow-4 chrome absolute top-28 sm:top-1/2 left-0 sm:left-1/3 transform -translate-y-1/2 font-bebas pl-1 sm:pl-9">CLICK TO REVEAL WINNER</h2>--}}
                    </div>
                @endforeach
            </div>

            <div class="py-6 sm:py-8 px-4 sm:px-8 lg:px-12" style="background-color:#272727;">
                <img class="h-14 sm:h-20 lg:h-24 -mt-12 sm:-mt-16 mb-3 lg:mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/beat/awards/legacy-awards-logo.png">
                <p class="leading-tight max-w-xl m-0">These Legacy awards - chosen by a panel of industry experts - honor today’s drummers while paying tribute to the awards’ legendary namesakes.</p>
            </div>

            <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12 mb-8 sm:mb-12" style="background-color:#1c1a1d;">
                @php
                    $videoModals = [
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/steve-gadd.jpg",
                        "award" => "The Buddy Rich Award",
                        "winner" => "Steve Gadd",
                        "description" => "One of the most accomplished and well-known drummers of the 20th century, Buddy Rich is still a household name because of his virtuosic talents and his accomplishments as a bandleader. The recipient of this ‘hall of fame’ award has made their name synonymous with drumming over decades of excellence. This may be through any combination of performance, recording, teaching, or all of the above. This year’s award-winner has the blessing of Buddy’s daughter, Cathy.<br><br> Steve Gadd has influenced a generation of giants, including Dave Weckl and Vinnie Colaiuta. He took the musical application of rudiments to the next level, created chart-topping grooves like 50 Ways To Leave Your Lover, and his discography is massive. His playing style is unmatched and he is the perfect example of a living legend.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/emmanuelle-caplette.jpg",
                        "award" => "The Jim Chapin Award",
                        "winner" => "Emmanuelle Caplette",
                        "description" => "Jim Chapin was a prolific educator whose teachings are still in the hands, feet, and soul of many modern drummers. Having learned from the legendary Sanford Moeller, he taught some of today’s top drummers and educators like Dom Famularo, Steve Smith, Russ Miller and Thomas Lang. His 1948 instructional book, Advanced Techniques For The Modern Drummer, is still a staple of drum education today.<br><br> This award is presented to an educator who has displayed excellence in inspiring & informing drummers everywhere. This could be through education in an academic setting, contributions through a published book, or an online course/channel.<br><br> Dom Famularo – drumming’s global ambassador – personally selected this ‘Educator of the Year’ in honor of Jim Chapin. Here’s what he had to say about the selection: <br><br>“Emmanuelle is the perfect nominee for Drumeo’s Jim Chapin Award. Having studied with Jim starting in the late 1960s, I was able to witness dedication to learning and teaching from Jim’s actions. He was a constant student and always passed this knowledge along to anyone who would listen! His enthusiasm was contagious! I worked with him closely right up to his passing. He continued to push himself to learn. <br><br>This is what I have seen in Emmanuelle! Unending enthusiasm and a strong commitment to learn! Her recent book, “Smile! You’re Drumming” is a great example of her dedication to our art form! She is a performer playing on several TV shows in Canada and the US and has several bands she continues to work with. As an educator she teaches to make sure the next generation is excited about the expression of our instrument! I know Jim would be proud of her continuing the path Jim has started… <br><br> Thank you, Drumeo, for assisting in education online globally. Congratulations Emmanuelle!”",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/joey-jordison.jpg",
                        "award" => "The Louie Bellson Award",
                        "winner" => "Joey Jordison",
                        "description" => "Louie Bellson has long been credited as the first drummer to popularize double bass playing. Before metal and rock came to be, Louie transferred his skills and sounds from hands to feet, finding new ways to express rhythms on the low end. This award is presented to a drummer who has displayed excellence and creativity in double bass drumming. <br><br>Because this is the first year we’re presenting this award, the judges felt ex-Slipknot drummer Joey Jordison was the best fit to set the standard for future winners. His influence, passion, and creativity in double bass was unmatched, and he impacted thousands of drummers around the world, including many of today’s heavy hitters. His untimely passing in 2021 left a massive hole in the drum community and we’re hoping to honor Joey’s legacy with this award.",
                        ],
                        [
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/aric-improta.jpg",
                        "award" => "The Viola Smith Award",
                        "winner" => "Aric Improta",
                        "description" => "Viola Smith was a pioneer in expanding the boundaries of drumming. From her unprecedented, massive drum set (including two elevated gong drums) to playing beyond the age of 100, she was an innovator who carved her own path in the drumming community – especially during an era when she wasn’t encouraged to do so. <br><br>This award is given to a trailblazing drummer who has shown innovation and creativity in how they approach the drum set. This year, we’re presenting the Viola Smith Award to Aric Improta (Night Verses, Fever 333). Unique and innovative, he’s a deep well of wisdom and insight who’s not afraid to challenge the status quo. He combines the worlds of drumming, performance art, electronics and visual media, and he thrills audiences in unexpected ways.",
                        ],
                        [
                        "last-child" => true,
                        "image" => "https://drumeo-assets.s3.amazonaws.com/beat/awards/nandi-bushell.jpg",
                        "award" => "The Tony Williams Award",
                        "winner" => "Nandi Bushell",
                        "description" => "Tony Williams was just 17 years old when he played on Miles Davis’ revolutionary album, Seven Steps To Heaven. This award is presented to a “rookie” drummer who has made a memorable impact at a young age. The winner will have made valuable contributions to drumming and/or inspired others with their music during a ‘breakout’ year.<br><br> This year’s winner is Nandi Bushell, who truly embodies the spirit of this award. Her infectious energy and passion encourages and inspires people to get excited about drumming and about music. Like Tony Williams working with legends at a young age, Nandi has already collaborated with huge names like Dave Grohl and Tom Morello. She is fearlessly setting an incredible course for herself as a developing artist and positive role model.",
                        ],
                     ]
                @endphp
                @foreach($videoModals as $videoModal)
                    <div class="flex items-start {{--award-container cursor-pointer--}} relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif" style="border-color:#404040">
                        <img class="hidden sm:block h-52 lg:h-72 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/{{ $videoModal['image'] }}">
                        <div class="sm:pl-6">
                            <h3 class="text-center sm:text-left uppercase font-bebas chrome" {{--style="color: #fcd05b;"--}}>{{ $videoModal['award'] }}</h3>
                            <img class="block sm:hidden h-52 mx-auto my-3 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/{{ $videoModal['image'] }}">
                            <div {{--class="blur-wrap transition duration-500 filter blur"--}}>
                                <h5 class="text-center sm:text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
                                <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
                            </div>
                        </div>
                        {{--<h2 class="text-shadow-4 chrome absolute top-28 sm:top-1/2 left-0 sm:left-1/3 transform -translate-y-1/2 font-bebas pl-1 sm:pl-9">CLICK TO REVEAL WINNER</h2>--}}
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <h6><strong>Follow us to find out when the <br class="inline sm:hidden"> next voting season is starting!</strong></h6>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble youtube text-white" href="https://www.youtube.com/freedrumlessons/" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook text-white" href="https://facebook.com/drumeo/" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble instagram text-white" href="https://instagram.com/drumeoofficial/" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('.award-container').on('click', function () {--}}
                {{--$(this).removeClass('cursor-pointer').find('img').removeClass('blur brightness-75').addClass('blur-0 brightness-100');--}}
                {{--$(this).find('.blur-wrap').removeClass('blur');--}}
                {{--$(this).find('.chrome').addClass('hidden');--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@stop
