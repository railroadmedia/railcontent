@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Getting Started On The Drums | Drumeo</title>
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">

    <meta name="description" content="Go from a total beginner to playing your first drum beats in this FREE series.">
    <meta property="og:description" content="Go from a total beginner to playing your first drum beats in this FREE series.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/updated/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
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

@section('content')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7 lg:py-12" style="background-color:#000a1e;">
        <div class="container mx-auto max-w-3xl clearfix">
            <div class="text-center sm:px-3">
                <img class="h-12 sm:h-14" src="https://d1fyshwdvi6fth.cloudfront.net/Drumeo/Lead-gens/Logos/5207cf19-6510-427e-8f23-8255e931edf0-GSOTD-BannerLogo.svg">
                <h3 class="my-4"><strong>
                        Check your email for<br class="inline sm:hidden"> your free drum lessons.</strong></h3>
                <p class="leading-normal mb-8">
                    Before you get started, here’s a <br class="inline sm:hidden">
                    message from Domino Santantonio!</p>
                <div class="max-w-xs mx-auto px-10 sm:px-7 relative">
                    <img class="absolute top-0 right-0 -mx-14 -my-3 h-14" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" style="filter: sepia()saturate(20)brightness(.8)hue-rotate(-17deg);">
                    <div class="w-full relative rounded-xl overflow-hidden border-4 border-white" style="padding-bottom: 172%;">
                        <iframe class="fixed inset-0 h-full w-full absolute" src="//player.vimeo.com/video/840152363" frameborder="0" allowfullscreen title="intro-video"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="text-center px-3 py-5 sm:py-7" style="background-color:#FFAC00;">
        <div class="container mx-auto max-w-5xl">
            <h5 class="mb-4">
                Start playing the drums with a <br class="inline sm:hidden">
                free 30-day trial to Drumeo.</h5>
            <a class="join blue smaller anchor-slide" href="#customize-anchor">FREE FOR 30 DAYS <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.</strong></h2>
                <p class="leading-tight mt-2 sm:mt-3 mb-8 sm:mb-10">With Drumeo, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.</p>
            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative z-20 mb-7" x-on:click="trailer = true;">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="https://player.vimeo.com/progressive_redirect/playback/785314560/rendition/540p/file.mp4?loc=external&signature=1549cce1dacabad80dd416b5a439f6639d3b7b30c7e4d70d46245bf70c6d5102" type="video/mp4" autoplay muted loop playsinline></video>
            </div>

            @php
                $songItems = [
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/5000-songs-icon.svg',
                        'fa-icon' => 'fa-music',
                        'title' => 'Play your favorite songs.',
                        'desc' => 'Get 5000+ note-for-note song breakdowns for every style, era, and skill level.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/tempo-icon.svg',
                        'fa-icon' => 'fa-drum',
                        'title' => 'Know what to practice.',
                        'desc' => 'An organized 10-level curriculum featuring many of the world’s best teachers.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/loop-icon.svg',
                        'fa-icon' => 'fa-users',
                        'title' => 'Study with the best.',
                        'desc' => '200+ artist courses +access exclusive live events with drumming legends.',
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
                        'desc' => 'A real teacher will be there to review your videos and answer your questions.',
                    ],
                    [
                        'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices-icon.svg',
                        'fa-icon' => 'fa-heart',
                        'title' => 'Happy student guarantee.',
                        'desc' => 'If Drumeo is not working for you, cancel your membership and get a refund. Zero questions.',
                    ],

                ];
            @endphp

            <div class="text-center w-full max-w-4xl sm:w-auto mt-6 lg:mt-0 mx-auto mb-5">
                <div class="flex flex-wrap">
                    @foreach ($songItems as $songItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                            <div class="flex sm:inline-block">
                                <div class="w-14 sm:w-full flex-shrink-0">
                                    <i class="fa-light {!! $songItem['fa-icon'] !!} text-3xl sm:text-4xl text-drumeo"></i>
{{--                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">--}}
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
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
            'name' => 'Ed Koop',
            'video' => '342059271',
            'title' => 'I’m loving music more than I ever did before!',
            'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
            'name' => 'Barry Lisle',
            'video' => '342066433',
            'title' => 'They walk you through, step-by-step, for any goal.',
            'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
            'name' => 'Lisa Aragon',
            'video' => '373252004',
            'title' => 'I was able to play drums on stage!',
            'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
            'name' => 'Guy Dobbins',
            'video' => '373445704',
            'title' => 'Drummers from all around the world helping you out.',
            'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
            ],
            [
            'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620.jpg',
            'name' => 'Omari Augustine',
            'video' => '553438851',
            'title' => 'Something you can’t get from having a drum teacher.',
            'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
            'name' => 'Marlene Rosen',
            'video' => '373446024',
            'title' => 'I’m rediscovering music again.',
            'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
            'name' => 'Jay Damberg',
            'video' => '373445466',
            'title' => 'Anytime, day or night, I can access the lessons I need.',
            'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
            'name' => 'Ivy Elizondo',
            'video' => '373445819',
            'title' => 'Now we have a band and we’re recording an album!',
            'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead — she’s used Drumeo to build a foundation and formed a band.',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'desktopGrid' => true,
        'header' => 'Trusted by drummers<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
    ])
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeoplus_logo.svg",
        "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
        "songs" => "5000+ popular songs.",
        "firstPoint" => "The world’s best drum lessons.",
        "thirdPoint" => "Unlimited personal support.",
        "fifthPoint" => "Lesson access for piano, guitar, and singing.",
        "plusAnnualLink" => "/getting-started/ty-annual",
        "plusMonthlyLink" => "/getting-started/ty-monthly",
    ])
    @include('musora.sales.components.trial-explanation', [
        'instrument' => 'drumming',
    ])
    @include('drumeo._partials.faq')
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])
@stop
