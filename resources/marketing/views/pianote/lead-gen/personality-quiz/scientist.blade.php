@extends('pianote._partials.global-layout')

@section('global-head')
    <title>You're the Scientist | Pianote</title>
    <meta property="og:title" content="You're the Scientist | Pianote">

    <meta name="description" content="You have an analytical mind and you love looking for patterns.">
    <meta property="og:description" content="You have an analytical mind and you love looking for patterns.">

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/Q-SCIENTIST.png" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    @include('_partials.layout._fonts')
    <!-- Tailwind -->
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>

    </style>
@stop

@section('global-body')
    @include('pianote._partials._nav')

    <section class="py-12 md:py-20 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg')">
        <div class="max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-6 lg:px-0">
            <img class="h-40 md:h-72 lg:h-80 mb-2" src="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/Q-SCIENTIST.png" alt="scientist">
            <h2 class="font-extrabold mb-6">You're the Scientist!</h2>
            <p class="mb-4">
                You’re the Scientist! You have an analytical mind and you love looking for patterns. Music theory fascinates you, and you love discussing the nuts and bolts that make a song incredible. You may be drawn to classical or jazz, and you’re looking to apply your theoretical knowledge to practice. <br><br>
                How many chords do you know? Check your knowledge of <a href="/blog/how-to-play-piano-chords/"><u>all chord types</u></a>, from majors and minors to 7th chords, altered chords, and extensions. Or try Pianote for free.
            </p>
            <a href="/trial" class="join mb-4 smaller">TRY PIANOTE FOR 7 DAYS</a>
            <h5 class="mb-4"><strong>Share your result</strong></h5>
            <div >
                <a class="inline-block mr-2" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=https%3A//www.pianote.com/{{ Request::path() }}">
                    <div class="border-2 rounded-full w-8 h-8 flex justify-center items-center border-gray-400 text-gray-400">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                </a>
                <a class="inline-block text-gray-400">
                    <div id="copyClipboard" data-clipboard-text="https://www.pianote.com/{{ Request::path() }}" class="cursor-pointer border-2 rounded-full w-8 h-8 flex justify-center items-center border-gray-400">
                        <i class="fas fa-link"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <a href="/personality-quiz" class="px-6 py-5 bg-pianote text-white text-center inline-block w-full">
        <h4><strong>Take the Quiz &raquo;</strong></h4>
    </a>

    @include("pianote._partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js" defer></script>
    <script>
        $(document).ready(function ($) {
            var clipboard = new ClipboardJS('#copyClipboard');

            clipboard.on('success', function(e) {
                document.getElementById('copyClipboard').className += ' bg-green-400 text-black';
            });
        });
    </script>
@endsection

