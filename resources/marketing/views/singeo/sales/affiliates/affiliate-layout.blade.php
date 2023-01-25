@extends('singeo.sales.subscription')

@section('global-head')
    <title>@yield('name') | Singeo Trial</title>
    <meta property="og:title" content="@yield('name') | Singeo Trial">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}/">
    @parent
@endsection

@section('share-image')
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_540,q_auto:best/https://singeo.s3.amazonaws.com/sales/trials/@yield('url').jpg" style="display: none;">
@endsection

@section('promo-banner')
    <div class="text-white px-4 py-8 md:py-16" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-start text-center" style="max-width: 1050px;">
                <img class="avatar rounded-full border-4 lg:border-8 mx-auto mb-3 sm:mb-0 w-36 md:w-48 lg:w-72" style="border-color:#8300e9; background-color:#8300e9;" src="https://cdn.musora.com/image/fetch/w_540,q_auto:best/https://singeo.s3.amazonaws.com/sales/trials/@yield('url').jpg">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                    <h3 class="text-singeo">YOUR FIRST MONTH IS FREE!</h3>
                    <h6 class="leading-normal my-3 md:my-5">
                        <em>@yield('text')</em>
                    </h6>
                    <a href="/choose-your-trial-month/" class="join smaller methodcta">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
