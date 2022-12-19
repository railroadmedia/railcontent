@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>@yield('name') | Drumeo Trial</title>
    <meta property="og:title" content="@yield('name') | Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}/">
    <meta name="robots" content="noindex">
@endsection

@php $joinUrl = '/coach-trial/' @endphp

@section('share-image')
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coach-share-image/@yield('url').jpg" style="display: none;">
@endsection

@section('start-button', '/coach-trial/')

@section('promo-banner')
    <style>
        .coach-trial-banner .avatar {
            max-width: 130px;
            margin: 0 auto 15px;
            border-radius:500px;
            border:7px solid #fe9f13;
        }
        @media (min-width: 40em) {
            .coach-trial-banner .avatar {
                max-width: 170px;
                margin: 0 auto;
            }
        }
        @media (min-width: 64em) {
            .coach-trial-banner .avatar {
                max-width: 250px;
                border-width:12px;
            }
        }
    </style>
    <div class="coach-trial-banner text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-center text-center" style="max-width: 1050px;">
                <img class="w-full avatar" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/avatar/@yield('url').jpg">
                <div class="md:text-left px-2 md:pl-8 lg:pl-10">
                    <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                    <h3 class="text-coaches">YOUR FIRST MONTH IS FREE!</h3>
                    <h6 class="leading-normal my-3 md:my-5">Join @yield('name') inside Drumeo -- where you’ll get @yield('pronoun') weekly DrumeoCOACHES live events and personal feedback to support your drumming goals. This page gives you an exclusive 30-day free trial with access to everything Drumeo has to offer.</h6>
                    <a href="/coach-trial/" class="join smaller coaches">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
    <a href="/coach-trial/" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase"><strong>@yield('name') FANS</strong><br>
                    <span class="text-coaches">YOUR FIRST MONTH IS FREE!</span></p>
            </div>
        </div>
    </a>
@endsection

@section('comparison')
    <td><strong>FREE TRIAL</strong><br>THEN <s>${{ Prices::$drumeoEdgeAnnualFull }}</s> $200/YR</td>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "url" => "/coach-trial/" ])
@stop
