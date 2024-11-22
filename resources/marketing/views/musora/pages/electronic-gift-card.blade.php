@extends('musora._partials.layout')

@section('head-includes')
    <title>Electronic gift cards | Musora</title>
    <meta property="og:title" content="Electronic gift cards | Musora">

    <meta name="description" content="The Musora electronic gift card gives you store credit to use in any of our online shops including Drumeo, Pianote, Guitareo, and Singeo.">
    <meta property="og:description" content="The Musora electronic gift card gives you store credit to use in any of our online shops including Drumeo, Pianote, Guitareo, and Singeo.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    @yield('head')
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
        }
        .pack-pick2.error {
            border-color: red!important;
            background-color: #ffcccc!important;
        }
    </style>
@stop

@section('layout-body')
    <div class="clearfix container mx-auto max-w-6xl relative pt-5 md:pt-9 lg:pt-11">
        <div class="lg:flex">
            <div class="product-wrap lg:w-2/3 px-3 md:px-4">
                <div class="pack-details slider-wrap w-full mx-auto mb-1">
                    <div class="text-center pb-5 sm:pb-6 lg:pb-7">
                        <div class="clearfix">
                            <div class="w-full">
                                <div class="text-xl md:text-3xl lg:text-4xl leading-none font-black">The electronic gift card for all of our stores!</div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-container overflow-hidden w-full mb-5 md:mb-7" style="font-size: 0;">
                        <div class="slider-for overflow-hidden rounded">
                            <div class="overflow-hidden relative w-full" style="padding-bottom: 56.25%;">

                                <picture>
                                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1480x0/filters:quality(95)/marketing/musora/membership/redeem/e-card.png">
                                    <img class="absolute w-full h-full inset-0 object-cover"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/musora/membership/redeem/e-card.png"
                                        alt="card image" fetchpriority="high">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:px-4 lg:w-1/3 px-3 md:px-4 mb-4 lg:mb-0">
                <div class="lg:h-0">
                    <div id="order" class="anchor"></div>
                    <div id="sticky-slide" class="overflow-hidden rounded border border-solid border-gray-300">
                        <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">
                            <h1 class="text-center text-3xl uppercase md:text-4xl">
                                <strong class="font-black">$<span class="chosen-variant-price-float">50</span></strong>
                            </h1>
                            <select class="pack-pick2 mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Bebas Neue, sans-serif" title="Shirt Size" required>
                                <option hidden value="">Choose Amount</option>
                                @php
                                    $prices = [50, 100, 150, 240, 300];
                                    $variations = collect($prices)->map(function ($price) {
                                        return (object)[
                                            "name" => "\${$price} E-Card",
                                            "fullPrice" => $price,
                                            "price" => $price,
                                            "sku" => "musora-gift-card-{$price}"
                                        ];
                                    });
                                @endphp
                                @foreach($variations as $variant)
                                    <option
                                        class="bg-white text-black"
                                        @if(isset($variant->soldOut) && $variant->soldOut) disabled @endif
                                    value="{{ $variant->sku }}"
                                        data-price="{{ $variant->price }}"
                                        data-product-json='{"{{ $variant->sku }}": 1}'
                                    >
                                        {{ $variant->name }}
                                    </option>
                                @endforeach
                            </select>
                            <a
                                class="online-atc merch vue-add-to-cart selected-pack2"
                                href="#"
                                data-base-url="https://www.drumeo.com/ecommerce/add-to-cart?"
                            >
                                <button class="join border-none mt-2 mb-4 w-full" style="background: #000;font: 400 20px/1em 'Bebas Neue', sans-serif !important;">
                                    <i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart
                                </button>
                            </a>
                            <p class="text-sm mb-4" style="color:#878C92;"><em>All prices in USD</em></p>
                            <p class="italic text-center mx-auto my-0 text-xs">
                                You can also order by phone toll-free at<br class="hidden sm:inline">
                                <a href="tel:+18004398921">1-800-439-8921</a> or directly at
                                <a href="tel:+16048557605">1-604-855-7605</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-wrap lg:w-2/3 px-3 md:px-4">
            <div class="pack-details mx-auto mb-7 pb-5 sm:pb-9 lg:pb-11">
                <p class="mb-4">The Musora electronic gift card gives you store credit to use in any of our online shops including Drumeo, Pianote, Guitareo, and Singeo. You can use this credit to purchase a membership, digital products, or physical products – and it can be redeemed at any time, so it’s easy to gift to a friend or keep it for yourself. 
                    <br><br>
                    Here’s how it works:</p>
                <ul class="pl-6 list-disc">
                    <li><strong>Purchase store credit:</strong> When you complete a purchase of an electronic gift card, you’ll receive an email with an electronic gift card code that will work in any of the Musora stores. </li>
                    <li><strong>Redeem store credit:</strong> Simply apply the e-gift card code during checkout to redeem your store credit. </li>
                </ul>
                <p class="my-4">Choose your preference from our three different gift card amounts:</p>
                <ul class="pl-6 list-disc">
                    <li>$50 | Great for digital packs. </li>
                    <li>$100 | Great for practice tools. </li>
                    <li>$240 | Covers a 1-year membership. </li>
                </ul>
                <p class="mt-4">There’s no expiration date – making it the perfect gift card for anybody who’s interested in our music lessons, practice tools, or merchandise. 
                </p>
            </div>
        </div>
    </div>
@stop

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const originalLink = 'https://www.drumeo.com/ecommerce/add-to-cart?';
            const selectElement = document.querySelector('.pack-pick2');
            const priceSpan = document.querySelector('.chosen-variant-price-float');
            const orderButton = document.querySelector('.selected-pack2');

            // Get URL parameter by name
            const getUrlParameter = (name) => new URLSearchParams(window.location.search).get(name);

            // Update dropdown, price span, and order button
            const updateSelection = (select, price, sku, productJson) => {
                priceSpan.textContent = price;
                orderButton.classList.add('active');
                orderButton.href = `${originalLink}&products[${sku}]=1`;
                orderButton.dataset.productJson = productJson;
            };

            // Pre-select option based on URL parameter
            const preSelectedAmount = getUrlParameter('amount');
            if (preSelectedAmount && selectElement) {
                const options = Array.from(selectElement.options);
                const matchedOption = options.find(option => option.dataset.price === preSelectedAmount);
                if (matchedOption) {
                    selectElement.value = matchedOption.value;
                    updateSelection(
                        selectElement,
                        matchedOption.dataset.price,
                        matchedOption.value,
                        matchedOption.dataset.productJson
                    );
                }
            }

            // Handle dropdown change
            selectElement?.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption) {
                    updateSelection(
                        this,
                        selectedOption.dataset.price,
                        selectedOption.value,
                        selectedOption.dataset.productJson
                    );
                }
            });

            // Prevent order button click if no option is selected
            orderButton?.addEventListener('click', function (event) {
                if (!this.classList.contains('active')) {
                    event.preventDefault();
                    selectElement?.classList.add('error');
                }
            });
        });
    </script>
@endsection
