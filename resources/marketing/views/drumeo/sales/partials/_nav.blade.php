<nav id="nav" class="top-bar row expanded">
    <div class="logo">
        <a
            @if(!empty($logoUrl))
                href="{{ $logoUrl }}"
            @else
                href="{{ get_legacy_brand_base_url('drumeo') }}"
            @endif
        >
            <img src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="Drumeo">
        </a>
    </div>

    <div class="menu-toggle @if(!empty($hideMenu)) opacity-0 px-1 w-0 @endif">
        <span></span>
        <span></span>
        <span></span>
    </div>

    @if(!empty($checkoutVersion))
        <div class="button-wrap">
            <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" class="join outline-button">Shop</a>
        </div>
    @endif

    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="{{ get_legacy_brand_base_url('drumeo').'/drumshop' }}" class="join outline-button">Shop</a>

            <nav-cart-button
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url=''
                checkout-url='/order/drumeo'
                api-domain-url=''
            ></nav-cart-button>
            <cart-sidebar
                brand="drumeo"
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url=''
                checkout-url='/order/drumeo'
                api-domain-url=''
            ></cart-sidebar>

        </div>
    @endif

    @if(!empty($subscriptionVersion))
        @if(!empty($fullSubscriptionVersion))
            <div class="relative">
                <div class="edge-wrap show-for-medium">
                    <span class="cursor-pointer features @if(strpos(url()->full(), 'method') || strpos(url()->full(), 'songs') || strpos(url()->full(), 'coaches')) active @endif">Features <i class="fa-solid fa-caret-down"></i></span>
                    <span class="cursor-pointer instruments">Instruments <i class="fa-solid fa-caret-down"></i></span>
                    <a class=" @if(strpos(url()->full(), 'choose-plan')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/choose-plan" >Pricing</a>
                    @if(Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
                        <a style="color: #fe006b;" class="@if(strpos(url()->full(), 'drumshop')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" ><div class="hidden lg:inline">Black Friday</div> Deals</a>
                    @else
                        <a style="color: #23bcff;" class="@if(strpos(url()->full(), 'drumshop')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" ><div class="hidden lg:inline">Cyber Monday</div> Deals</a>
                    @endif
                    <a class="" href="{{ get_legacy_brand_base_url('drumeo') }}/beat" >Blog</a>
                </div>
                <div class="features-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-44 lg:left-48 top-10 lg:top-12 w-44">
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'method')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/method" ><i class="mr-1 text-lg fa-fw far fa-music-note"></i> Method</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'coaches')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/coaches" ><i class="mr-1 text-lg fa-fw far fa-whistle"></i> Coaches</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full @if(strpos(url()->full(), 'songs')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/songs" ><i class="mr-1 text-lg fa-fw far fa-headphones"></i> Songs</a>
                </div>
                <div class="instruments-dd hidden shadow-md bg-white rounded-xl p-2 absolute flex flex-col left-72 lg:left-80 -ml-3 top-10 lg:top-12 w-44">
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full text-drumeo" href="{{ get_legacy_brand_base_url('drumeo') }}" ><i class="mr-1 text-lg fa-fw far fa-drum"></i> Drums</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('pianote') }}" ><i class="mr-1 text-lg fa-fw far fa-piano-keyboard"></i> Piano</a>
                    <a class="font-bebas uppercase select-none text-base tracking-wider rounded-lg px-2 py-1 hover:bg-gray-100 w-full" href="{{ get_legacy_brand_base_url('guitareo') }}" ><i class="mr-1 text-lg fa-fw far fa-guitar"></i> Guitar</a>
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
                >

                @if(!empty($trialVersion))
                    Start for free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @else
                    Join<span class="show-for-medium"> Drumeo</span>
                @endif
            </a>
        </div>
        <div class="hidden lg:block button-wrap @if(!empty($hideMenu)) opacity-0 px-0.5 @endif">
            <a href="https://www.musora.com/drumeo" class="join outline-button">Login</a>
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
                <i class="fas fa-star"></i>
                Features
                <div class="drop-down-arrow ">
                    <span></span>
                    <span></span>
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
                <i class="fas fa-piano-keyboard"></i>
                Instruments
                <div class="drop-down-arrow ">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
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
            "linkUrl" => "/drumshop",
        ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Blog",
            "linkIcon" => "fas fa-comment-pen",
            "linkUrl" => "/beat",
        ])
        <div class="has-drop-down" target="_parent" rel="">
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
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Getting Started On The Drums",
                "linkUrl" => "/getting-started/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "40 Drum Rudiments",
                "linkUrl" => "/beat/rudiments/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "The Drumeo Podcast",
                "linkUrl" => "/beat/podcasts/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Free Video Drum Lessons",
                "linkUrl" => "/beat/videos/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Free Articles For Drummers",
                "linkUrl" => "/beat/articles/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "How To Play Drums",
                "linkUrl" => "/beat/how-to-play-drums/",
                "linkIcon" => ''
            ])
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "100 Free Songs",
                "linkUrl" => "/100-songs",
                "linkIcon" => ''
            ])
        </div>
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "About Us",
            "linkIcon" => "fas fa-users",
            "linkUrl" => "/about",
        ])
        <span class="shim"></span>
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-mobile-alt'></i>&nbsp; Drumeo Kids App ",
            "linkUrl" => "/kids/",
            "externalLink" => false
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://www.youtube.com/freedrumlessons/",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://facebook.com/drumeo/",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://instagram.com/drumeoofficial/",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@drumeoofficial",
            "externalLink" => true
        ])
        @include('drumeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-question'></i>&nbsp; FAQs",
            "linkUrl" => "https://help.drumeo.com/",
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
