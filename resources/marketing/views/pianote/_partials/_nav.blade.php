<nav class="top-bar">
    <div class="logo">
        <a href="{{ get_legacy_brand_base_url('pianote') }}">
            <img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png" alt="Pianote">
        </a>
    </div>

    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    @if(!empty($checkoutVersion))
        <div class="button-wrap">
            <a href="{{ get_legacy_brand_base_url('pianote') }}/shop" class="join outline-button">Shop</a>
        </div>
    @endif
    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="{{ get_legacy_brand_base_url('pianote') }}/shop" class="join outline-button hover:no-underline">Shop</a>

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

    @if(!empty($joinVersion))
        <div class="edge-wrap show-for-medium">
            <a class="@if(!empty($scrollToJoin)) anchor-slide @endif"  href="/#method" >Method</a>
            <a class="@if(!empty($scrollToJoin)) anchor-slide @endif"  href="/#songs" >Songs</a>
            <a class="@if(!empty($scrollToJoin)) anchor-slide @endif"  href="/#coaches" >Coaches</a>
        </div>
        <div class="button-wrap">
            <a href="{{ get_legacy_brand_base_url('pianote') }}/shop" class="join outline-button">Shop</a>
            <a
                @if(!empty($scrollToJoin))
                href="/#orderNow" class="join anchor-slide"
                @else
                href="/#orderNow" class="join"
                @endif
            >
                @if(!empty($trialVersion) && $trialVersion) Start your free trial @else Join <span class="show-for-medium"> Pianote</span> @endif
            </a>
        </div>
    @endif
</nav>

<div class="nav-side-bar">
    <div class="bottom-section">
        @include('pianote.sales.partials._nav-link', [
            "linkName" => "Member Login",
            "linkIcon" => "fas fa-sign-in",
            "linkUrl" => get_musora_brand_base_url() . '/login',
        ])
        @include('pianote.sales.partials._nav-link', [
            "linkName" => "Contact",
            "linkIcon" => "fas fa-phone",
            "linkUrl" => "{{ get_musora_brand_base_url() }}/contact"
        ])
        @include('pianote.sales.partials._nav-link', [
            "linkName" => "Pianote",
            "linkIcon" => "fas fa-graduation-cap",
            "linkUrl" => "/",
        ])
        @include('pianote.sales.partials._nav-link', [
            "linkName" => "Holiday Deals",
            "linkIcon" => "fas fa-tag",
            "linkUrl" => "/shop",
        ])
        <div class="has-drop-down cursor-pointer">
            <div class="nav-link">
                <i class="fas fa-circle-play"></i>
                Free Resources

                <div class="drop-down-arrow ">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "Blog",
                "linkUrl" => "/blog/",
                "linkIcon" => ''
            ])
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "Chord Hacks",
                "linkUrl" => "/chord-hacks",
                "linkIcon" => ''
            ])
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "Getting Started On The Piano",
                "linkUrl" => "/getting-started",
                "linkIcon" => ''
            ])
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "Learn 3 Songs On Piano",
                "linkUrl" => "/learn-songs",
                "linkIcon" => ''
            ])
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "5 Days To Playing Piano",
                "linkUrl" => "/piano-in-5-days",
                "linkIcon" => ''
            ])
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "Classical Piano Quick Start",
                "linkUrl" => "/classical-piano",
                "linkIcon" => ''
            ])
            @include('pianote.sales.partials._nav-link', [
                "linkName" => "Sight Reading Made Simple",
                "linkUrl" => "/sight-reading-made-simple",
                "linkIcon" => "",
            ])
        </div>
        @include('pianote.sales.partials._nav-link', [
            "linkName" => "About Us",
            "linkIcon" => "fas fa-users",
            "linkUrl" => "/about",
        ])
        <span class="shim"></span>
        @include('pianote.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-mobile-alt'></i>&nbsp; Mobile App ",
            "linkUrl" => "/app",
            "externalLink" => false
        ])
        @include('pianote.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://youtube.com/user/pianolessonscom",
            "externalLink" => true
        ])
        @include('pianote.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://facebook.com/pianoteofficial",
            "externalLink" => true
        ])
        @include('pianote.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://instagram.com/pianoteofficial",
            "externalLink" => true
        ])
        @include('pianote.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@pianoteofficial",
            "externalLink" => true
        ])
        @include('pianote.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-question'></i>&nbsp; FAQs",
            "linkUrl" => "https://help.pianote.com/",
            "externalLink" => false
        ])
        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>
