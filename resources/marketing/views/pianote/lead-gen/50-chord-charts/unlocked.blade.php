@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>50 Free Chord Charts | Pianote</title>
    <meta property="og:title" content="50 Free Chord Charts | Pianote">

    <meta name="description" content="Here are 50 chord charts for you to download, print, and play. No reading music required!">
    <meta property="og:description" content="Here are 50 chord charts for you to download, print, and play. No reading music required!">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/50-chord-charts/">
@stop
@section('head')
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
        .edge-pitch {top:40px;}
        @media (min-width: 768px) {  .edge-pitch {top:56px;}  }
    </style>
    <link href="/marketing/parcel/pianote/lead-gen-50-charts.css" rel="stylesheet">
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/js/modal.js"></script>
    <script type="text/javascript" src="/marketing/parcel/drumeo/modal-autoplay.js"></script>
@endsection

@section('page-body')
    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/500-songs-chord-discount" class="edge-pitch block text-center w-full whitespace-nowrap z-10 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://cdn.musora.com/image/fetch/w_1300,q_60,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">
                <p class="inline-block align-middle mx-auto text-xs leading-tight"><strong>Like these songs? Learn 450 more <br>
                        with 500 Songs in 5 Days.</strong></p>
            </div>
        </div>
    </a>

    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <h4 class="mb-4 md:mb-5"><strong>50 Piano Anthems<br> Every. Single. Note.</strong></h4>
            <p class="leading-normal text-navy mb-6 md:mb-12 lg:mb-16">Say hello to your free charts! Click below to get started playing your favorite songs.
                <br><br>
                Choose a song below:</p>
            <div class="album-grid flex flex-wrap justify-center">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/1-alloutoflove-airsupply.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/all-out-of-love-air-supply.pdf',
                        'song' => 'All Out Of Love',
                        'artist' => 'Air Supply',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/2-noone-aliciakeys.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/no-one-alicia-keys.pdf',
                        'song' => 'No One',
                        'artist' => 'Alicia Keys',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/3-whenimgone-annakendrick.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/when-im-gone-anna-kendrick.pdf',
                        'song' => 'When I’m Gone',
                        'artist' => 'Anna Kendrick',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/4-letitbe-thebeatles.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/let-it-be-the-beatles.pdf',
                        'song' => 'Let It Be',
                        'artist' => 'The Beatles',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/5-therose-bettemidler.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/the-rose-bette-midler.pdf',
                        'song' => 'The Rose',
                        'artist' => 'Bette Midler',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/6-iwashere-beyonce.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/i-was-here-beyonce.pdf',
                        'song' => 'I Was Here',
                        'artist' => 'Beyonce',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/7-oceaneyes-billieeilish.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/i-was-here-beyonce.pdf',
                        'song' => 'Ocean Eyes',
                        'artist' => 'Billie Eilish',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/8-pianoman-billyjoel.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/piano-man-billy-joel.pdf',
                        'song' => 'Piano Man',
                        'artist' => 'Billy Joel',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/9-justthewayyouare-brunomars.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/just-the-way-you-are-bruno-mars.pdf',
                        'song' => 'Just The Way You Are',
                        'artist' => 'Bruno Mars',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/10.youresovain-carlysimon.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/youre-so-vain-carly-simon.pdf',
                        'song' => 'You’re So Vain',
                        'artist' => 'Carly Simon',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/11.becauseyoulovedme-celinedion.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/because-you-loved-me-celine-dion.pdf',
                        'song' => 'Because You Loved Me',
                        'artist' => 'Celine Dion',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/12.beautiful-christinaaguilera.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/beautiful-christina-aguilera.pdf',
                        'song' => 'Beautiful',
                        'artist' => 'Christina Aguilera',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/13.athousandyears-christinaperri.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/a-thousand-years-christina-perri.pdf',
                        'song' => 'A Thousand Years',
                        'artist' => 'Christina Perri',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/14.bubblycolbiecaillat.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/bubbly-colbie-caillat.pdf',
                        'song' => 'Bubbly',
                        'artist' => 'Colbie Caillat',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/15.thescientist-coldplay.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/the-scientist-coldplay.pdf',
                        'song' => 'The Scientist',
                        'artist' => 'Coldplay',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/16.thankyou-dido.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/thank-you-dido.pdf',
                        'song' => 'Thank You',
                        'artist' => 'Dido',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/17.perfect-edsheeran.jpg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/perfect-ed-sheeran.pdf',
                        'song' => 'Perfect',
                        'artist' => 'Ed Sheeran',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/18.candleinthewind-eltonjohn.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/candle-in-the-wind-elton-john.pdf',
                        'song' => 'Candle In The Wind',
                        'artist' => 'Elton John',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/19.1234-feist.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/1-2-3-4-feist.pdf',
                        'song' => '1234',
                        'artist' => 'Feist',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/20.overmyhead(cablecar)-thefray.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/over-my-head-cable-car-the-fray.pdf',
                        'song' => 'Over My Head (Cable Car)',
                        'artist' => 'The Fray',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/21.signofthetimes-harrystyles.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/sign-of-the-times-harry-styles.pdf',
                        'song' => 'Sign Of The Times',
                        'artist' => 'Harry Styles',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/22.mightytosave-hillsong.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/mighty-to-save-hillsong-worship.pdf',
                        'song' => 'Mighty To Save',
                        'artist' => 'Hillsong',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/23.amazinggrace-hymn.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/amazing-grace-hymn.pdf',
                        'song' => 'Amazing Grace',
                        'artist' => 'Hymn',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/24.imyours-jasonmraz.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/im-yours-jason-mraz.pdf',
                        'song' => 'I’m Yours',
                        'artist' => 'Jason Mraz',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/25.hands-jewel.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/hands-jewel.pdf',
                        'song' => 'Hands',
                        'artist' => 'Jewel',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/26.allofme-johnlegend.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/all-of-me-john-legend.pdf',
                        'song' => 'All Of Me',
                        'artist' => 'John Legend',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/27.hurt-johnnycash.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/hurt-johnny-cash.pdf',
                        'song' => 'Hurt',
                        'artist' => 'Jonny Cash',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/28.river-jonimitchell.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/river-joni-mitchell.pdf',
                        'song' => 'River',
                        'artist' => 'Joni Mitchell',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/29.youraisemeup-joshgroban.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/you-raise-me-up-josh-groban.pdf',
                        'song' => 'You Raise Me Up',
                        'artist' => 'Josh Groban',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/30.dontstopbelievin-journey.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/dont-stop-believin-journey.pdf',
                        'song' => 'Don’t Stop Believin’',
                        'artist' => 'Journey',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/31.overtherainbow-judygarland.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/over-the-rainbow-judy-garland.pdf',
                        'song' => 'Over The Rainbow',
                        'artist' => 'Judy Garland',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/32.firework-katyperry.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/firework-katy-perry.pdf',
                        'song' => 'Firework',
                        'artist' => 'Katy Perry',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/33.breakaway-kellyclarkson.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/breakaway-kelly-clarkson.pdf',
                        'song' => 'Breakaway',
                        'artist' => 'Kelly Clarkson',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/34.amillionreasons-ladygaga.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/a-million-reasons-lady-gaga.pdf',
                        'song' => 'A Million Reasons',
                        'artist' => 'Lady Gaga',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/35.yousay-laurendaigle.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/you-say-lauren-daigle.pdf',
                        'song' => 'You Say',
                        'artist' => 'Lauren Daigle',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/36.hello-lionelrichie.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/hello-lionel-richie.pdf',
                        'song' => 'Hello',
                        'artist' => 'Lionel Richie',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/37.whatawonderfulworld-louisarmstrong.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/what-a-wonderful-world-louis-armstrong.pdf',
                        'song' => 'What A Wonderful World',
                        'artist' => 'Louis Armstrong',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/38.scar-missyhiggins.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/scar-missy-higgins.pdf',
                        'song' => 'Scar',
                        'artist' => 'Missy Higgins',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/39.apologize-onerepublic.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/apologize-one-republic.pdf',
                        'song' => 'Apologize',
                        'artist' => 'OneRepublic',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/40.creep-radiohead.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/creep-radiohead.pdf',
                        'song' => 'Creep',
                        'artist' => 'Radiohead',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/41.killingmesoftly-robertaflack.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/killing-me-softly-roberta-flack.pdf',
                        'song' => 'Killing Me Softly',
                        'artist' => 'Roberta Flack',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/42.staywithme-samsmith.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/stay-with-me-sam-smith.pdf',
                        'song' => 'Stay With Me',
                        'artist' => 'Sam Smith',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/43.gravity-sarabareilles.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/gravity-sara-bareilles.pdf',
                        'song' => 'Gravity',
                        'artist' => 'Sara Bareilles',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/44.iwillrememberyou-sarahmclachlan.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/i-will-remember-you-sarah-mclachlan.pdf',
                        'song' => 'I Will Remember You',
                        'artist' => 'Sarah McLachlan',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/45.mercy-shawnmendes.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/mercy-shawn-mendes.pdf',
                        'song' => 'Mercy',
                        'artist' => 'Shawn Mendes',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/46.lovestory-taylorswift.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/love-story-taylow-swift.pdf',
                        'song' => 'Love Story',
                        'artist' => 'Taylor Swift',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/47.dropsofjupiter(tellme)-train.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/drops-of-jupiter-tell-me-train.pdf',
                        'song' => 'Drops Of Jupiter (Tell Me)',
                        'artist' => 'Train',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/48.riptide-vancejoy.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/riptide-vance-joy.pdf',
                        'song' => 'Riptide',
                        'artist' => 'Vance Joy',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/49.athousandmiles-vanessacarlton.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/a-thousand-miles-vanessa-carlton.pdf',
                        'song' => 'A Thousand Miles',
                        'artist' => 'Vanessa Carlton',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/albums/50.seeyouagain-wizkhalifa.jpeg',
                        'pdf' => 'https://pianote.s3.amazonaws.com/lead-gen/50-chord-charts/pdf/see-you-again-wiz-khalifa.pdf',
                        'song' => 'See You Again',
                        'artist' => 'Wiz Khalifa',
                        ]
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 px-2 md:px-3 mb-7 md:mb-10">
                        <a class="block relative cursor-pointer overflow-hidden rounded-md" target="_blank" href="{{ $bonus['pdf'] }}">
                            <i class="absolute top-1/2 left-1/2 fas fa-cloud-download play-button opacity-0 transition-opacity duration-300" style="margin: -39px;padding: 22px 17px;"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_470,q_auto:best/{{ $bonus['image'] }}"></div>
                        </a>
                        <h5 class="mt-3 mb-1"><strong>{{ $bonus['artist'] }}</strong></h5>
                        <p class="text-navy leading-none">{{ $bonus['song'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center py-14 md:py-24 lg:py-28 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://pianote.s3.amazonaws.com/shop/header-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="w-full max-w-xs md:max-w-md lg:max-w-lg mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1300,q_60,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">
                <h4 class="leading-normal"><em><strong>Like these songs? Learn 450 more <br class="inline sm:hidden">
                            with 500 Songs in 5 Days.</strong><br>
                        <span class="opacity-70">Get your exclusive discount here:</span></em></h4>
                <a class="join my-5 md:my-7" href="/500-songs-chord-discount">500 SONGS IN 5 DAYS &raquo;</a>
                <h4>Just <s class="opacity-70">${{ PianotePrices::$songs500Full }}</s> <strong>$39</strong></h4>
            </div>
        </div>
    </section>
@stop
