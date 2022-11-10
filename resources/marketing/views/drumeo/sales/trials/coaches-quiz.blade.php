@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/trial/">
    <meta name="robots" content="noindex">
@endsection

@section('promo-banner')
    <style>
        .trial-banner .logo {
            height:27px;
            margin: 0 auto;
        }
        @media (min-width: 40em) {
            .trial-banner .logo {
                height:50px;
            }
        }
    </style>
    <div class="trial-banner text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto text-center">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
            <img class="logo" style="filter:invert(1)" src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg">
            <h4 class="uppercase text-coaches my-4"><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</h4>
            <p style="width: 100%;max-width: 650px;">Thanks for taking the DrumeCOACHES quiz! Now it’s time to join your perfect coach inside Drumeo.
                <br><br>
                At the bottom of this page, you’ll get an exclusive 30-day trial to Drumeo -- where you can try out ALL the coaching sessions, lessons, and song breakdowns inside the members’ area. Click below to get started.</p>
            <a href="/coaches-quiz-trial/" class="join smaller mt-4">Start My Free Trial</a>
        </div>
    </div>
    <a href="/coaches-quiz-trial/" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase">DRUMEO COACHES SPECIAL OFFER <br> <strong>YOUR FIRST MONTH IS FREE</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "url" => "/coaches-quiz-trial/" ])
@stop
