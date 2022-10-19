@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/trial/">
    <meta name="robots" content="noindex">
@endsection

@php $joinUrl = '/choose-your-trial-month/' @endphp

@section('start-button', '/choose-your-trial-month/')

@section('promo-banner')
    <div class="coach-trial-banner text-white text-center px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="px-2 mx-auto" style="max-width: 670px;">
                <h2 class="text-drumeo"><strong>Your first month is free.</strong></h2>
                <h6 class="leading-normal my-3 md:my-5">Your journey to becoming a better drummer starts today! Try Drumeo free for a month and get everything you need to reach your drumming goals. </h6>
                <a href="/choose-your-trial-month/" class="join smaller blue">Get Started</a>
            </div>
        </div>
    </div>
    <a href="/choose-your-trial-month/" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase text-drumeo"><strong>Your first month<br> is free.</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "url" => "/choose-your-trial-month/" ])
@stop
