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
            max-width: 270px;
            margin: 0 auto;
        }
        @media (min-width: 40em) {
            .trial-banner .logo {
                max-width: 500px;
            }
        }
    </style>
    <div class="trial-banner text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto text-center">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/logo.png">
            <h4 class="uppercase text-drumeo my-4"><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</h4>
            <p style="width: 100%;max-width: 650px;"><em>New Drummers Start Here</em> covers your first 90-days on the drums. But what next? Take Drumeo for a test drive with 30 free days of access. It’s the perfect way to build on your new skills and keep your progress going. <em>This page gives you an exclusive 30-day free trial with access to everything Drumeo has to offer.</em></p>
            <a href="/new-drummers-trial-month/" class="join smaller mt-4">Start My Free Trial</a>
        </div>
    </div>
    <a href="/new-drummers-trial-month/" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase">New Drummers Start Here SPECIAL OFFER <br> <strong>YOUR FIRST MONTH IS FREE</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "url" => "/new-drummers-trial-month/" ])
@stop
