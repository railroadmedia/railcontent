@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>9 FREE PLAY-ALONGS | Drumeo</title>
    <meta property="og:title" content="9 FREE PLAY-ALONGS | Drumeo">
    <meta name="description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">
    <meta property="og:description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/free-playalongs/">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="/laravel/public/css/tailwind-helpers.css" rel="stylesheet">
    <link href="{{ asset('/assets/members-area/css/gulp/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/members-area/css/gulp/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <header class="text-white relative overflow-hidden text-center py-24 md:py-44 lg:py-52 px-4 md:px-6" style="background-color:#0c3361;">
        <video class="object-cover h-full w-full absolute top-0 left-0 right-0 bottom-0 z-0" poster="" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/header.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10" style="    background: linear-gradient(to bottom, rgba(18, 80, 161, 0.3) 0%, rgba(5, 46, 87, 0.9) 100%);"></div>
        <div class="container mx-auto relative z-20">
            <img class="h-16 md:h-28 lg:h-36" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/logo.svg" alt="play-along-logo">
            <h6 class="leading-normal my-5">Add your drumming to nine high-quality drumless play-along tracks.</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                        "formName" => 'Free Play-Alongs',
                        "formId" => "Drumeo - Engagement - Trigger - Free Play-Alongs - Web Form",
                        "buttonText" => "Hook Me Up ",
                    ])
            </div>
        </div>
    </header>

    <section class="text-center text-white relative py-8 md:py-14 lg:py-16 px-4" style="background-color:#000a1e;">
        <div class="container mx-auto">
            <h2 class="mb-2 md:mb-3"><strong>Play with REAL music.</strong></h2>
            <h6 class="leading-normal text-light-navy mb-6 md:mb-10">Test your timing, creativity, and groove with 9 FREE drumless play-alongs. You’ll have <br class="hidden md:inline">
                songs for ALL skill levels & handy playback features to make performing easier.</h6>
            <div class="album-grid flex flex-wrap justify-center max-w-2xl lg:max-w-3xl mx-auto">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/thomas-pridgen-hypnotized.png',
                        'descriptions' => 'A heavy prog-rock tune with plenty of room to add your biggest fills.',
                        'artist' => 'Thomas Pridgen',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/kaz-rodriguez-drum-e-o.png',
                        'descriptions' => 'Kaz has created play-alongs for the best drummers in the world -- now it’s your turn!',
                        'artist' => 'Kaz Rodriguez',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/todd-sucherman-just-a-second.png',
                        'descriptions' => 'A pop-rock banger begging for your best back beat to drive the song. ',
                        'artist' => 'Todd Sucherman',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/jost-nickel-the-check-in.png',
                        'descriptions' => 'Contemporary funk with a few odd-time curve balls -- keep your head up!',
                        'artist' => 'Jost Nickel',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Rashid-williams-Rock-out.png',
                        'descriptions' => 'Get creative with this straight-ahead rock jam for all levels.',
                        'artist' => 'Rashid Williams',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Raghav-mehrotra-funky-nasa.png',
                        'descriptions' => 'Put your groove to the test with this mid-tempo funk track.',
                        'artist' => 'Raghav Mehrotra',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/sarah-thawer-straight-reggae.png',
                        'descriptions' => 'Turn the beat around with a stanky reggae groove -- is your crosstick ready?',
                        'artist' => 'Sarah Thawer',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/glen-sobel-7-8-rock.png',
                        'descriptions' => 'A brain-busting odd-time rock song to test your feel & metre.',
                        'artist' => 'Glen Sobel',
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/tony-coleman-shuffle.png',
                        'descriptions' => 'Give your shuffle a workout in this eponymous blues jam.',
                        'artist' => 'Tony Coleman',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="w-1/2 sm:w-1/3 px-2 md:px-3 mb-5 md:mb-7">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md" data-open="signUpModal">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_470,q_auto:best/{{ $bonus['image'] }}"></div>
                        </div>
                        <h5 class="mt-3 mb-1"><strong>w/ {{ $bonus['artist'] }}</strong></h5>
                        <p class="text-light-navy leading-tight">{{ $bonus['descriptions'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center text-white relative py-8 md:py-14 lg:py-16 px-4" style="background-color:#114178;">
        <div class="container mx-auto">
            <h3 class="mb-8 md:mb-12"><strong>Playing along has never been easier.</strong></h3>
            <div class="flex flex-wrap items-center justify-center max-w-4xl mx-auto">
                <div class="w-full md:w-1/2 px-3 lg:px-5 mb-12">
                    <div class="flex">
                        <img class="w-10" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/skills_icon.svg" alt="skill-icon">
                        <div class="text-left pl-5">
                            <h5 class="leading-normal uppercase"><strong>All skill levels.</strong></h5>
                            <p class="leading-tight">Get started with a beginner track OR dive into a more advanced song.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 lg:px-5 mb-12">
                    <div class="flex">
                        <img class="w-10" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/drums_icon.svg" alt="drum-icon">
                        <div class="text-left pl-5">
                            <h5 class="leading-normal uppercase"><strong>Nine drum-less tracks.</strong></h5>
                            <p class="leading-tight">Hear exactly how your playing fits the music with no other drums.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 lg:px-5 mb-12">
                    <div class="flex">
                        <img class="w-10" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/videos_icon.svg" alt="video-icon">
                        <div class="text-left pl-5">
                            <h5 class="leading-normal uppercase"><strong>Pro reference videos.</strong></h5>
                            <p class="leading-tight">Get new ideas watching a professional drummer play the same song.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 lg:px-5 mb-12">
                    <div class="flex">
                        <img class="w-10" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/metronome_icon.svg" alt="metronome-icon">
                        <div class="text-left pl-5">
                            <h5 class="leading-normal uppercase"><strong>Playback tools.</strong></h5>
                            <p class="leading-tight">Add or remove the metronome to help you count out every section.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 lg:px-5 mb-12 md:mb-0">
                    <div class="flex">
                        <img class="w-10" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/songcharts_icon.svg" alt="songchart-icon">
                        <div class="text-left pl-5">
                            <h5 class="leading-normal uppercase"><strong>Follow along in real time.</strong></h5>
                            <p class="leading-tight">You’ll also have downloadable charts to bring to your kit.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 lg:px-5">
                    <div class="flex">
                        <img class="w-10" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/styles_icon.svg" alt="style-icon">
                        <div class="text-left pl-5">
                            <h5 class="leading-normal uppercase"><strong>All different styles.</strong></h5>
                            <p class="leading-tight">Odd-time, reggae, blues - expand your skills into a new genre!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#000a1e",
        "textColor" => "white"
    ])

    <section class="text-white text-center py-10 md:py-28 px-4 md:px-6" style="background: #062342 url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/order_background.jpg) center bottom/cover;">
        <div class="container mx-auto">
            <img class="h-16 md:h-28 lg:h-36" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/logo.svg" alt="free-playalongs-icon">
            <h6 class="leading-normal my-5">Add your drumming to nine high-quality drumless play-along tracks.</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                        "formName" => 'Free Play-Alongs',
                        "formId" => "Drumeo - Engagement - Trigger - Free Play-Alongs - Web Form",
                        "buttonText" => "Hook Me Up ",
                    ])
            </div>
        </div>
    </section>

    <div class="reveal text-center max-w-2xl" id="signUpModal" data-reveal style="background-color: rgb(243, 244, 246);">
        <div class="py-5 px-3 md:px-9 md:py-9">
            <h4 class="leading-normal mb-4"><strong>
                    Add your drumming to nine high-quality <br class="inline md:hidden">
                    drumless play-along tracks.
                </strong></h4>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "formName" => 'Free Play-Alongs',
                "formId" => "Drumeo - Engagement - Trigger - Free Play-Alongs - Web Form",
                "buttonText" => "Hook Me Up ",
                "stacked" => true
            ])
        </div>
    </div>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/assets/members-area/js/gulp/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

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
    <script src="{{ asset('/assets/members-area/js/gulp/navigation-sales.js') }}"></script>
    <script src="{{ asset('/assets/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/assets/members-area/js/gulp/compiled/infusionsoft-tracking.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
