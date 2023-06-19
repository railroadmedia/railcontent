<nav id="nav" class="top-bar row expanded @if(!empty($whiteNav)) bg-white @else bg-[#020815] @endif">
    <div class="logo">
        <a
            @if(!empty($logoUrl))
                href="{{ $logoUrl }}"
            @else
                href="{{ get_legacy_brand_base_url('drumeo') }}"
            @endif
        >
            <img class="@if(!empty($whiteNav)) invert @endif" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png" alt="Drumeo">
        </a>
    </div>

    <div class="menu-toggle @if(!empty($hideMenu)) opacity-0 px-1 w-0 @endif @if(!empty($whiteNav)) invert @endif">
        <span></span>
        <span></span>
        <span></span>
    </div>

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
                    <a class=" @if(strpos(url()->full(), 'drumshop')) active @endif" href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" >Shop</a>
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
        <a href="https://www.musora.com/login" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-member-login">
            <i class=" fas fa-sign-in text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Member Login
        </a>
        <a href="/" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-home">
            <i class=" fas fa-home text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Home
        </a>
        <div class="page-link parent flex flex-col flex-wrap body text-black align-v-center" data-remain-open="features" x-data="{ dropdown_648b9503bc570: false }">
            <div class="flex py-2 px-5 border-b border-gray-100 md:text-[17px] items-center leading-none cursor-pointer" dusk="parent-button-features" x-on:click.prevent="dropdown_648b9503bc570 = !dropdown_648b9503bc570">
                <i class="no-events fas fa-star text-musora mr-2.5 text-lg" aria-hidden="true"></i>
                Features
                <i class="no-events far fa-chevron-down arrow ml-auto transition-all transform-gpu origin-center text-musora rotate-0" x-bind:class="dropdown_648b9503bc570 ? '-rotate-180' : 'rotate-0'" aria-hidden="true"></i>
            </div>
            <div class="flex flex-col overflow-hidden transition-all transform-gpu max-h-0" x-bind:class="dropdown_648b9503bc570 ? 'max-h-[500px]' : 'max-h-0'">
                <a href="https://www.musora.com/method" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none bg-gray-50 text-sm py-3" dusk="page-link-method">
                    Method
                </a>
                <a href="https://www.musora.com/songs" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none bg-gray-50 text-sm py-3" dusk="page-link-songs">
                    Songs
                </a>
            </div>
        </div>
        <div class="page-link parent flex flex-col flex-wrap body text-black align-v-center" data-remain-open="instruments" x-data="{ dropdown_648b9503bc982: false }">
            <div class="flex py-2 px-5 border-b border-gray-100 md:text-[17px] items-center leading-none cursor-pointer" dusk="parent-button-instruments" x-on:click.prevent="dropdown_648b9503bc982 = !dropdown_648b9503bc982">
                <i class="no-events fas fa-piano-keyboard text-musora mr-2.5 text-lg" aria-hidden="true"></i>
                Instruments
                <i class="no-events far fa-chevron-down arrow ml-auto transition-all transform-gpu origin-center text-musora rotate-0" x-bind:class="dropdown_648b9503bc982 ? '-rotate-180' : 'rotate-0'" aria-hidden="true"></i>
            </div>
            <div class="flex flex-col overflow-hidden transition-all transform-gpu max-h-0" x-bind:class="dropdown_648b9503bc982 ? 'max-h-[500px]' : 'max-h-0'">
                <a href="https://www.pianote.com" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none bg-gray-50 text-sm py-3" dusk="page-link-piano">
                    Piano
                </a>
                <a href="https://www.guitareo.com" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none bg-gray-50 text-sm py-3" dusk="page-link-guitar">
                    Guitar
                </a>
                <a href="https://www.drumeo.com" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none bg-gray-50 text-sm py-3" dusk="page-link-drums">
                    Drums
                </a>
                <a href="https://www.singeo.com" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none bg-gray-50 text-sm py-3" dusk="page-link-singing">
                    Singing
                </a>
            </div>
        </div>
        <a href="https://www.musora.com/choose-plan" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-pricing">
            <i class=" fas fa-money-bill-wave text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Pricing
        </a>
        <a href="https://www.musora.com/contact" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-contact">
            <i class=" fas fa-phone text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Contact
        </a>
        <a href="/careers" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-careers">
            <i class=" fas fa-users text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Careers
        </a>
        <a href="/about" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-about">
            <i class=" fas fa-question text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            About
        </a>
        <a href="/ambassador" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-ambassador-program">
            <i class=" fas fa-comment-dollar text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Ambassador Program
        </a>
        <a href="/brand" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none md:text-[17px]" dusk="page-link-brand-guides">
            <i class=" fas fa-pencil-paintbrush text-musora w-6 text-center mr-2.5 text-lg" aria-hidden="true"></i>
            Brand Guides
        </a>
        <span class="shim"></span>
        <ul class="py-3 px-5">
            <li class="mb-1">
                <a href="https://www.drumeo.com" target="_blank" class="text-base text-black py-2 w-full">
                    <i class="fas fa-external-link mr-1 " aria-hidden="true"></i>
                    Drumeo
                </a>
            </li>
            <li class="mb-1">
                <a href="https://www.pianote.com" target="_blank" class="text-base text-black py-2 w-full">
                    <i class="fas fa-external-link mr-1 " aria-hidden="true"></i>
                    Pianote
                </a>
            </li>
            <li class="mb-1">
                <a href="https://www.guitareo.com" target="_blank" class="text-base text-black py-2 w-full">
                    <i class="fas fa-external-link mr-1 " aria-hidden="true"></i>
                    Guitareo
                </a>
            </li>
            <li class="mb-1">
                <a href="https://www.singeo.com" target="_blank" class="text-base text-black py-2 w-full">
                    <i class="fas fa-external-link mr-1 " aria-hidden="true"></i>
                    Singeo
                </a>
            </li>
        </ul>

        <span class="shim"></span>
    </div>
</div>
<div class="menu-overlay"></div>
