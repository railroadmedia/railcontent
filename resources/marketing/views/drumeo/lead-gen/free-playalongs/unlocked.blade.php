@extends('drumeo._partials.global-layout')

@section('global-head')
    <meta name="robots" content="noindex">
    <title>9 FREE PLAY-ALONGS | Drumeo</title>
    <meta property="og:title" content="9 FREE PLAY-ALONGS | Drumeo">
    <meta name="description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">
    <meta property="og:description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/free-playalongs/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
        .edge-pitch {top:40px;}
        @media (min-width: 768px) {  .edge-pitch {top:56px;}  }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/choose-your-trial" class="edge-pitch block text-center w-full whitespace-nowrap z-10 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://cdn.musora.com/image/fetch/w_300,q_60,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$drumeoPlayAlongs }}+ more play-alongs + world-class drum  <br>
                    lessons inside Drumeo. Click for a FREE trial.</p>
            </div>
        </div>
    </a>

    <header class="text-white text-center py-14 md:py-24 lg:py-32 px-4 md:px-6" style="background: #062342 url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/order_background.jpg) center center/cover;">
        <div class="container mx-auto">
            <img class="h-16 md:h-28 lg:h-36" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/logo.svg">
            <h6 class="leading-normal my-5">Add your drumming to nine high-quality drumless play-along tracks.</h6>
        </div>
    </header>
    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <div class="album-grid flex flex-wrap justify-center max-w-2xl lg:max-w-4xl mx-auto">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/jost-nickel-the-check-in.png',
                        'song' => 'The Check In',
                        'artist' => 'Jost Nickel',
                        'url' => '/free-playalongs/songs/1',
                        'descriptions' => 'Contemporary funk with a few odd-time curve balls -- keep your head up!',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Rashid-williams-Rock-out.png',
                        'song' => 'Rock Out',
                        'artist' => 'Rashid Williams',
                        'url' => '/free-playalongs/songs/2',
                        'descriptions' => 'Get creative with this straight-ahead rock jam for all levels.',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Raghav-mehrotra-funky-nasa.png',
                        'song' => 'Funky NASA',
                        'artist' => 'Raghav Mehrotra',
                        'url' => '/free-playalongs/songs/3',
                        'descriptions' => 'Put your groove to the test with this mid-tempo funk track.',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/thomas-pridgen-hypnotized.png',
                        'song' => 'Hypnotized',
                        'artist' => 'Thomas Pridgen',
                        'url' => '/free-playalongs/songs/4',
                        'descriptions' => 'A heavy prog-rock tune with plenty of room to add your biggest fills.',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/kaz-rodriguez-drum-e-o.png',
                        'song' => 'Drum-E-O',
                        'artist' => 'Kaz Rodriguez',
                        'url' => '/free-playalongs/songs/5',
                        'descriptions' => 'Kaz has created play-alongs for the best drummers in the world -- now it’s your turn!',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/glen-sobel-7-8-rock.png',
                        'song' => '7 / 8 Rock',
                        'artist' => 'Glen Sobel',
                        'url' => '/free-playalongs/songs/6',
                        'descriptions' => 'A brain-busting odd-time rock song to test your feel & metre.',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/sarah-thawer-straight-reggae.png',
                        'song' => 'Straight Reggae',
                        'artist' => 'Sarah Thawer',
                        'url' => '/free-playalongs/songs/7',
                        'descriptions' => 'Turn the beat around with a stanky reggae groove -- is your crosstick ready?',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/tony-coleman-shuffle.png',
                        'song' => 'Tony Coleman Shuffle',
                        'artist' => 'Tony Coleman',
                        'url' => '/free-playalongs/songs/8',
                        'descriptions' => 'Give your shuffle a workout in this eponymous blues jam.',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/todd-sucherman-just-a-second.png',
                        'song' => 'Just A Second',
                        'artist' => 'Todd Sucherman',
                        'url' => '/free-playalongs/songs/9',
                        'descriptions' => 'A pop-rock banger begging for your best back beat to drive the song. ',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <a href="{{ $bonus['url'] }}" class="w-1/2 sm:w-1/3 px-2 md:px-3 mb-5 md:mb-7">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $bonus['image'] }}"></div>
                        </div>
                        <h5 class="mt-3 mb-1"><strong>w/ {{ $bonus['artist'] }}</strong></h5>
                        <p class="text-light-navy leading-tight">{{ $bonus['descriptions'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center py-14 md:py-24 lg:py-32 text-white" style="background: #062342 url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/order_background.jpg) center bottom/cover;">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1><strong>Keep the party going.</strong></h1>
                <h4 class="mt-5 lg:mt-6 mb-6 lg:mb-9 leading-normal px-3">
                    Get {{ Prices::$drumeoPlayAlongs }}+ play-alongs & world-class drum lessons  <br class="hidden md:inline">
                    inside Drumeo. Click below to try a free trial.</h4>
                <a class="join" href="/choose-your-trial">Free Trial &raquo;</a>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
