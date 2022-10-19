@extends('drumeo.sales.pages.coaches-method-songs-layout')

@section('meta')
    @parent
    <title>Drumeo Songs - Play your favorite songs.</title>
    <meta property="og:title" content="Drumeo Songs - Play your favorite songs.">

    <meta name="description" content="Get detailed song breakdowns and play-along tools for 2000+ of the most iconic drum songs of all time.">
    <meta property="og:description" content="Get detailed song breakdowns and play-along tools for 2000+ of the most iconic drum songs of all time.">
    <style>
        .song {
            background: center center/cover no-repeat;
            transition:opacity .3s;
            width:25%;
            padding-bottom:25%;
        }
        .song:hover {
            opacity:0.8;
        }
        .content-section .song-wrap {
            margin-bottom:0!important;
            height:auto!important;
        }
        .song-wrap .song:nth-child(n+12) {
            display:none;
        }
        @media (min-width: 768px) {
            .song-wrap .song {
                width:16.66%;
                padding-bottom:16.66%;
            }
            .song-wrap .song:nth-child(n+12) {
                display:inline-block;
            }
            .song-wrap .song:nth-child(n+18) {
                display:none;
            }
        }
        @media (min-width: 1024px) {
            .song-wrap .song {
                width:14.28%;
                padding-bottom:14.28%;
            }
            .song-wrap .song:nth-child(n+18) {
                display:inline-block;
            }
            .song-wrap .song:nth-child(n+21) {
                display:none;
            }
        }
        .song-wrap.show-all .song {
            display:inline-block;
        }
        .song-wrap .song.songs-show-all {
            display:inline-block;
        }
        .song-wrap.show-all .song.songs-show-all {
            display:none;
        }
    </style>
@endsection

