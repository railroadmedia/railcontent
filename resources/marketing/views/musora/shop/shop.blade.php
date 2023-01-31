@extends('_partials.layout.global-template')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/drum-shop/og-image.jpg">
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/">
@endsection

@section('layout-styles')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
@endsection

@section('body-data')
    x-data="{
        shippingModal: false,
        orderModal: false,
        filter: 'brand',
    }"
@endsection

@section('layout-header')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
@endsection

@section('layout-body')
    <div class="shipping-delay p-2">
        <div class="delay-bar text-center">
            <div class="container mx-auto">
                <p class="inline-block cursor-pointer hover:underline" @click="shippingModal = true;"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $100</strong></p>
                <p class="inline-block cursor-pointer"><strong> | All items are pre-order only and ship within 2-4 weeks of purchase date.</strong></p>
            </div>
        </div>
    </div>

    <header class="drum-shop-header" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/todo);background-color:#140c08;">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="h-6 md:h-9" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="drumeo logo">
                <p>As a Musora Member you’re getting exclusive access to <strong>NEW</strong><br> limited edition merch designed for musicians – by musicians.</p>
                <div class="rounded-xl px-6 py-2 inline-flex flex-wrap mx-auto mt-5 justify-center items-center text-black" style="background-color:#fff;">
                    <p class="leading-none m-0"><strong>SALE ENDS IN:</strong></p>
                    <div class="h-12 mx-5 bg-black" style="width:2px;"></div>
                    <div class="tzcd-big">
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>
                        </div>
                        <div class="inline-block mx-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>
                        </div>
                        <div class="inline-block mr-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>
                        </div>
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>
                        </div>
                    </div>
                </div>
                <p><strong><em>ONLY AVAILABLE FOR A LIMITED TIME</em></strong></p>
            </div>
        </div>
    </header>


    @if(Session::has('addedProducts'))
        <section class="added-to-cart-background clearfix">
            <div class="float-left w-full px-2 md:px-3 check">
                <h2><i class="fas fa-check"></i>Added to Cart</h2>
            </div>
            <div class="float-left w-full px-2 md:px-3 product-info">
                <div class="float-left w-full px-2 md:px-3 md:w-2/3 product">
                    @foreach(Session::get('addedProducts') as $addedProduct)
                        <div class="float-left w-full px-2 md:px-3" style="padding:0;margin-bottom:15px;">
                            <img src="{{ $addedProduct['thumbnail'] }}">
                            <h4>{{ $addedProduct['name'] }}</h4>
                            <p>{{ $addedProduct['description'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="float-left w-full px-2 md:px-3 md:w-1/3 checkout">
                    <h5>
                        Cart Subtotal({{ Session::get('cartNumberOfItems') }}):
                        <strong>${{ number_format(Session::get('cartSubTotal'), 2, '.', ',') }}</strong>
                    </h5>
                    <a href="{{ get_musora_brand_base_url() }}/order/{{ $brand }}" class="join"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>
                </div>
            </div>
        </section>
    @endif

    @if(Session::has('success-message') ||
    Session::has('warning-message') ||
    Session::has('error-message'))
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-2 md:px-3 no-padding">
                @if(Session::has('success-message'))
                    <div class="alert alert-success">
                        <strong>Success: </strong> {{ Session::get('success-message') }}
                    </div>
                @endif

                @if(Session::has('warning-message'))
                    <div class="alert alert-warning">
                        <strong>Warning: </strong> {{ Session::get('warning-message') }}
                    </div>
                @endif

                @if(Session::has('error-message'))
                    <div class="alert alert-danger">
                        <strong>Error: </strong> {{ Session::get('error-message') }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    <section class="catalogue-filters clearfix w-full">
        <div class="container mx-auto">
            <div class="md:flex justify-between md:px-3 lg:px-2">
                <div class="filter-wrap clearfix">
                <span
                    class="filter float-left px-2 md:px-3 w-1/2 md:w-auto border-black"
                    x-bind:class="filter === 'brand' && 'active'"
                    x-on:click="filter = 'brand'"
                >
                    All
                </span>
                <span
                    class="filter float-left px-2 md:px-3 w-1/2 md:w-auto border-black"
                    x-bind:class="filter === 'type' && 'active'"
                    x-on:click="filter = 'type'"
                >
                    Type
                </span>
                </div>
                <div class="select-wrap relative px-3 md:px-0">
                    <select id="sortBySection" data-filter-type="sort-order" class="catalogue-filter w-full">
                        <option class="selectable-option" disabled selected>Sort By..</option>
                        <option class="selectable-option">Price: Low to High</option>
                        <option class="selectable-option">Price: High to Low</option>
                    </select>
                </div>
            </div>
        </div>
    </section>



    <div class="white-box">
        <div x-cloak x-show="filter === 'brand'">

        </div>

        <div x-cloak x-show="filter === 'type'">
            {{--   HOODIES & SWEATERS    --}}
            <section class="grid-view category-section" data-category="hoodies">
                <ul class="container mx-auto fixed-cards">
                    <li>
                        <h1 class="px-2 md:px-3">
                            <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hoodie.svg" style="filter: invert(0%) sepia(4%) saturate(0%) hue-rotate(309deg) brightness(93%) contrast(107%);"></div>
                            Hoodies & Sweaters
                        </h1>
                    </li>
                    @foreach($hoodies as $hoodie){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $hoodie->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                         "badgeText" => $hoodie->badge_text,
                         "thumbnail" => $hoodie->thumbnail,
                         "title" => $hoodie->name,
                         "cardDescription" => $hoodie->short_desc,
                         "fullPrice" => $hoodie->price,
                         "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                         "sizes" => $hoodie->sizes,
                         "soldOut" => !empty($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                         "category" => strtolower($hoodie->productType->name),
                         "size_case_sensitive" => $hoodie->size_case_sensitive,
                    ])
                    }
                    @endforeach
                </ul>
            </section>

            {{--   SHIRTS     --}}
            <section class="grid-view category-section" data-category="shirts">
                <ul class="container mx-auto fixed-cards">
                    <li>
                        <h1 class="px-2 md:px-3">
                            <div class="heading-icon text-black"><i class="fas fa-tshirt"></i></div>
                            T-shirts
                        </h1>
                    </li>

                    @foreach($shirts as $shirt){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $shirt->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                         "badgeText" => $shirt->badge_text,
                         "thumbnail" => $shirt->thumbnail,
                         "title" => $shirt->name,
                         "cardDescription" => $shirt->short_desc,
                         "fullPrice" => $shirt->price,
                         "price" => $shirt->discounted_price,
                         "sizes" => $shirt->sizes,
                         "soldOut" => !empty($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                         "size_case_sensitive" => $shirt->size_case_sensitive,
                         "category" => strtolower($shirt->productType->name),
                    ])
                    }
                    @endforeach
                </ul>
            </section>

            {{--   HATS     --}}
            <section class="grid-view category-section" data-category="hats">
                <ul class="container mx-auto fixed-cards">
                    <li>
                        <h1 class="px-2 md:px-3">
                            <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hat.svg" alt="hat icon" style="filter: invert(0%) sepia(4%) saturate(0%) hue-rotate(309deg) brightness(93%) contrast(107%);"></div>
                            Hats
                        </h1>
                    </li>

                    @foreach($hats as $hat){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $hat->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hat->slug ),
                         "badgeText" => $hat->badge_text,
                         "thumbnail" => $hat->thumbnail,
                         "title" => $hat->name,
                         "cardDescription" => $hat->short_desc,
                         "fullPrice" => $hat->price,
                         "price" => $hat->discounted_price,
                         "sizes" => $hat->sizes,
                         "soldOut" => !empty($products[$hat->sku]) ? $products[$hat->sku]->getStockAvailability() === 0 : $hat->sold_out,
                         "category" => strtolower($hat->productType->name),
                         "size_case_sensitive" => $hat->size_case_sensitive,
                    ])
                    }
                    @endforeach

                </ul>
            </section>

            {{--   ACCESSORIES     --}}
            <section class="grid-view category-section" data-category="accessories">
                <ul class="container mx-auto fixed-cards">
                    <li>
                        <h1 class="px-2 md:px-3">
                            <div class="heading-icon text-black"><i class="fas fa-suitcase"></i></div>
                            Accessories
                        </h1>
                    </li>
                    @foreach($accessories as $accessory){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                        "sku" => $accessory->sku,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "badgeText" => $accessory->badge_text,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "price" => $accessory->discounted_price,
                        "sizes" => $accessory->sizes,
                        "soldOut" => !empty($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "category" => strtolower($accessory->productType->name),
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                    }
                    @endforeach
                </ul>
            </section>
        </div>
    </div>

    @component('_partials.components.modal', ['name' => 'shippingModal'])
        @slot('content')
            <div class="max-w-2xl mx-auto">
                <div class="info-wrap shipping-info bg-white py-5 px-4 md:px-10 rounded-xl">
                    <p>
                        <strong class="font-extrabold">Free Shipping Over $100</strong> <br>
                        Spend over $100 and you'll unlock free worldwide shipping on any order.
                    </p>
                </div>
            </div>
        @endslot
    @endcomponent

    @component('_partials.components.modal', ['name' => 'orderModal'])
        @slot('content')
            <div class="max-w-2xl mx-auto">
                <div class="info-wrap shipping-info bg-white rounded-xl overflow-hidden text-center">
                    <div class="bg-drumeo py-10">
                        <img class="h-16" src="https://musora.s3.us-east-2.amazonaws.com/shipping-icon.svg" alt="shoppping icon" />
                    </div>
                    <div class="py-10 px-4 md:px-20">
                        <h4 class="font-bold mb-2">Just a heads up!</h4>
                        <p class="mb-4">
                            I understand that these items are preorders<br class="hidden md:inline-block"> and will not ship until <b>[date]</b>.
                        </p>
                        <div class="flex gap-2">
                            <a class="flex-1 rounded-full border-2 border-black uppercase text-black py-2 font-bold uppercase text-sm md:text-base" @click="orderModal = false">Cancel</a>
                            <a class="flex-1 rounded-full border-2 border-drumeo bg-drumeo uppercase text-white py-2 font-bold uppercase text-sm md:text-base" href="">I understand</a>
                        </div>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/misc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script>
        $(function () {
            $('.scalable-card').click(function (e) {
                e.stopPropagation();
                if (!$(e.target).is('.pack-pick') && !$(e.target).is('option') && !$(e.target).is('a') && !$(e.target).is('button')) {
                    $(this).toggleClass('flipped');
                }

            });

            //customize section pack picker
            var originalLink = '/ecommerce/add-to-cart?go-back-to-shop=true';

            $('select').prop('selectedIndex', 0);
            $(".pack-pick").change(function () {
                var orderButton = $(this).parent().find(".selected-pack");
                var selectedOption = $(this).find("option:selected");
                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', originalLink);
                orderButton.attr('href', orderButton.attr('href') + selectedOption.val());
                orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
            });

            $(".selected-pack").on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter = $(this).parent().find(".pack-pick");
                    selecter.addClass('error');
                }
            });
        });
    </script>
@endsection
