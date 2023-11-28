<nav id="nav" class="top-bar expanded">
    <div class="logo">
        <a href="{{ get_legacy_brand_base_url('singeo') }}">
            <img src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png" alt="Singeo">
        </a>
    </div>

    <div class="menu-toggle @if(!empty($hideMenu)) opacity-0 px-0.5 @endif">
        <span></span>
        <span></span>
        <span></span>
    </div>

    @if(!empty($checkoutVersion))
        <div class="button-wrap">
            <a href="{{ get_legacy_brand_base_url('singeo') }}/shop" class="join outline-button">Shop</a>
        </div>
    @endif
    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="{{ get_legacy_brand_base_url('singeo').'/shop' }}" class="join outline-button">Shop</a>

            <nav-cart-button
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url=''
                checkout-url='/order/singeo'
                api-domain-url=''
            ></nav-cart-button>
            <cart-sidebar
                brand="singeo"
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url=''
                checkout-url='/order/singeo'
                api-domain-url=''
            ></cart-sidebar>
        </div>
    @endif
    @if(!empty($subscriptionVersion))
        @if(!empty($fullSubscriptionVersion))
            <div class="relative">
                <div class="edge-wrap show-for-medium">
                    <span class="cursor-pointer features  @if(strpos(url()->full(), 'method') || strpos(url()->full(), 'songs') || strpos(url()->full(), 'coaches')) text-singeo @endif">
                        Features <i class="fa-solid fa-caret-down"></i>
                    </span>
                    <span class="cursor-pointer instruments">
                        Instruments <i class="fa-solid fa-caret-down"></i>
                    </span>
                    <a class=" @if(strpos(url()->full(), 'choose-plan')) text-singeo @endif" href="{{ get_legacy_brand_base_url('singeo') }}/choose-plan" >Pricing</a>
                        <a style="color: #b30c15;" class="@if(strpos(url()->full(), 'shop')) active @endif" href="{{ get_legacy_brand_base_url('singeo') }}/shop" ><div class="hidden lg:inline">Holiday</div> Deals</a>
                    <a class="" href="{{ get_legacy_brand_base_url('singeo') }}/chorus" >Blog</a>
                </div>
                <div
                    class="features-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-32 lg:left-36 top-10 lg:top-12 w-44"
                    x-ref="features"
                >
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'method')) text-singeo @endif" href="{{ get_legacy_brand_base_url('singeo') }}/method" ><i class="mr-1 text-lg fa-fw far fa-music-note"></i> Method</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'coaches')) text-singeo @endif" href="{{ get_legacy_brand_base_url('singeo') }}/coaches" ><i class="mr-1 text-lg fa-fw far fa-whistle"></i> Coaches</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'songs')) text-singeo @endif" href="{{ get_legacy_brand_base_url('singeo') }}/songs" ><i class="mr-1 text-lg fa-fw far fa-headphones"></i> Songs</a>
                </div>
                <div
                    class="instruments-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-60 lg:left-68 -ml-3 top-10 lg:top-12 w-44"
                    x-ref="instruments"
                >
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('drumeo') }}" ><i class="mr-1 text-lg fa-fw far fa-microphone-stand"></i> Drums</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('pianote') }}" ><i class="mr-1 text-lg fa-fw far fa-piano-keyboard"></i> Piano</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('guitareo') }}" ><i class="mr-1 text-lg fa-fw far fa-guitar"></i> Guitar</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full text-singeo" href="{{ get_legacy_brand_base_url('singeo') }}" ><i class="mr-1 text-lg fa-fw far fa-microphone-stand"></i> Singing</a>
                </div>
            </div>
        @endif
            <div class="button-wrap @if(!empty($hideJoin)) hidden @endif">
                <a @if(!empty($scrollToJoin))
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
                        Join<span class="show-for-medium"> Singeo</span>
                    @endif
                </a>
            </div>
            <div class="hidden lg:block button-wrap @if(!empty($hideMenu)) opacity-0 px-0.5 @endif">
                <a href="https://www.musora.com/singeo" class="join outline-button">Login</a>
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
                <i class="fas fa-star text-singeo"></i>
                Features
                <div class="drop-down-arrow ">
                    <span class="bg-singeo"></span>
                    <span class="bg-singeo"></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Method",
                "linkUrl" => "/method/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Songs",
                "linkUrl" => "/songs/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Coaches",
                "linkUrl" => "/coaches/",
                "linkIcon" => ''
            ])
        </div>
        <div class="has-drop-down" target="_parent" rel="">
            <div class="nav-link">
                <i class="fas fa-piano-keyboard text-singeo"></i>
                Instruments
                <div class="drop-down-arrow ">
                    <span class="bg-singeo"></span>
                    <span class="bg-singeo"></span>
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
                "linkName" => "Piano",
                "linkUrl" => "https://www.pianote.com/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Guitar",
                "linkUrl" => "https://www.guitareo.com/",
                "linkIcon" => ''
            ])
        </div>
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Pricing",
            "linkIcon" => "fas fa-money-bill-wave",
            "linkUrl" => "/choose-plan",
        ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Holiday Deals",
                "linkIcon" => "fas fa-tag text-promo",
                "linkUrl" => "/shop",
            ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Blog",
            "linkIcon" => "fas fa-comment-alt-edit",
            "linkUrl" => "/chorus",
        ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "4 Vocal Exercises",
            "linkIcon" => "fas fa-microphone-alt",
            "linkUrl" => "/improve-any-voice",
        ])
        <span class="shim"></span>
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://www.youtube.com/c/singeoofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://www.facebook.com/singeoofficial/",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://www.instagram.com/singeoofficial/",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@singeoofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-question'></i>&nbsp; FAQs",
            "linkUrl" => "https://help.singeo.com/",
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
