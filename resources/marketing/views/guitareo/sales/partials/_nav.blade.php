<nav class="top-bar expanded">
    <div class="logo">
        <a href="{{ get_legacy_brand_base_url('guitareo') }}" aria-label="Guitareo Home"  title="Go to the home page">
            <img src="https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png" alt="Guitareo Logo">
        </a>
    </div>
    <div class="menu-toggle @if(!empty($hideMenu)) opacity-0 px-0.5 @endif" role="button" aria-label="Toggle Menu">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </div>

    @if(!empty($checkoutVersion))
        <div class="button-wrap">
            <a href="{{ get_legacy_brand_base_url('guitareo') }}/shop" class="join outline-button">Shop</a>
        </div>
    @endif
    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="{{ get_legacy_brand_base_url('guitareo').'/shop' }}" class="join outline-button">Shop</a>

            <nav-cart-button
                    {{-- cart-data='{{ $cartData }}' --}}
                    cart-data-url=''
                    checkout-url='/order/guitareo'
                    api-domain-url=''
                    aria-label="Cart"
            ></nav-cart-button>
            <cart-sidebar
                    brand="guitareo"
                    {{-- cart-data='{{ $cartData }}' --}}
                    cart-data-url=''
                    checkout-url='/order/guitareo'
                    api-domain-url=''
                    aria-label="Cart Sidebar"
            ></cart-sidebar>
        </div>
    @endif
    @if(!empty($subscriptionVersion))
        @if(!empty($fullSubscriptionVersion))
            <div class="relative">
                <div class="edge-wrap show-for-medium">
                    <span class="cursor-pointer features @if(strpos(url()->full(), 'method') || strpos(url()->full(), 'songs') || strpos(url()->full(), 'coaches')) active @endif"  aria-haspopup="true" aria-expanded="false" aria-label="Features Dropdown Menu"  aria-controls="features-dd">Features <i class="fa-solid fa-caret-down"></i></span>
                    <span class="cursor-pointer instruments" role="button" aria-haspopup="true" aria-expanded="false" aria-label="Instruments Menu" aria-controls="instruments-dd" title="View Instruments">Instruments <i class="fa-solid fa-caret-down"></i></span>
                    <a class=" @if(strpos(url()->full(), 'choose-plan')) active @endif" href="{{ get_legacy_brand_base_url('guitareo') }}/choose-plan" title="View Pricing">Pricing</a>
                    <a class="@if(strpos(url()->full(), 'shop')) active @endif" href="{{ get_legacy_brand_base_url('guitareo') }}/shop" title="Visit Shop">Shop</a>
                    <a class="" href="{{ get_legacy_brand_base_url('guitareo') }}/riff" >Blog</a>

                </div>
                <div id="features-dd" class="features-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-44 lg:left-48 top-10 lg:top-12 w-44" aria-label="Features Dropdown Menu" tabindex="0">
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'method')) active @endif" href="{{ get_legacy_brand_base_url('guitareo') }}/method" ><i class="mr-1 text-lg fa-fw far fa-music-note"></i> Method</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'coaches')) active @endif" href="{{ get_legacy_brand_base_url('guitareo') }}/coaches" ><i class="mr-1 text-lg fa-fw far fa-whistle"></i> Coaches</a>
{{--                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'songs')) active @endif" href="{{ get_legacy_brand_base_url('guitareo') }}/songs" ><i class="mr-1 text-lg fa-fw far fa-headphones"></i> Songs</a>--}}
                </div>
                <div id="instruments-dd" class="instruments-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-72 lg:left-80 -ml-3 top-10 lg:top-12 w-44" aria-label="Instruments Dropdown Menu" tabindex="0">
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('drumeo') }}" ><i class="mr-1 text-lg fa-fw far fa-drum"></i> Drums</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('pianote') }}" ><i class="mr-1 text-lg fa-fw far fa-piano-keyboard"></i> Piano</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full text-guitareo" href="{{ get_legacy_brand_base_url('guitareo') }}" ><i class="mr-1 text-lg fa-fw far fa-guitar"></i> Guitar</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('singeo') }}" ><i class="mr-1 text-lg fa-fw far fa-microphone-stand"></i> Singing</a>
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
                aria-label="Join Guitareo"
            >

                @if(!empty($trialVersion))
                    Start for free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @else
                    Join<span class="show-for-medium"> Guitareo</span>
                @endif
            </a>
        </div>
        <div class="hidden lg:block button-wrap @if(!empty($hideMenu)) opacity-0 px-0.5 @endif">
            <a href="https://www.musora.com/guitareo" class="join outline-button">Login</a>
        </div>
    @endif
</nav>

<div class="nav-side-bar" style="z-index: 2147483003;">
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
                <i class="fas fa-star text-guitareo"></i>
                Features
                <div class="drop-down-arrow ">
                    <span class="bg-guitareo"></span>
                    <span class="bg-guitareo"></span>
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
        <div class="has-drop-down" target="_parent" rel="" aria-haspopup="true" aria-expanded="false" role="button">
            <div class="nav-link">
                <i class="fas fa-piano-keyboard text-guitareo"></i>
                Instruments
                <div class="drop-down-arrow ">
                    <span class="bg-guitareo"></span>
                    <span class="bg-guitareo"></span>
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
                "linkName" => "Singing",
                "linkUrl" => "https://www.singeo.com/",
                "linkIcon" => ''
            ])
        </div>

        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Pricing",
            "linkIcon" => "fas fa-money-bill-wave",
            "linkUrl" => "/choose-plan",
        ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Shop",
                "linkIcon" => "fas fa-tag",
                "linkUrl" => "/shop",
            ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Blog",
            "linkUrl" => "/riff/",
            "linkIcon" => 'fas fa-comment-alt-edit'
        ])

        <div class="has-drop-down" target="_parent" rel="">
            <div class="nav-link">
                <i class="fas fa-circle-play text-guitareo"></i>
                Free Resources
                <div class="drop-down-arrow ">
                    <span class="bg-guitareo"></span>
                    <span class="bg-guitareo"></span>
                </div>
            </div>
        </div>


        <div class="lesson-links dropdown">
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Getting Started On The Acoustic Guitar",
                "linkUrl" => "/free-acoustic-guitar-lessons/",
                "linkIcon" => ''
            ])
            {{--@include('drumeo.sales.partials._nav-link', [--}}
                {{--"linkName" => "Getting Started On The Electric Guitar",--}}
                {{--"linkUrl" => "/free-electric-guitar-lessons/",--}}
                {{--"linkIcon" => ''--}}
            {{--])--}}
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Learn to Solo In An Hour",
                "linkUrl" => "/solo-in-an-hour/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Fretboard Cheatsheet",
                "linkUrl" => "/fretboard-cheatsheet/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Song In An Hour Challenge",
                "linkUrl" => "/song-in-an-hour/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "2 Simple Guitar Tricks",
                "linkUrl" => "/guitar-tricks/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "The Guitarist's Toolbox",
                "linkUrl" => "/toolbox/",
                "linkIcon" => ''
            ])
        </div>


        <span class="shim"></span>
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://www.youtube.com/user/guitarlessonscom",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://www.facebook.com/guitareoofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://www.instagram.com/guitareoofficial/",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@guitareoofficial",
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
