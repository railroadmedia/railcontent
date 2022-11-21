@if(!empty($transparentNav)) <style>body {padding-top:0;}</style> @endif
<nav id="nav" class="top-bar expanded @if(!empty($transparentNav)) transparent @endif">
    <div class="logo">
        <a href="/">
            <img src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png" alt="Singeo">
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
                checkout-url='{{ get_legacy_brand_base_url("musora") }}/order/singeo'
                api-domain-url='{{ get_musora_brand_base_url() }}'
            ></nav-cart-button>
            <cart-sidebar
                brand="singeo"
                {{-- cart-data='{{ $cartData }}' --}}
                cart-data-url='{{ get_musora_brand_base_url() }}/ecommerce/json/cart'
                checkout-url='{{ get_legacy_brand_base_url("musora") }}/order/singeo'
                api-domain-url='{{ get_musora_brand_base_url() }}'
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
            <a href="/shop" class="join outline-button">Shop</a>
            <a href="#customize-anchor" class="join anchor-slide">Join Singeo</a>
        </div>
    @endif
</nav>

<div class="nav-side-bar">
    <div class="bottom-section">
        @include('singeo.sales.partials._nav-link', [
            "linkName" => "Member Login",
            "linkIcon" => "fas fa-sign-in",
            "linkUrl" => "/login",
        ])
        @include('singeo.sales.partials._nav-link', [
            "linkName" => "Contact",
            "linkIcon" => "fas fa-phone",
            "linkUrl" => get_legacy_brand_base_url("musora").'/contact'
        ])
        @include('singeo.sales.partials._nav-link', [
            "linkName" => "Singeo",
            "linkIcon" => "icon-courses",
            "linkUrl" => "/",
        ])
        @include('singeo.sales.partials._nav-link', [
            "linkName" => "Shop",
            "linkIcon" => "fas fa-tag",
            "linkUrl" => '/shop',
        ])
        @include('singeo.sales.partials._nav-link', [
            "linkName" => "The Chorus",
            "linkIcon" => "fas fa-comment-alt-edit",
            "linkUrl" => "/chorus",
        ])
        @include('singeo.sales.partials._nav-link', [
            "linkName" => "4 Vocal Exercises",
            "linkIcon" => "fas fa-microphone-alt",
            "linkUrl" => "/improve-any-voice",
        ])
        <span class="shim"></span>
        @include('singeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-youtube'></i>&nbsp; YouTube",
            "linkUrl" => "https://www.youtube.com/c/singeoofficial",
            "externalLink" => true
        ])
        @include('singeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-facebook'></i>&nbsp; Facebook",
            "linkUrl" => "https://www.facebook.com/singeoofficial/",
            "externalLink" => true
        ])
        @include('singeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-instagram'></i>&nbsp; Instagram",
            "linkUrl" => "https://www.instagram.com/singeoofficial/",
            "externalLink" => true
        ])
        @include('singeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fab fa-fw fa-tiktok'></i>&nbsp; TikTok",
            "linkUrl" => "https://www.tiktok.com/@singeoofficial",
            "externalLink" => true
        ])
        @include('singeo.sales.partials._secondary-nav-link', [
            "linkName" => "<i class='fas fa-fw fa-question'></i>&nbsp; FAQs",
            "linkUrl" => "https://help.singeo.com/",
            "externalLink" => false
        ])
        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>
