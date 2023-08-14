@extends('drumeo.sales.subscription')

@section('global-head')
    <title>@yield('name') | Drumeo Trial</title>
    <meta property="og:title" content="@yield('name') | Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}/">
    @parent
@endsection

@section('share-image')
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/trials/@yield('url').jpg" style="display: none;">
@endsection

@section('promo-banner')
    <div class="text-white px-4 sm:px-6 py-6 sm:py-8 relative z-10" style="background-color:#000318;">
        <div class="container max-w-4xl mx-auto">
            <div class="sm:flex mx-auto items-start text-center">
                <img class="rounded-full bg-drumeo border-drumeo border-4 sm:border-8 mx-auto mb-3 sm:mb-0 w-36 sm:w-56 lg:w-72" src="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/trials/@yield('url').jpg">
                <div class="sm:text-left px-2 sm:pr-0 sm:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                    <h3 class="text-drumeo">YOUR FIRST MONTH IS FREE!</h3>
                    <h6 class="leading-normal my-3 sm:my-5">
                        <em>@yield('text')</em>
                    </h6>
                    <a href="/choose-your-trial-month/" class="join drumeo smaller">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
