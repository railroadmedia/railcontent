@extends('pianote.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>@yield('name') | Pianote Trial</title>
    <meta property="og:title" content="@yield('name') | Pianote Trial">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}/">
@endsection

@section('share-image')
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_540,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/@yield('url').jpg" style="display: none;">
@endsection

@section('sticky-bar')
    <div class="h-10 relative w-full block bg-black"></div>
    <a href="/affiliate-trial/"
            class="promo-banner bg-black block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap text-white bg-cover bg-center shadow-md py-1 hover:text-gray-100 z-0 mx-auto -mt-10 text-xs">
        <div class="container mx-auto relative">
            <div class="inline-block align-middle text-center">
                <p class="uppercase leading-none"><strong>@yield('name') FANS</strong><br>
                    <span class="text-pianote">YOUR FIRST MONTH IS FREE!</span></p>
            </div>
        </div>
    </a>
@endsection

@section('promo-banner')
    <div class="text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-start text-center" style="max-width: 1050px;">
                <img class="avatar rounded-full border-4 lg:border-8 mx-auto mb-3 sm:mb-0 w-36 md:w-48 lg:w-72" style="border-color:#F61A30; background-color:#F61A30;" src="https://cdn.musora.com/image/fetch/w_540,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/@yield('url').jpg">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                    <h3 class="text-pred">YOUR FIRST MONTH IS FREE!</h3>
                    <h6 class="leading-normal my-3 md:my-5">
                        <em>@yield('text')</em>
                    </h6>
                    <a href="/affiliate-trial/" class="join smaller coaches methodcta">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('final')
    @include('pianote.sales.trials._final-trial', [ "url" => "/affiliate-trial/" ])
@stop
