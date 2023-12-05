@extends('_partials.layout.global-template')

@section('meta')
    <title>Musora Shop</title>
    <meta property="og:title" content="Musora Shop">
    <meta name="description" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/shop/header-m.jpg">
    <meta property="og:url" content="https://www.musora.com/merch">
@endsection

@section('layout-styles')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">--}}
    <style>
        .shop-header {
            background-image:url(https://www.musora.com/musora-cdn/image/width=800,quality=95/https://dmmior4id2ysr.cloudfront.net/shop/header-m.jpg);
        }
        @media (min-width: 768px) {
            .shop-header {
                background-image:url(https://www.musora.com/musora-cdn/image/width=2500,quality=95/https://dmmior4id2ysr.cloudfront.net/shop/header.jpg);
            }
        }
        footer a {
            color: #879097;
        }

        footer a:hover {
            color: #a2a9af;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
        shippingModal: false,
        orderModal: false,
        filter: 'type',
    }"
@endsection

@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-musora",
        "theme_text" => "text-musora",
        "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
        "links" => [
            "Home" => [
                "iconClass" => "fas fa-home",
                "url" => "/",
            ],
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Careers" => [
                "iconClass" => "fas fa-users",
                "url" => '/careers',
            ],
            "About" => [
                "iconClass" => "fas fa-question",
                "url" => '/about',
            ],
            "Ambassador Program" => [
                "iconClass" => "fas fa-comment-dollar",
                "url" => '/ambassador',
            ],
            "Brand Guides" => [
                "iconClass" => "fas fa-pencil-paintbrush",
                "url" => '/brand',
            ],
        ],
        "external_links" => [
            "Drumeo" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("drumeo")
            ],
            "Pianote" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("pianote")
            ],
            "Guitareo" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("guitareo")
            ],
            "Singeo" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("singeo")
            ]
        ]
    ])
@endsection

@section('layout-body')
    <div class="shipping-delay p-2">
        <div class="delay-bar text-center">
            <div class="container mx-auto">
                <p class="inline-block cursor-pointer hover:underline" @click="shippingModal = true;"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $150</strong></p>
                <p class="inline-block uppercase"><strong> | All items are pre-order only and ship within 2-4 weeks of purchase date.</strong></p>
            </div>
        </div>
    </div>

    <header class="shop-header text-center text-white relative py-7 sm:py-10 bg-cover bg-center" style="background-color:#140c08;">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="h-10 md:h-16 mb-2 sm:mb-4" src="https://dmmior4id2ysr.cloudfront.net/shop/musora-member-logo.svg" alt="drumeo logo">
                <p>As a Musora Member you’re getting exclusive access to <strong>NEW</strong><br class="hidden sm:inline-block"> limited edition merch designed for musicians – by musicians.</p>
                <p><strong><em>Pre-orders are now closed</em></strong></p>
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

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        <div>
            <section class="grid-view category-section" data-category="hoodies">
                <div class="container mx-auto">
                    <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Hoodies</strong></h5>
                    <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                        @foreach($hoodies as $hoodie)
                            @include('_partials.components.shop.product-card', [
                                 "sku" => $hoodie->sku,
                                 "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                                 "badgeText" => $hoodie->badge_text,
                                 "thumbnail" => $hoodie->thumbnail,
                                 "title" => $hoodie->name,
                                 "cardDescription" => $hoodie->short_desc,
                                 "fullPrice" => $hoodie->price,
                                 "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                                 "sizes" => $hoodie->sizes,
                                 "soldOut" => isset($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                                 "category" => strtolower($hoodie->productType->name),
                                 "size_case_sensitive" => $hoodie->size_case_sensitive,
                            ])
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="grid-view category-section" data-category="shirts">
                <div class="container mx-auto">
                    <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                    <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                        @foreach($shirts as $shirt)
                            @include('_partials.components.shop.product-card', [
                                 "sku" => $shirt->sku,
                                 "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                                 "badgeText" => $shirt->badge_text,
                                 "thumbnail" => $shirt->thumbnail,
                                 "title" => $shirt->name,
                                 "cardDescription" => $shirt->short_desc,
                                 "fullPrice" => $shirt->price,
                                 "price" => $shirt->discounted_price,
                                 "sizes" => $shirt->sizes,
                                 "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                                 "size_case_sensitive" => $shirt->size_case_sensitive,
                                 "category" => strtolower($shirt->productType->name),
                            ])
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="grid-view category-section" data-category="misc">
                <div class="container mx-auto">
                    <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Hats</strong></h5>
                    <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                        @foreach($misc as $miscItem)
                            @include('_partials.components.shop.product-card', [
                                 "sku" => $miscItem->sku,
                                 "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),
                                 "badgeText" => $miscItem->badge_text,
                                 "thumbnail" => $miscItem->thumbnail,
                                 "title" => $miscItem->name,
                                 "cardDescription" => $miscItem->short_desc,
                                 "fullPrice" => $miscItem->price,
                                 "price" => $miscItem->discounted_price,
                                 "sizes" => $miscItem->sizes,
                                 "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,
                                 "category" => strtolower($miscItem->productType->name),
                                 "size_case_sensitive" => $miscItem->size_case_sensitive,
                            ])
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
    </div>

    @component('_partials.components.modal', ['name' => 'shippingModal'])
        @slot('content')
            <div class="max-w-2xl mx-auto">
                <div class="info-wrap shipping-info bg-white py-5 px-4 md:px-10 rounded-xl">
                    <p>
                        <strong class="font-extrabold">Free Shipping Over $150</strong> <br>
                        Spend over $150 and you'll unlock free worldwide shipping on any order.
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
                            I understand that these items are preorders<br class="hidden md:inline-block"> and will not ship until after <b>March 1st, 2023</b>.
                        </p>
                        <div class="flex gap-2">
                            <a class="flex-1 rounded-full border-2 border-black uppercase text-black py-2 font-bold uppercase text-sm md:text-base" @click="orderModal = false">Cancel</a>
                            <a class="understand-button flex-1 rounded-full border-2 border-drumeo bg-drumeo uppercase text-white py-2 font-bold uppercase text-sm md:text-base" href="">I understand</a>
                        </div>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection

@section('layout-footer')
    @include('_partials.layout.global-footer', [
    "brand" => "musora",
    "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png"
])
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
            var originalLink = '/ecommerce/add-to-cart';
            let understandbutton = $('.understand-button');

            $('select').prop('selectedIndex', 0);
            $(".pack-pick").change(function () {
                var orderButton = $(this).parent().find(".selected-pack");
                var selectedOption = $(this).find("option:selected");
                $(this).removeClass('error');

                orderButton.addClass('active');
                orderButton.attr('x-on:click', 'orderModal = true')
                orderButton.attr('href-value', originalLink + selectedOption.val());

                // orderButton.attr('href', originalLink);
                // orderButton.attr('href', orderButton.attr('href') + selectedOption.val());
                // orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
            });

            $(".selected-pack").click(function(){
                console.log($(this).attr('x-on:click'))
                if($(this).attr('x-on:click')){
                    console.log($(this).attr('href-value'))
                    understandbutton.attr('href', $(this).attr('href-value'));
                }
            })

            $(".add-to-cart-button").click(function(e){
                understandbutton.attr('href', originalLink + $(this).attr('value'));
            })

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
