@extends('singeo.sales.subscription')

@section('global-head')
    <title>@yield('name') | Singeo Trial</title>
    <meta property="og:title" content="@yield('name') | Singeo Trial">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}/">
    @parent
@endsection

@section('share-image')
    @hasSection('url')
        <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/trials/@yield('url').jpg" style="display: none;">
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/share-image-singeo.webp"/>
    @endif
@endsection

@section('top-bar')
    <div class="px-4 sm:px-6 py-6 sm:py-8 relative z-10 bg-cover bg-center @isset($lightBackground) text-black @else text-white @endif "
        @isset($background)
            style="background: {{ $background }};"
        @else
            style="background-color:#000318;"
        @endif
    >
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap mx-auto items-start lg:items-center text-center justify-center">
                @isset($video)
                    <div class="w-36 sm:w-56 lg:w-72 mx-0 mb-3 sm:mb-0 flex-shrink-0">
                        <div class="aspect-1:1 w-full relative rounded-xl overflow-hidden">
                            <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/{{ $video }}" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>
                        </div>
                    </div>
                @else
                    @isset($img2)
                        <img class="rounded-xl mx-auto mb-3 sm:mb-0 w-36 sm:w-56 lg:w-72" src="{{ $img2 }}">
                    @else
                        <img class="rounded-full bg-singeo border-singeo border-4 sm:border-8 mx-auto mb-3 sm:mb-0 w-36 sm:w-56 lg:w-72" src="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/trials/@yield('url').jpg">
                    @endif
                @endif
                <div class="sm:text-left px-2 sm:pr-0 sm:pl-7 lg:pl-10">
                    @isset($headline)
                        <h2 class=""><strong>{!!  $headline  !!}</strong></h2>
                    @else
                        <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                        <h3 class="text-singeo">YOUR FIRST MONTH IS FREE!</h3>
                    @endif
                    <h6 class="leading-normal my-3 sm:my-5">
                        @yield('text')
                    </h6>
                    <a href="/choose-your-trial-month/" class="join singeo smaller">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