@section('content')
    <header class="header overflow-hidden w-full text-white bg-black text-center fixed z-0">
        <div class="absolute top-0 left-0 z-0 h-full w-full bg-cover bg-center" style="background-color:#2a354b;background-image:url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/songs-bg.jpg');"></div>
        <div class="container mx-auto">
            <div class="transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2 w-full absolute z-30 animated fadeIn">
                <img class="h-11 md:h-16 lg:h-20 mb-3 md:mb-7 lg:mb-8" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/circles-songs-vert.png"><br>
                <img class="h-8 md:h-12 lg:h-14 imgfilter-songs" src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg"><br>
                <h1 class="my-3 md:my-5 lg:my-6"><strong>Play your<br class="inline md:hidden"> favorite songs.</strong></h1>
                <p class="text-light-navy leading-normal max-w-xl mb-4 md:mb-8 px-5 text-shadow-2">
                    Get detailed song breakdowns and play-along tools for<br class="hidden sm:inline">
                    {{ Prices::$songs }}+ of the most iconic drum songs of all time.
                </p>
                <a class="join smaller outline songs methodvideo autoplay-video mx-2" data-open="songsTrailer"><i class="fas fa-play"></i>&nbsp; SONGS TRAILER</a>
                <a href="#customize-anchor" class="join smaller anchor-slide mx-2">GET STARTED &raquo;</a>
            </div>
            <div class="bottom absolute bottom-0 left-0 right-0 z-30 py-5 md:pt-0 md:pb-8">
                <p class="text-light-navy leading-none tracking-wider">INCLUDED WITH</p>
                <img class="h-6 mt-1 mb-3" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"><br>
                <h5 class="leading-none" style="margin: 0 auto;"><i class="fas fa-angle-down"></i></h5>
            </div>
        </div>
    </header>

    <section class="content-section songs-info text-center">
        <div class="container mx-auto">
            <h2><strong>Try a demo.</strong></h2>
            <p class="mt-3 md:mt-4 mb-7 md:mb-12 text-light-navy">
                Click below to try out expert transcriptions<br class="inline md:hidden"> for three famous drum songs.</p>



            <div class="flex flex-wrap px-5 md:px-2 lg:px-0 max-w-xs sm:max-w-6xl mx-auto">
                <div class="w-full md:w-1/3 px-5 md:px-2 mb-4 md:mb-0 block autoplay-video" data-open="soundslice1">
                    <div class="relative aspect-1:1 rounded-xl mb-1 md:mb-3 bg-cover bg-center cursor-pointer lazyload" data-bg="https://d1923uyy6spedc.cloudfront.net/22855-card-thumbnail-maxres-1608066633.jpg">
                        <i class="fas fa-play play-button absolute top-1/2 left-1/2 translate--1/2"></i>
                    </div>
                    <p><strong>No One Knows</strong><br>
                        <span class="text-light-navy">Queens Of The Stone Age</span></p>
                </div>
                <div class="w-full md:w-1/3 px-5 md:px-2 mb-4 md:mb-0 block autoplay-video" data-open="soundslice2">
                    <div class="relative aspect-1:1 rounded-xl mb-1 md:mb-3 bg-cover bg-center cursor-pointer lazyload" data-bg="https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/rush-tom-sawyer.jpg">
                        <i class="fas fa-play play-button absolute top-1/2 left-1/2 translate--1/2"></i>
                    </div>
                    <p><strong>Tom Sawyer</strong><br>
                        <span class="text-light-navy">Rush</span></p>
                </div>
                <div class="w-full md:w-1/3 px-5 md:px-2 block autoplay-video" data-open="soundslice3">
                    <div class="relative aspect-1:1 rounded-xl mb-1 md:mb-3 bg-cover bg-center cursor-pointer lazyload" data-bg="https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/sting-seven-days.jpg">
                        <i class="fas fa-play play-button absolute top-1/2 left-1/2 translate--1/2"></i>
                    </div>
                    <p><strong>Seven Days</strong><br>
                        <span class="text-light-navy">Sting</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section text-center">
        <div class="container mx-auto">
            <h2><strong>All styles & skill levels.</strong></h2>
            <p class="mt-3 md:mt-4 mb-7 md:mb-12 text-light-navy">Choose the perfect song for your skill level, with {{ Prices::$songs }}+<br class="hidden sm:inline lg:hidden">
                expertly transcribed drumming anthems to bash along with.</p>
            <div class="song-wrap flex flex-wrap max-w-6xl mx-auto">
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/acdc-back-in-black.png" alt="AC/DC - Back In Black"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/270343-card-thumbnail-maxres-1602085835.jpg" alt="Avenged Sevenfold - Hail To The King"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260310-card-thumbnail-maxres-1592340581.jpg" alt="B.B. King - The Thrill Is Gone"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/beastie-boys-fight-for-your-right.jpg" alt="Beastie Boys - Fight For Your Right"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/20249-card-thumbnail-maxres-1592340937.jpeg" alt="Blink-182 - All The Small Things"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bon-jovi-livin-on-a-prayer.jpg" alt="Bon Jovi - Livin' On A Prayer"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264327-card-thumbnail-maxres-1596218854.jpg" alt="Chick Corea Elektric Band - Beneath The Mask"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/chris-stapleton-tennessee-whiskey.jpg" alt="Chris Stapleton - Tennessee Whiskey"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260343-card-thumbnail-maxres-1592340469.jpg" alt="Coldplay - Yellow"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/creedence-clearwater-revival-bad-moon-rising.jpg" alt="Creedence Clearwater Revival - Bad Moon Rising"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/dr-dre-i-need-a-doctor.jpg" alt="Dr. Dre - I Need A Doctor"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/foo-fighters-everlong.jpg" alt="Foo Fighters - Everlong"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/eminem-lose-yourself.jpg" alt="Eminem - Lose Yourself"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260404-card-thumbnail-maxres-1592340380.jpeg" alt="Green Day - 21 Guns"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/jason-aldean-dirt-road-anthem.jpg" alt="Jason Aldean - Dirt Road Anthem"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/jay-z-empire-state-of-mind.jpg" alt="Jay-Z - Empire State Of Mind"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/john-coltrane-acknowledgement.jpg" alt="John Coltrane - Acknowledgement"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/john-lennon-imagine.jpg" alt="John Lennon - Imagine"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/johnny-cash-i-walk-the-line.jpg" alt="Johnny Cash - I Walk The Line"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/journey-don_t-stop-believin.jpg" alt="Journey - Don't Stop Believin'"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/led-zeppelin-good-times-bad-times.jpg" alt="Led Zeppelin - Good Times Bad Times"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/metallica-enter-sandman.jpg" alt="Metallica - Enter Sandman"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/miles-davis-freddie-freeloader.jpg" alt="Miles Davis - Freddie Freeloader"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/nirvana-come-as-you-are.jpg" alt="Nirvana - Come As You Are"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/nitty-gritty-dirt-band-fishin-in-the-dark.jpg" alt="Nitty Gritty Dirt Band - Fishin' In The Dark"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/oasis-wonderwall.jpg" alt="Oasis - Wonderwall"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/outkast-hey-ya.jpg" alt="OutKast - Hey Ya!"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/22613-card-thumbnail-maxres-1592341635.jpeg" alt="Pantera - Walk"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/paul-simon-50-ways-to-leave-your-lover.jpg" alt="Paul Simon - 50 Ways To Leave Your Lover"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/pearl-jam-even-flow.jpg" alt="Pearl Jam - Even Flow"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/phil-collins-in-the-air-tonight.jpg" alt="Phil Collins - In The Air Tonight"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/red-hot-chili-peppers-under-the-bridge.jpg" alt="Red Hot Chili Peppers - Under The Bridge"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/rush-tom-sawyer.jpg" alt="Rush - Tom Sawyer"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/santana-smooth.jpg" alt="Santana - Smooth"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/280219-card-thumbnail-maxres-1608317248.jpg" alt="Snarky Puppy - What About Me?"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/31234-card-thumbnail-maxres-1592341311.jpg" alt="Sublime - Santeria"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/system-of-a-down-toxicity.jpg" alt="System Of A Down - Chop Suey!"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/the-killers-mr-brightside.jpg" alt="The Killers - Mr. Brightside"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/The-Roots-Mellow-My-Man.jpg" alt="The Roots - Mellow My Man"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/tool-the-pot.jpg" alt="Tool - The Pot"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/twenty-one-pilots-heathens.jpg" alt="Twenty One Pilots - Heathens"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/van-halen-hot-for-teacher.jpg" alt="Van Halen - Hot For Teacher"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/weezer-buddy-holly.jpg" alt="Weezer - Buddy Holly"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260702-card-thumbnail-maxres-1592339760.jpg" alt="Wolfmother - Joker &amp; The Thief"></div>
                <div class="song lazyload" data-bg="https://cdn.musora.com/image/fetch/w_330,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260706-card-thumbnail-maxres-1592339732.jpg" alt="Zac Brown Band - Chicken Fried"></div>
                <div class="song songs-show-all text-light-navy relative cursor-pointer" style="background:linear-gradient(to bottom, #010b1f, #09204a);">
                    <div class="absolute top-1/2 left-1/2 translate--1/2 w-full">
                        <i class="fas fa-arrow-right text-xl md:text-3xl lg:mb-2"></i><br>
                        <p><strong>SEE MORE</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section songs-info text-center">
        <div class="container mx-auto">
            <h2><strong>The best part about<br class="inline sm:hidden"> playing the drums.</strong></h2>
            <p class="mt-3 md:mt-4 mb-7 md:mb-12 text-light-navy">Handy playalong tools make it easier than ever<br class="inline sm:hidden"> to play the songs you love and nail every part.</p>
            <div class="flex-container" style="margin-bottom: 0;margin-top: 0;">
                <div class="pic-wrap on-left">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-1.png">
                    <img class="lazyload side-pic mobile-feature" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-2-alt.png">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-3.png">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-4.png">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-5.png">
                </div>
                <div class="text-left">
                    <div class="text-icon-wrap transition-opacity duration-500 active">
                        <i class="text-songs fal fa-music"></i>
                        <div>
                            <h4><strong>Find the perfect tempo.</strong></h4>
                            <p class="mt-1 md:mt-2 text-light-navy">Slow down or speed up any section of a song to hear every note your favorite drummer plays. When you’ve nailed the part, bump the tempo back up and rock out in real time.</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap transition-opacity duration-500">
                        <i class="text-songs fal fa-repeat"></i>
                        <div>
                            <h4><strong>Loop the trouble spots.</strong></h4>
                            <p class="mt-1 md:mt-2 text-light-navy">No more pausing and rewinding when you mess up that fill. Simply grab the section of the song and loop it over, and over, and over until you’ve got it down.</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap transition-opacity duration-500">
                        <i class="text-songs icon-metronome"></i>
                        <div>
                            <h4><strong>Counting just got easier.</strong></h4>
                            <p class="mt-1 md:mt-2 text-light-navy">Add or remove the metronome to help you count out the beats in a bar. This makes learning songs of all levels easier -- even that odd-time Rush song!</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap transition-opacity duration-500">
                        <i class="text-songs fal fa-arrow-to-bottom"></i>
                        <div>
                            <h4><strong>Take your charts anywhere.</strong></h4>
                            <p class="mt-1 md:mt-2 text-light-navy">Downloadable pdf files let you take sheet music of your favorite songs anywhere -- to the gig, rehearsal with the band, or back to the practice space.</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap transition-opacity duration-500">
                        <i class="text-songs fal fa-phone-laptop"></i>
                        <div>
                            <h4><strong>Available on all your devices.</strong></h4>
                            <p class="mt-1 md:mt-2 text-light-navy">Load up DrumeoSONGS on your phone during practice time, your laptop when you’re behind the kit, and your tablet at the gig -- wherever the music takes you!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="reveal large" id="soundslice1" data-reveal data-reset-on-close="true">
        <div class="w-full relative overflow-hidden" style="padding-bottom: 85vh;">
            <iframe class="fixed inset-0 h-full w-full absolute reset-on-close" src=""
                    data-lazy-load-url="https://www.soundslice.com/scores/169787/embed/?api=1&amp;scroll_type=2&amp;branding=0"
                    frameborder="0" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
    <div class="reveal large" id="soundslice2" data-reveal data-reset-on-close="true">
        <div class="w-full relative overflow-hidden" style="padding-bottom: 85vh;">
            <iframe class="fixed inset-0 h-full w-full absolute reset-on-close" src=""
                    data-lazy-load-url="https://www.soundslice.com/scores/169812/embed/?api=1&amp;scroll_type=2&amp;branding=0"
                    frameborder="0" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
    <div class="reveal large" id="soundslice3" data-reveal data-reset-on-close="true">
        <div class="w-full relative overflow-hidden" style="padding-bottom: 85vh;">
            <iframe class="fixed inset-0 h-full w-full absolute reset-on-close" src=""
                    data-lazy-load-url="https://www.soundslice.com/scores/163402/embed/?api=1&amp;scroll_type=2&amp;branding=0"
                    frameborder="0" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
    <div class="reveal large" id="songsTrailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/495414171?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            //show all button
            $('.songs-show-all').click(function () {
                $('.song-wrap').addClass('show-all');
                $(this).addClass('hidden');
            });

            // song point cycle
            var $songPoint = $('.songs-info .side-pic'),
                $songPointToggle = $('.songs-info .text-icon-wrap'),
                currentSongPoint = 0,
                updateIndex = function (currentSongPoint) {
                    $songPoint.removeClass('active');
                    $songPointToggle.removeClass('active');

                    $songPoint.eq(currentSongPoint).addClass('active');
                    $songPointToggle.eq(currentSongPoint).addClass('active');
                },
                autoplaySongPoints = setInterval(function () {
                    if(currentSongPoint < 4){
                        currentSongPoint++;
                        updateIndex(currentSongPoint);
                    }
                    else {
                        currentSongPoint = 0;
                        updateIndex(currentSongPoint);
                    }
                }, 10000);

            $songPoint.first().addClass('active');
            $songPointToggle.first().addClass('active');
            $songPointToggle.on('click', function () {
                updateIndex($songPointToggle.index($(this)));
                currentSongPoint = $songPointToggle.index($(this));
                clearInterval(autoplaySongPoints);
            });

        });
    </script>
@endsection
