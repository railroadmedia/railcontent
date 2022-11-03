<nav id="nav" class="top-bar row expanded">
    <div class="logo">
        <a href="/">
            <img src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="Drumeo">
        </a>
    </div>

    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="/drumshop" class="join outline-button">Shop</a>

            <nav-cart-button
{{--                cart-data='{{ $cartData }}'--}}
            ></nav-cart-button>
            <cart-sidebar
                brand="drumeo"
{{--                cart-data='{{ $cartData }}'--}}
            ></cart-sidebar>
        </div>
    @endif
    @if(!empty($edgeVersion))
        <div class="edge-wrap show-for-medium">
            <a class=" @if(strpos(url()->full(), 'method')) active @endif @if(!empty($homepage)) anchor-slide @endif"  href="/#method" >Method</a>
            <a class=" @if(strpos(url()->full(), 'songs')) active @endif @if(!empty($homepage)) anchor-slide @endif"  href="/#songs" >Songs</a>
            <a class=" @if(strpos(url()->full(), 'coaches')) active @endif @if(!empty($homepage)) anchor-slide @endif"  href="/#coaches" >Coaches</a>
        </div>

        <div class="button-wrap">
            <a href="/drumshop" class="join outline-button">Shop</a>
            <a @if(!empty($scrollToJoin))
                    href="#customize-anchor" class="join anchor-slide"
                @elseif(!empty($joinUrl))
                    href="{{ $joinUrl }}" class="join"
                @else
                    href="/#customize-anchor" class="join"
                @endif
                >

                @if(!empty($trialVersion))
                    Start Trial
                @else
                    Join<span class="show-for-medium"> Drumeo</span>
                @endif
            </a>
        </div>
    @endif
</nav>

<div class="nav-side-bar">
    <div class="bottom-section">
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Member Login",
            "linkIcon" => "fas fa-sign-in",
            "linkUrl" => "/login"
        ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Contact",
            "linkIcon" => "fas fa-phone",
            "linkUrl" => "/contact/"
        ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Drumeo",
            "linkIcon" => "icon-courses",
            "linkUrl" => "/",
        ])
        @include('drumeo.sales.partials._nav-link', [
            "linkName" => "Drum Shop",
            "linkIcon" => "fas fa-tag",
            "linkUrl" => "/drumshop",
        ])
        <div class="has-drop-down" target="_parent" rel="">
            <div class="nav-link">
                <i class="icon-live"></i>
                Free Resources
                <div class="drop-down-arrow ">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="lesson-links dropdown">
            @include('drumeo.sales.partials._nav-link', [
                "linkName" => "Drumeo Beat",
                "linkUrl" => "/beat/",
                "linkIcon" => ''
            ])
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
        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>
