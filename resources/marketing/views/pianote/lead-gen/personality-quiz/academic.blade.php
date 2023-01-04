@extends('pianote._partials.global-layout')

@section('global-head')
    <title>You're the Explorer | Pianote</title>
    <meta property="og:title" content="You're the Explorer | Pianote">

    <meta name="description" content="You hold a deep admiration for the great composers and classics.">
    <meta property="og:description" content="You hold a deep admiration for the great composers and classics.">

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/Q-Academic.png" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <!-- Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>

    </style>
@stop

@section('global-body')
    @include('pianote._partials._nav', [
        "subscriptionVersion" => true
    ])

    <section class="py-12 md:py-20 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg')">
        <div class="max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-6 lg:px-0">
            <img class="h-40 md:h-72 lg:h-80 mb-2" src="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/Q-Academic.png" alt="academic">
            <h2 class="font-extrabold mb-6">You're the Academic!</h2>
            <p class="mb-4">
                You’re the Academic! You hold a deep admiration for the great composers and classics. And while you may find improvising more challenging, you feel at home with sheet music and can creatively interpret what’s written. You may also be curious about music history, you practice diligently, and it shows! <br><br>
                Nerd out on the <a href="/blog/famous-classical-piano-songs"><u>most famous classical pieces</u></a> of all time. <br>Or, level up your playing by trying Pianote for free.
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

    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
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

