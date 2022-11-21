<div class="top-bar expanded">
    <div class="logo">
        <a href="/">
            <img src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" alt="Guitareo Logo">
        </a>
    </div>
    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    @if(!empty($checkoutVersion))
        <div class="button-wrap">
            <a href="/shop" class="join outline-button">Shop</a>
        </div>
    @endif
    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="/shop" class="join outline-button">Shop</a>

            <nav-cart-button
                    {{-- cart-data='{{ $cartData }}' --}}
                    cart-data-url='{{ get_musora_brand_base_url() }}/ecommerce/json/cart'
                    checkout-url='{{ get_legacy_brand_base_url("musora") }}/order/guitareo'
                    api-domain-url='{{ get_musora_brand_base_url() }}'
            ></nav-cart-button>
            <cart-sidebar
                    brand="guitareo"
                    {{-- cart-data='{{ $cartData }}' --}}
                    cart-data-url='{{ get_musora_brand_base_url() }}/ecommerce/json/cart'
                    checkout-url='{{ get_legacy_brand_base_url("musora") }}/order/guitareo'
                    api-domain-url='{{ get_musora_brand_base_url() }}'
            ></cart-sidebar>
        </div>
    @endif
    @if(!empty($homepageVersion))
        <div class="edge-wrap show-for-medium">
            <a class="@if(!empty($scrollToJoin)) anchor-slide @endif"  href="/#method" >Method</a>
            <a class="@if(!empty($scrollToJoin)) anchor-slide @endif"  href="/#songs" >Songs</a>
            <a class="@if(!empty($scrollToJoin)) anchor-slide @endif"  href="/#coaches" >Coaches</a>
        </div>
        <div class="button-wrap">
            <a href="/shop" class="join outline-button">Shop</a>
            <a href="#customize-anchor" class="join anchor-slide">Join<span class="show-for-medium"> Guitareo</span></a>
        </div>
    @endif
</div>

<div class="nav-side-bar" style="z-index: 2147483003;">
    <div class="bottom-section">
        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Member Login",
            "linkIcon" => "fas fa-sign-in",
            "linkUrl" => "/login"
        ])

        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Contact",
            "linkIcon" => "fas fa-phone",
            "linkUrl" => get_legacy_brand_base_url("musora").'/contact'
        ])

        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Guitareo",
            "linkIcon" => "icon-courses",
            "linkUrl" => "/",
        ])

        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Shop",
            "linkIcon" => "fas fa-tag",
            "linkUrl" => '/shop',
        ])
        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "The Riff",
            "linkUrl" => "/riff/",
            "linkIcon" => 'fas fa-comment-alt-edit'
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
            @include('guitareo.sales.partials._nav-link', [
                "linkName" => "Getting Started On The Acoustic Guitar",
                "linkUrl" => "/free-acoustic-guitar-lessons/",
                "linkIcon" => ''
            ])
            {{--@include('guitareo.sales.partials._nav-link', [--}}
                {{--"linkName" => "Getting Started On The Electric Guitar",--}}
                {{--"linkUrl" => "/free-electric-guitar-lessons/",--}}
                {{--"linkIcon" => ''--}}
            {{--])--}}
            @include('guitareo.sales.partials._nav-link', [
                "linkName" => "Learn to Solo In An Hour",
                "linkUrl" => "/solo-in-an-hour/",
                "linkIcon" => ''
            ])
            @include('guitareo.sales.partials._nav-link', [
                "linkName" => "Fretboard Cheatsheet",
                "linkUrl" => "/fretboard-cheatsheet/",
                "linkIcon" => ''
            ])
            @include('guitareo.sales.partials._nav-link', [
                "linkName" => "Song In An Hour Challenge",
                "linkUrl" => "/song-in-an-hour/",
                "linkIcon" => ''
            ])
            @include('guitareo.sales.partials._nav-link', [
                "linkName" => "2 Simple Guitar Tricks",
                "linkUrl" => "/guitar-tricks/",
                "linkIcon" => ''
            ])
            @include('guitareo.sales.partials._nav-link', [
                "linkName" => "The Guitarist's Toolbox",
                "linkUrl" => "/toolbox/",
                "linkIcon" => ''
            ])
        </div>


        <span class="shim"></span>
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://www.youtube.com/user/guitarlessonscom",
            "externalLink" => true
        ])
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://www.facebook.com/guitareoofficial",
            "externalLink" => true
        ])
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://www.instagram.com/guitareoofficial/",
            "externalLink" => true
        ])
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@guitareoofficial",
            "externalLink" => true
        ])
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "<i class='fas fa-fw fa-question'></i>&nbsp; FAQs",
            "linkUrl" => "https://help.guitareo.com/",
            "externalLink" => false
        ])

        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>
