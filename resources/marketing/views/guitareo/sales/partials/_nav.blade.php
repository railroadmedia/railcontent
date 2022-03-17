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

    @if(!empty($cartVersion))
        <div class="button-wrap" id="app">
            <a href="/shop" class="join outline-button">Shop</a>

            <nav-cart-button
                    cart-data='{{ $cartData }}'
            ></nav-cart-button>
            <cart-sidebar
                    brand="guitareo"
                    cart-data='{{ $cartData }}'
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
            <a href="#customize-anchor" class="join anchor-slide">Join Guitareo</a>
        </div>
    @endif
</div>

<div class="nav-side-bar" style="z-index: 2147483003;">
    <div class="bottom-section">
        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Member Login",
            "linkIcon" => "fas fa-sign-in",
            "linkUrl" => URL::Route('members.login')
        ])

        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Contact",
            "linkIcon" => "fas fa-phone",
            "linkUrl" => "/contact"
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

        @include('guitareo.sales.partials._nav-link', [
            "linkName" => "Free Resources",
            "linkIcon" => "icon-live",
            "hasDropdown" => true,
            "linkUrl" => '',
            "noClick" => true
        ])
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
            "linkName" => "YouTube <i class='fas fa-external-link'></i>",
            "linkUrl" => "https://www.youtube.com/user/guitarlessonscom",
            "externalLink" => true
        ])
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "Facebook <i class='fas fa-external-link'></i>",
            "linkUrl" => "https://www.facebook.com/guitareoofficial",
            "externalLink" => true
        ])
        @include('guitareo.sales.partials._nav-secondary-link', [
            "linkName" => "Instagram <i class='fas fa-external-link'></i>",
            "linkUrl" => "https://www.instagram.com/guitareoofficial/",
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