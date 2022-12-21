@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/trial/">
@endsection

@php $joinUrl = '/choose-your-trial/' @endphp

@section('start-button', '/choose-your-trial/')

@section('promo-banner')
    <div class="coach-trial-banner text-white text-center px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="px-2 mx-auto" style="max-width: 650px;">
                <h2 class="text-drumeo"><strong>Your first week is free.</strong></h2>
                <h6 class="leading-normal my-3 md:my-5">Your journey to becoming a better drummer starts today! Try Drumeo free for a week and get everything you need to reach your drumming goals. </h6>
                <a href="/choose-your-trial/" class="join smaller blue">Get Started</a>
            </div>
        </div>
    </div>
    <a href="/choose-your-trial/" style="background:linear-gradient(to bottom, #022040, #01050f);"
            class="promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap text-white bg-cover bg-center shadow-md py-1 hover:text-gray-100 z-0 mx-auto -mt-10 text-xs">
        <div class="container mx-auto relative">
            <div class="inline-block align-middle text-center">
                {{--<img class="inline-block align-middle mr-2 h-8" src="https://drumeo-assets.s3.amazonaws.com/promos/september/logo.svg">--}}
                <p class="leading-none inline-block align-middle mx-auto text-xs">
                    <strong class="uppercase text-drumeo">Your first <br>week is free.</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "sevenDay" => true, "url" => "/choose-your-trial/" ])
@stop
