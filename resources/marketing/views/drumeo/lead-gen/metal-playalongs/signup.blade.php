@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>9 Metal Play-Alongs | Drumeo</title>
    <meta property="og:title" content="9 Metal Play-Alongs | Drumeo">
    <meta name="description" content="Add your drumming to nine heavy drum play-along tracks. (FREE).">
    <meta property="og:description" content="Add your drumming to nine heavy drum play-along tracks. (FREE).">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/metal-playalongs/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
    {{--<style>--}}
    {{--.text-icon-wrap {--}}
    {{--color: #fff;--}}
    {{--}--}}

    {{--.text-icon-wrap.active {--}}
    {{--color: #fff;--}}
    {{--opacity: 1 !important;--}}
    {{--}--}}

    {{--.side-pic {--}}
    {{--border: 1px solid #2C465F;--}}
    {{--}--}}

    {{--@media (min-width: 768px) {--}}
    {{--.text-icon-wrap {--}}
    {{--color: inherit;--}}
    {{--}--}}

    {{--.side-pic.active {--}}
    {{--display: block;--}}
    {{--}--}}
    {{--}--}}

    {{--.pic-wrap {--}}
    {{--min-height:382px;--}}
    {{--width:220px--}}
    {{--}--}}

    {{--@media (min-width:768px) {--}}
    {{--.pic-wrap {--}}
    {{--min-height:461px;--}}
    {{--width:280px--}}
    {{--}--}}
    {{--}--}}

    {{--@media (min-width:1024px) {--}}
    {{--.pic-wrap {--}}
    {{--min-height:639px;--}}
    {{--width:400px--}}
    {{--}--}}
    {{--}--}}
    {{--</style>--}}
@stop

@section('content')
    <header class="text-white relative overflow-hidden text-center py-24 md:py-44 lg:py-52 px-4 md:px-6" style="background-color:#0c3361;">
        <video class="object-cover h-full w-full absolute top-0 left-0 right-0 bottom-0 z-0" poster="" src="https://player.vimeo.com/progressive_redirect/playback/699508709/rendition/1080p?loc=external&signature=b31b12063b6ca3878bf439708d5d2fecb06ef246c601f4d8dcbb3f3bf147209e" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10" style="background: linear-gradient(to bottom, rgba(18, 80, 161, 0.3) 0%, rgba(5, 46, 87, 0.9) 100%);"></div>
        <div class="container mx-auto relative z-20">
            <img class="h-16 md:h-28 lg:h-36" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Logo.svg" alt="play-along-logo">
            <h6 class="leading-normal my-5">Add your drumming to nine heavy drumless play-along tracks.</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "formName" => 'Metal Play-Alongs',
                    "formId" => "Drumeo - Engagement - Trigger - Metal Play-Alongs - Web Form",
                    "buttonText" => "Hook Me Up ",
                ])
            </div>
        </div>
    </header>

    <section class="text-center text-white relative py-8 md:py-14 lg:py-16 px-4" style="background-color:#000a1e;">
        <div class="container mx-auto">
            <h2 class="mb-2 text-xl md:mb-3 md:text-3xl lg:text-4xl"><strong>Play with REAL music.</strong></h2>
            <h6 class="leading-normal text-gray-400 mb-6 md:mb-10">
                Test your timing, creativity, and groove with 9 FREE drumless metal play-alongs. You’ll have <br class="hidden md:inline">
                songs in a variety of styles and skill levels PLUS handy playback features to make performing easier.</h6>
            <div class="album-grid flex flex-wrap justify-center max-w-2xl lg:max-w-3xl mx-auto">
                @php
                    $bonuses = [
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/The+Marzear+Labyrinth.jpg',
                            'descriptions' => 'Not for the faint of heart, Marzear Labyrinth is your blast beat main boss.',
                            'artist' => 'Derek Roddy',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Nightmares.jpg',
                            'descriptions' => 'A heavy homage to metal legends, this track even has room for your own solo.',
                            'artist' => 'Jared Falk',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Double+Bass.jpg',
                            'descriptions' => 'Yep, no surprises here. This song is the ultimate workout for your feet.',
                            'artist' => 'Alex Rüdinger',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Basic+Metal.jpg',
                            'descriptions' => 'The perfect play-along to jumpstart your metal drumming journey.',
                            'artist' => 'Mike Michalkow',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Hypnotized.jpg',
                            'descriptions' => 'A heavy prog-metal tune with plenty of room to add your biggest fills.',
                            'artist' => 'Thomas Pridgen',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Resurrection+Through+Fire.jpg',
                            'descriptions' => 'The ultimate test for metal drummers: odd-time, double-kick, and blast beats.',
                            'artist' => 'Jason Bittner',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Opus+I+Excerpt%2C+No.5.jpg',
                            'descriptions' => 'A symphony of heavy drumming, this tune begs for your best prog drum beats.',
                            'artist' => 'Julia Geaman',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Brotherhood+Of+The+Snake.jpg',
                            'descriptions' => 'Keep your sweat towel handy. Gene Hoglan takes you for the ultimate thrash workout.',
                            'artist' => 'Gene Hoglan',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Teratogenesis.jpg',
                            'descriptions' => 'A song as complicated as its name - get ready to push your technical limits.',
                            'artist' => 'Ash Pearson',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="w-1/2 sm:w-1/3 px-2 md:px-3 mb-5 md:mb-7">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md" data-open="signUpModal">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_470,q_auto:best/{{ $bonus['image'] }}"></div>
                        </div>
                        <h5 class="mt-2 mb-1 md:text-lg lg:text-xl"><strong>w/ {{ $bonus['artist'] }}</strong></h5>
                        <p class="text-gray-400 leading-tight">{{ $bonus['descriptions'] }}</p>
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
                            <p class="leading-tight">Odd-time, thrash, double-bass - challenge your skills in any style!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    @include('drumeo.lead-gen.partials.screen-slider',[--}}
{{--        "screens" => [--}}
{{--           [--}}
{{--               "img" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/All+Skill+Levels.jpg",--}}
{{--               "first" => true,--}}
{{--           ],--}}
{{--           [--}}
{{--               "img" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/pro+reference+video.jpg",--}}
{{--           ],--}}
{{--           [--}}
{{--               "img" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/playback+tools.jpg",--}}
{{--           ],--}}
{{--           [--}}
{{--               "img" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/drumless.jpg",--}}
{{--           ],--}}
{{--           [--}}
{{--               "img" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/follow+in+real+time.jpg",--}}
{{--           ],--}}
{{--           [--}}
{{--               "img" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/different+styles.jpg",--}}
{{--           ],--}}
{{--        ],--}}
{{--        "features" => [--}}
{{--            [--}}
{{--                "icon" => "fa-solid fa-screwdriver-wrench",--}}
{{--                "title" => "All skill levels.",--}}
{{--                "desc" => "Get started with a beginner track OR dive into a more advanced song.",--}}
{{--                "first" => true--}}
{{--            ],--}}
{{--            [--}}
{{--                "icon" => "fa-solid fa-tv-music",--}}
{{--                "title" => "Pro reference videos.",--}}
{{--                "desc" => "Get new ideas watching a professional drummer play the same song.",--}}
{{--            ],--}}
{{--            [--}}
{{--                "icon" => "icon-metronome",--}}
{{--                "title" => "Playback tools.",--}}
{{--                "desc" => "Add or remove the metronome to help you count out every section.",--}}
{{--            ],--}}
{{--            [--}}
{{--                "icon" => "fa-solid fa-drum",--}}
{{--                "title" => "Nine drum-less tracks.",--}}
{{--                "desc" => "Hear exactly how your playing fits the music with no other drums.",--}}
{{--            ],--}}
{{--            [--}}
{{--                "icon" => "fa-solid fa-file-music",--}}
{{--                "title" => "Follow along in real time.",--}}
{{--                "desc" => "You’ll also have downloadable charts to bring to your kit.",--}}
{{--            ],--}}
{{--            [--}}
{{--                "icon" => "fa-solid fa-list-music",--}}
{{--                "title" => "All different styles.",--}}
{{--                "desc" => "Odd-time, thrash, double-bass - challenge your skills in any style!",--}}
{{--            ],--}}
{{--        ],--}}
{{--    ])--}}

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#000a1e",
        "textColor" => "white"
    ])

    <section class="text-white text-center py-10 md:py-28 px-4 md:px-6" style="background: #062342 url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/order_background.jpg) center bottom/cover;">
        <div class="container mx-auto">
            <img class="h-16 md:h-28 lg:h-36" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Logo.svg" alt="metal-playalongs-icon">
            <h6 class="leading-normal my-5">Add your drumming to nine high-quality drum play-along tracks.</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                        "formName" => 'Metal Play-Alongs',
                        "formId" => "Drumeo - Engagement - Trigger - Metal Play-Alongs - Web Form",
                        "buttonText" => "Hook Me Up ",
                    ])
            </div>
        </div>
    </section>

    <div class="reveal text-center max-w-2xl" id="signUpModal" data-reveal style="background-color: rgb(243, 244, 246);">
        <div class="py-5 px-3 md:px-9 md:py-9">
            <h4 class="leading-normal mb-4 md:text-xl lg:text-2xl"><strong>
                    Add your drumming to nine high-quality <br class="inline md:hidden">
                    drumless play-along tracks.
                </strong></h4>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "formName" => 'Metal Play-Alongs',
                "formId" => "Drumeo - Engagement - Trigger - Metal Play-Alongs - Web Form",
                "buttonText" => "Hook Me Up ",
                "stacked" => true
            ])
        </div>
    </div>
@stop

@section('scripts')
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--// song point cycle--}}
            {{--var $songPoint = $('.side-pic.songs'),--}}
                {{--$songPointToggle = $('.text-icon-wrap.songs'),--}}
                {{--currentSongPoint = 0,--}}
                {{--updateIndex = function (currentSongPoint) {--}}
                    {{--$songPoint.removeClass('active');--}}
                    {{--$songPointToggle.removeClass('active');--}}

                    {{--$songPoint.eq(currentSongPoint).addClass('active');--}}
                    {{--$songPointToggle.eq(currentSongPoint).addClass('active');--}}
                {{--},--}}
                {{--autoplaySongPoints = setInterval(function () {--}}
                    {{--if(currentSongPoint < 4){--}}
                        {{--currentSongPoint++;--}}
                        {{--updateIndex(currentSongPoint);--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--currentSongPoint = 0;--}}
                        {{--updateIndex(currentSongPoint);--}}
                    {{--}--}}
                {{--}, 10000);--}}

            {{--$songPoint.first().addClass('active');--}}
            {{--$songPointToggle.first().addClass('active');--}}
            {{--$songPointToggle.on('click', function () {--}}
                {{--updateIndex($songPointToggle.index($(this)));--}}
                {{--currentSongPoint = $songPointToggle.index($(this));--}}
                {{--clearInterval(autoplaySongPoints);--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@stop
