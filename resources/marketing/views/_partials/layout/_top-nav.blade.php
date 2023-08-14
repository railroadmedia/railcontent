<nav id="nav" class="@if(!empty($whiteNav)) bg-white @else bg-[#020815] @endif shadow-md fixed w-full top-0 left-0 flex items-center h-10 md:h-14 top-bar z-50">
    <!-- Logo/Home Link -->
    <a href="{{ $homeUrl ?? '/' }}" class="h-full px-2 md:px-4 flex items-center mr-4 lg:mr-8">
        <img src="{{ $logo }}" alt="Musora Logo" class="@if(!empty($whiteNav)) invert @endif w-full max-w-[77px] md:max-w-[144px] max-h-9">
    </a>

    <!-- link-wrapper -->
    <div class="flex flex-1">

            @if(!empty($fullSubscriptionVersion))

                {{-- Nav Links --}}
                <ul class="flex items-center text-white font-bebas-neue hidden md:flex">
                    @foreach($nav_links as $page => $info)
                        @if(!empty($info['children']))
                            @include('_partials.layout._nav-dropdown', [
                                "page" => $page,
                                "children" => $info['children'],
                            ])
                        @else
                            @include('_partials.layout._nav-link', [
                                "page" => $page,
                                "url" => $info['url'],
                            ])
                        @endif
                    @endforeach
                </ul>

            @endif



        {{-- Cart and Shop CTA buttons --}}
        @if(!empty($checkoutVersion))
            <div class="ml-auto flex items-center">
                <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" class="join outline-button">Shop</a>
            </div>
        @endif

        @if(!empty($cartVersion))
            <div class="ml-auto flex items-center" id="app">
                <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" class="join outline-button">Shop</a>

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

    </div>

    <div class="hidden lg:block py-4 mr-1">
        <a href="{{ get_legacy_brand_base_url('musora') }}/login" class="@if(!empty($whiteNav)) invert @endif border-2 border-white rounded-full text-[15px] text-white hover:text-black hover:bg-white uppercase font-bebas tracking-widest pt-[9px] px-[30px] pb-[8px] transition-all duration-200">Login</a>
    </div>

    <div class="ml-auto flex items-center">
        <a href="/choose-plan" class="btn-primary btn-small text-base leading-none text-black bg-musora border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">
            Start for free &nbsp; <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
        </a>
    </div>

    <!-- Sidebar Toggle -->
    <button class="@if(!empty($whiteNav)) invert @endif text-white w-10 h-10 md:w-14 md:h-14 relative focus:outline-none" x-on:click="sidebarOpen = !sidebarOpen, showOverlay = !showOverlay">
        <span class="sr-only">Open main menu</span>
        <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-current transform transition duration-300 ease-in-out" x-bind:class="{'rotate-45': sidebarOpen,' -translate-y-1.5': !sidebarOpen }"></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current   transform transition duration-300 ease-in-out" x-bind:class="{'opacity-0': sidebarOpen } "></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-300 ease-in-out" x-bind:class="{'-rotate-45': sidebarOpen, ' translate-y-1.5': !sidebarOpen}"></span>
        </div>
    </button>
</nav>
