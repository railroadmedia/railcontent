@extends('guitareo.sales.standard-layout', [
    "trialVersion" => true
])
@section('head-includes')
    @parent

    <title>@yield('name') | Guitareo Trial</title>
    <meta property="og:title" content="@yield('name') | Guitareo Trial">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}/">
@endsection

@section('share-image')
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_540,q_auto:best/https://guitareo.s3.amazonaws.com/sales/trials/@yield('url').jpg" style="display: none;">
@endsection

@section('promo-banner')
    <div class="text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-start text-center" style="max-width: 1050px;">
                <img class="avatar rounded-full border-4 lg:border-8 mx-auto mb-3 sm:mb-0 w-36 md:w-48 lg:w-72" style="border-color:#00C9AC; background-color:#00C9AC;" src="https://cdn.musora.com/image/fetch/w_540,q_auto:best/https://guitareo.s3.amazonaws.com/sales/trials/@yield('url').jpg">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                    <h3 class="text-guitareo">YOUR FIRST MONTH IS FREE!</h3>
                    <h6 class="leading-normal my-3 md:my-5">
                        <em>@yield('text')</em>
                    </h6>
                    <a href="/affiliate-trial/" class="join smaller coaches methodcta">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>

    <a href="/affiliate-trial/" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase"><strong>@yield('name') FANS</strong><br>
                    <span class="text-coaches">YOUR FIRST MONTH IS FREE!</span></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor"></div>
    @include('guitareo.sales.partials._final-trial', [ "url" => "/affiliate-trial/" ])
@stop