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
            height:auto;
            max-width: 200px;
            margin: 0 auto;
        }
        @media (min-width: 40em) {
            .trial-banner .logo {
                max-width: 300px;
            }
        }
    </style>
    <div class="trial-banner text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto text-center">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/promos/april-fools/melodics.png">
            <h4 class="uppercase text-drumeo my-4"><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</h4>
            <p style="width: 100%;max-width: 650px;"><strong>Melodics Drummers:</strong> We love technology. We also think there’s a ton of value in studying with the best drummers in the world and having real support from real teachers. And that’s why Melodics + Drumeo is the perfect combination.
                <br><br>
                So we wanted to welcome you with an extended 30-day trial to Drumeo where you’ll get everything you need to reach your drumming goals. Scroll around this page to see what it’s all about -- and if you think it looks good, we hope you’ll join us.</p>
            <a href="/melodics-trial/" class="join smaller mt-4">Start My Free Trial</a>
        </div>
    </div>
    <a href="/melodics-trial/" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase">Melodics Drummers SPECIAL OFFER <br> <strong>YOUR FIRST MONTH IS FREE</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "url" => "/melodics-trial/" ])
@stop
