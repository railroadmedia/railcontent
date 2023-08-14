@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>50 Free Chord Charts | Pianote</title>
    <meta property="og:title" content="50 Free Chord Charts | Pianote">

    <meta name="description" content="Here are 50 chord charts for you to download, print, and play. No reading music required!">
    <meta property="og:description" content="Here are 50 chord charts for you to download, print, and play. No reading music required!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/50-chord-charts/">
@stop
@section('head')
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-50-charts.css') }}" rel="stylesheet">
@endsection
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
@section('page-body')
    <header class="text-white text-center lg:text-left py-7 md:py-12 lg:py-20 px-6 md:px-4 lg:px-6" style="background: #06091a url(https://www.musora.com/musora-cdn/image/width=2000,q_60,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/header-bg.jpg) center bottom/cover;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap justify-center items-center md:items-center">
                <div class="w-8/12 sm:w-6/12 lg:w-5/12 sm:order-1 text-right sm:pl-4 lg:pl-0">
                    <div class="relative inline-block align-bottom z-0 w-full max-w-xs lg:max-w-sm">
                        <div class="absolute rounded-2xl overflow-hidden" style="top: 1.5%;left: 1.5%;right: 1.5%;bottom: 6.5%;"><video src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/header-compressed.mp4" muted autoplay loop playsinline></video></div>
                        <img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/tablet.svg">
                    </div>
                </div>
                <div class="w-full sm:w-6/12 lg:w-7/12 mt-5 sm:mt-0 {{--lg:mt-14--}}">
                    <img class="mb-4 lg:mb-6 h-20 md:h-28 lg:h-36" src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/logo.svg">
                    <h4><strong>Play the songs you love, easier.</strong></h4>
                    <h6 class="my-3 md:my-4 lg:my-6 leading-tight">Enter your email to get 50 chord charts<br> delivered to your inbox for FREE.</h6>
                    <div class="mx-auto sm:mx-0 text-center" style="max-width:470px">
                        @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => '50 Chord Charts',
                            "formId" => "Pianote - Engagement - Trigger - 50 Chord Charts - Web Form",
                            "buttonText" => "Send My Charts ",
                            "stacked" => true
                        ])
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#000318;">
        <div class="container mx-auto">
            <h4 class="mb-4 md:mb-5">Say hello to <strong>your instant setlist.</strong></h4>
            <p class="leading-normal text-navy mb-6 md:mb-12 lg:mb-16">Songs are why you play the piano. So here are 50 chord charts for <br class="hidden md:inline">
                you to download, print, and play. No reading music required!</p>
            <div class="album-grid flex flex-wrap justify-center">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/1-alloutoflove-airsupply.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/all-out-of-love-air-supply.pdf',
                        'song' => 'All Out Of Love',
                        'artist' => 'Air Supply',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/2-noone-aliciakeys.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/no-one-alicia-keys.pdf',
                        'song' => 'No One',
                        'artist' => 'Alicia Keys',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/3-whenimgone-annakendrick.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/when-im-gone-anna-kendrick.pdf',
                        'song' => 'When I’m Gone',
                        'artist' => 'Anna Kendrick',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/4-letitbe-thebeatles.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/let-it-be-the-beatles.pdf',
                        'song' => 'Let It Be',
                        'artist' => 'The Beatles',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/5-therose-bettemidler.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/the-rose-bette-midler.pdf',
                        'song' => 'The Rose',
                        'artist' => 'Bette Midler',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/6-iwashere-beyonce.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/i-was-here-beyonce.pdf',
                        'song' => 'I Was Here',
                        'artist' => 'Beyonce',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/7-oceaneyes-billieeilish.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/i-was-here-beyonce.pdf',
                        'song' => 'Ocean Eyes',
                        'artist' => 'Billie Eilish',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/8-pianoman-billyjoel.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/piano-man-billy-joel.pdf',
                        'song' => 'Piano Man',
                        'artist' => 'Billy Joel',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/9-justthewayyouare-brunomars.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/just-the-way-you-are-bruno-mars.pdf',
                        'song' => 'Just The Way You Are',
                        'artist' => 'Bruno Mars',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/10.youresovain-carlysimon.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/youre-so-vain-carly-simon.pdf',
                        'song' => 'You’re So Vain',
                        'artist' => 'Carly Simon',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/11.becauseyoulovedme-celinedion.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/because-you-loved-me-celine-dion.pdf',
                        'song' => 'Because You Loved Me',
                        'artist' => 'Celine Dion',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/12.beautiful-christinaaguilera.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/beautiful-christina-aguilera.pdf',
                        'song' => 'Beautiful',
                        'artist' => 'Christina Aguilera',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/13.athousandyears-christinaperri.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/a-thousand-years-christina-perri.pdf',
                        'song' => 'A Thousand Years',
                        'artist' => 'Christina Perri',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/14.bubblycolbiecaillat.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/bubbly-colbie-caillat.pdf',
                        'song' => 'Bubbly',
                        'artist' => 'Colbie Caillat',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/15.thescientist-coldplay.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/the-scientist-coldplay.pdf',
                        'song' => 'The Scientist',
                        'artist' => 'Coldplay',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/16.thankyou-dido.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/thank-you-dido.pdf',
                        'song' => 'Thank You',
                        'artist' => 'Dido',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/17.perfect-edsheeran.jpg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/perfect-ed-sheeran.pdf',
                        'song' => 'Perfect',
                        'artist' => 'Ed Sheeran',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/18.candleinthewind-eltonjohn.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/candle-in-the-wind-elton-john.pdf',
                        'song' => 'Candle In The Wind',
                        'artist' => 'Elton John',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/19.1234-feist.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/1-2-3-4-feist.pdf',
                        'song' => '1234',
                        'artist' => 'Feist',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/20.overmyhead(cablecar)-thefray.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/over-my-head-cable-car-the-fray.pdf',
                        'song' => 'Over My Head (Cable Car)',
                        'artist' => 'The Fray',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/21.signofthetimes-harrystyles.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/sign-of-the-times-harry-styles.pdf',
                        'song' => 'Sign Of The Times',
                        'artist' => 'Harry Styles',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/22.mightytosave-hillsong.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/mighty-to-save-hillsong-worship.pdf',
                        'song' => 'Mighty To Save',
                        'artist' => 'Hillsong',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/23.amazinggrace-hymn.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/amazing-grace-hymn.pdf',
                        'song' => 'Amazing Grace',
                        'artist' => 'Hymn',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/24.imyours-jasonmraz.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/im-yours-jason-mraz.pdf',
                        'song' => 'I’m Yours',
                        'artist' => 'Jason Mraz',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/25.hands-jewel.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/hands-jewel.pdf',
                        'song' => 'Hands',
                        'artist' => 'Jewel',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/26.allofme-johnlegend.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/all-of-me-john-legend.pdf',
                        'song' => 'All Of Me',
                        'artist' => 'John Legend',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/27.hurt-johnnycash.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/hurt-johnny-cash.pdf',
                        'song' => 'Hurt',
                        'artist' => 'Jonny Cash',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/28.river-jonimitchell.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/river-joni-mitchell.pdf',
                        'song' => 'River',
                        'artist' => 'Joni Mitchell',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/29.youraisemeup-joshgroban.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/you-raise-me-up-josh-groban.pdf',
                        'song' => 'You Raise Me Up',
                        'artist' => 'Josh Groban',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/30.dontstopbelievin-journey.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/dont-stop-believin-journey.pdf',
                        'song' => 'Don’t Stop Believin’',
                        'artist' => 'Journey',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/31.overtherainbow-judygarland.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/over-the-rainbow-judy-garland.pdf',
                        'song' => 'Over The Rainbow',
                        'artist' => 'Judy Garland',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/32.firework-katyperry.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/firework-katy-perry.pdf',
                        'song' => 'Firework',
                        'artist' => 'Katy Perry',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/33.breakaway-kellyclarkson.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/breakaway-kelly-clarkson.pdf',
                        'song' => 'Breakaway',
                        'artist' => 'Kelly Clarkson',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/34.amillionreasons-ladygaga.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/a-million-reasons-lady-gaga.pdf',
                        'song' => 'A Million Reasons',
                        'artist' => 'Lady Gaga',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/35.yousay-laurendaigle.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/you-say-lauren-daigle.pdf',
                        'song' => 'You Say',
                        'artist' => 'Lauren Daigle',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/36.hello-lionelrichie.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/hello-lionel-richie.pdf',
                        'song' => 'Hello',
                        'artist' => 'Lionel Richie',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/37.whatawonderfulworld-louisarmstrong.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/what-a-wonderful-world-louis-armstrong.pdf',
                        'song' => 'What A Wonderful World',
                        'artist' => 'Louis Armstrong',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/38.scar-missyhiggins.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/scar-missy-higgins.pdf',
                        'song' => 'Scar',
                        'artist' => 'Missy Higgins',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/39.apologize-onerepublic.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/apologize-one-republic.pdf',
                        'song' => 'Apologize',
                        'artist' => 'OneRepublic',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/40.creep-radiohead.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/creep-radiohead.pdf',
                        'song' => 'Creep',
                        'artist' => 'Radiohead',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/41.killingmesoftly-robertaflack.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/killing-me-softly-roberta-flack.pdf',
                        'song' => 'Killing Me Softly',
                        'artist' => 'Roberta Flack',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/42.staywithme-samsmith.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/stay-with-me-sam-smith.pdf',
                        'song' => 'Stay With Me',
                        'artist' => 'Sam Smith',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/43.gravity-sarabareilles.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/gravity-sara-bareilles.pdf',
                        'song' => 'Gravity',
                        'artist' => 'Sara Bareilles',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/44.iwillrememberyou-sarahmclachlan.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/i-will-remember-you-sarah-mclachlan.pdf',
                        'song' => 'I Will Remember You',
                        'artist' => 'Sarah McLachlan',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/45.mercy-shawnmendes.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/mercy-shawn-mendes.pdf',
                        'song' => 'Mercy',
                        'artist' => 'Shawn Mendes',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/46.lovestory-taylorswift.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/love-story-taylow-swift.pdf',
                        'song' => 'Love Story',
                        'artist' => 'Taylor Swift',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/47.dropsofjupiter(tellme)-train.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/drops-of-jupiter-tell-me-train.pdf',
                        'song' => 'Drops Of Jupiter (Tell Me)',
                        'artist' => 'Train',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/48.riptide-vancejoy.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/riptide-vance-joy.pdf',
                        'song' => 'Riptide',
                        'artist' => 'Vance Joy',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/49.athousandmiles-vanessacarlton.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/a-thousand-miles-vanessa-carlton.pdf',
                        'song' => 'A Thousand Miles',
                        'artist' => 'Vanessa Carlton',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/albums/50.seeyouagain-wizkhalifa.jpeg',
                        'pdf' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/pdf/see-you-again-wiz-khalifa.pdf',
                        'song' => 'See You Again',
                        'artist' => 'Wiz Khalifa',
                        ]
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 px-2 md:px-3 mb-7 md:mb-10">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md" data-open="signUpModal">
                            <i class="absolute top-1/2 left-1/2 fas fa-cloud-download play-button opacity-0 transition-opacity duration-300" style="margin: -39px;padding: 22px 17px;"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=470,quality=95/{{ $bonus['image'] }}"></div>
                        </div>
                        <h5 class="mt-3 mb-1"><strong>{{ $bonus['artist'] }}</strong></h5>
                        <p class="text-navy leading-none">{{ $bonus['song'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('pianote.lead-gen.partials.quick-questions', [
        'textColor' => 'white',
        'bgColor' => 'linear-gradient(to bottom, #010317, #071336)'
    ])

    <section class="text-center py-14 md:py-16 lg:py-20 text-white bg-center bg-cover lazyload" style="background-color:#030618;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/final-bg.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="mb-6 h-20 md:h-24" src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/50-chord-charts/logo.svg">
                <h4><strong>Play the songs you love, easier.</strong></h4>
                <h6 class="my-5 lg:my-6 leading-normal">Enter your email to get 50 chord charts<br> delivered to your inbox for FREE.</h6>
                <div class="mx-auto" style="max-width:700px">
                    @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - 50 Chord Charts - Web Form",
                        "formName" => '50 Chord Charts',
                        "buttonText" => 'Send My Charts '
                    ])
                </div>
            </div>
        </div>
    </section>

    <div class="reveal text-center" id="signUpModal" data-reveal style="max-width:560px;background-color: rgb(243, 244, 246);">
        <div class="py-5 px-3 md:px-9 md:py-9">
            <h4 class="leading-normal mb-4"><strong>Enter your email to get 50 chord charts<br class="hidden md:inline"> delivered to your inbox for FREE.</strong></h4>
            @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => "Pianote - Engagement - Trigger - 50 Chord Charts - Web Form",
                "formName" => '50 Chord Charts',
                "stacked" => true
            ])
        </div>
    </div>
@stop
