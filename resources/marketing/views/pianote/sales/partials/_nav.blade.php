<nav class="top-bar">
    <div class="logo">
        <a href="{{ get_legacy_brand_base_url('pianote') }}" title="Go to the home page">
            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png" alt="Pianote">
        </a>
    </div>

    <div class="menu-toggle @if(!empty($hideMenu)) opacity-0 px-0.5 @endif" role="button" aria-label="Menu Toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    @if(!empty($checkoutVersion))
        <div class="button-wrap text-white">
            <a href="{{ get_legacy_brand_base_url('pianote') }}/shop" class="join outline-button" role="button" aria-label="Shop at Pianote shop">Shop</a>
        </div>
    @endif
    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="{{ get_legacy_brand_base_url('pianote').'/shop' }}" class="join outline-button hover:no-underline" role="button" aria-label="Shop at Pianote shop">Shop</a>

            <nav-cart-button
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url=''
                checkout-url='/order/pianote'
                api-domain-url=''
            ></nav-cart-button>
            <cart-sidebar
                brand="pianote"
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url=''
                checkout-url='/order/pianote'
                api-domain-url=''
            ></cart-sidebar>
        </div>
    @endif

    @if(!empty($subscriptionVersion))
        @if(!empty($fullSubscriptionVersion))
            <div class="relative" role="navigation">
                <div class="edge-wrap show-for-medium">
                    <span class="cursor-pointer features @if(strpos(url()->full(), 'method') || strpos(url()->full(), 'songs') || strpos(url()->full(), 'coaches')) active @endif">Features <i class="fa-solid fa-caret-down"></i></span>
                    <span class="cursor-pointer instruments">Instruments <i class="fa-solid fa-caret-down"></i></span>
                    <a class=" @if(strpos(url()->full(), 'choose-plan')) active @endif" href="{{ get_legacy_brand_base_url('pianote') }}/choose-plan" >Pricing</a>
                    <a class="@if(strpos(url()->full(), 'shop')) active @endif" href="{{ get_legacy_brand_base_url('pianote') }}/shop" >Shop</a>
                    <a class="" href="{{ get_legacy_brand_base_url('pianote') }}/blog" >Blog</a>

                </div>
                <div class="features-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-44 lg:left-48 top-10 lg:top-12 w-44 z-[70]">
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'method')) active @endif" href="{{ get_legacy_brand_base_url('pianote') }}/method" ><i class="mr-1 text-lg fa-fw far fa-music-note"></i> Method</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'coaches')) active @endif" href="{{ get_legacy_brand_base_url('pianote') }}/coaches" ><i class="mr-1 text-lg fa-fw far fa-whistle"></i> Coaches</a>
{{--                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'songs')) active @endif" href="{{ get_legacy_brand_base_url('pianote') }}/songs" ><i class="mr-1 text-lg fa-fw far fa-headphones"></i> Songs</a>--}}
                </div>
                <div class="instruments-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-72 lg:left-80 -ml-3 top-10 lg:top-12 w-44 z-[70]">
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('drumeo') }}" ><i class="mr-1 text-lg fa-fw far fa-drum"></i> Drums</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full text-pianote" href="{{ get_legacy_brand_base_url('pianote') }}" ><i class="mr-1 text-lg fa-fw far fa-piano-keyboard"></i> Piano</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('guitareo') }}" ><i class="mr-1 text-lg fa-fw far fa-guitar"></i> Guitar</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('singeo') }}" ><i class="mr-1 text-lg fa-fw far fa-microphone-stand"></i> Singing</a>
                </div>
            </div>
        @endif
        <div class="button-wrap @if(!empty($hideJoin)) hidden @endif">
            <a aria-label="Join Pianote" @if(!empty($scrollToJoin))
                    href="#customize-anchor" class="join anchor-slide"
                @elseif(!empty($joinUrl))
                    href="{{ $joinUrl }}" class="join"
                @else
                    href="/#customize-anchor" class="join"
                @endif
                >

                @if(!empty($trialVersion))
                    Start for free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @else
                    Join<span class="show-for-medium"> Pianote</span>
                @endif
            </a>
        </div>
        <div class="hidden lg:block button-wrap @if(!empty($hideMenu)) opacity-0 px-0.5 @endif">
            <a href="https://www.musora.com/pianote" class="join outline-button" aria-label="Login to Pianote">Login</a>
        </div>
    @endif
</nav>

<div class="nav-side-bar">
    <div class="bottom-section">
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Member Login",
            "linkIcon" => "fas fa-sign-in",
            "linkUrl" => get_musora_brand_base_url() . '/login',
        ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Home",
            "linkIcon" => "fas fa-home",
            "linkUrl" => "/",
        ])
        <div class="has-drop-down" target="_parent" rel="">
            <div class="nav-link">
                <i class="fas fa-star text-pianote"></i>
                Features
                <div class="drop-down-arrow ">
                    <span class="bg-pianote"></span>
                    <span class="bg-pianote"></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Method",
                "linkUrl" => "/method/",
                "linkIcon" => ''
            ])
{{--            @include('drumeo.sales.partials._nav-link', [--}}
{{--                "linkName" => "Songs",--}}
{{--                "linkUrl" => "/songs/",--}}
{{--                "linkIcon" => ''--}}
{{--            ])--}}
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Coaches",
                "linkUrl" => "/coaches/",
                "linkIcon" => ''
            ])
        </div>
        <div class="has-drop-down" target="_parent" rel="">
            <div class="nav-link">
                <i class="fas fa-piano-keyboard text-pianote"></i>
                Instruments
                <div class="drop-down-arrow ">
                    <span class="bg-pianote"></span>
                    <span class="bg-pianote"></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Drums",
                "linkUrl" => "https://www.drumeo.com/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Guitar",
                "linkUrl" => "https://www.guitareo.com/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Singing",
                "linkUrl" => "https://www.singeo.com/",
                "linkIcon" => ''
            ])
        </div>
{{--        @include('drumeo.sales.partials._nav-link', [--}}
{{--            "linkName" => "Pricing",--}}
{{--            "linkIcon" => "fas fa-money-bill-wave",--}}
{{--            "linkUrl" => "/choose-plan",--}}
{{--        ])--}}
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Shop",
                "linkIcon" => "fas fa-tag",
                "linkUrl" => "/shop",
            ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Blog",
            "linkIcon" => "fas fa-comment-pen",
            "linkUrl" => "/blog",
        ])
        <div class="has-drop-down cursor-pointer">
            <div class="nav-link">
                <i class="fas fa-circle-play text-pianote"></i>
                Free Resources

                <div class="drop-down-arrow ">
                    <span class="bg-pianote"></span>
                    <span class="bg-pianote"></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Chord Hacks",
                "linkUrl" => "/chord-hacks",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Getting Started On The Piano",
                "linkUrl" => "/getting-started-on-the-piano",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Learn 3 Songs On Piano",
                "linkUrl" => "/learn-songs",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "5 Days To Playing Piano",
                "linkUrl" => "/piano-in-5-days",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Classical Piano Quick Start",
                "linkUrl" => "/classical-piano",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Sight Reading Made Simple",
                "linkUrl" => "/sight-reading-made-simple",
                "linkIcon" => "",
            ])
        </div>
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "About Us",
            "linkIcon" => "fas fa-users",
            "linkUrl" => "/about",
        ])
        <span class="shim"></span>
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-mobile-alt'></i>&nbsp; Mobile App ",
            "linkUrl" => "/app",
            "externalLink" => false
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://youtube.com/user/pianolessonscom",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://facebook.com/pianoteofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://instagram.com/pianoteofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@pianoteofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-question'></i>&nbsp; FAQs",
            "linkUrl" => "https://help.musora.com/",
            "externalLink" => false
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-phone'></i>&nbsp; Contact",
            "linkUrl" => get_musora_brand_base_url().'/contact',
            "externalLink" => false
        ])
        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>
