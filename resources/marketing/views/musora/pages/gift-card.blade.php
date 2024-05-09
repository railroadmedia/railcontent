@extends('musora._partials.layout')

@section('head-includes')
    <title>The perfect gift for ANY musician! | Musora</title>
    <meta property="og:title" content="The perfect gift for ANY musician! | Musora">

    <meta name="description" content="The Musora gift card is a physical access pass that you can use for yourself, or to send as a gift to another musician.">
    <meta property="og:description" content="The Musora gift card is a physical access pass that you can use for yourself, or to send as a gift to another musician.">

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
                                <div class="text-xl md:text-3xl lg:text-4xl leading-none font-black">The perfect gift for ANY musician!</div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-container overflow-hidden w-full mb-5 md:mb-7" style="font-size: 0;">
                        <div class="slider-for overflow-hidden rounded">
                            <div class="overflow-hidden relative w-full" style="padding-bottom: 56.25%;">

                                <picture>
                                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1480x0/filters:quality(95)/marketing/musora/membership/redeem/redeem-thumb.jpg">
                                    <img class="absolute w-full h-full inset-0 object-cover"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/musora/membership/redeem/redeem-thumb.jpg"
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
                                <strong class="font-black">$<span class="chosen-variant-price-float">87</span></strong>
                            </h1>
                            <select class="pack-pick2 mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Bebas Neue, sans-serif" title="Shirt Size" required>
                                <option hidden value="">Pick duration</option>
                                @php
                                    $variations = [
                                            (object)[
                                                "name" => "90 Day Access Pass",
                                                "fullPrice" => 87,
                                                "price" => 87,
                                                "sku" => "musora-membership-gift-card-90-days"
                                            ],
                                            (object)[
                                                "name" => "1 Year Access Pass",
                                                "fullPrice" => 240,
                                                "price" => 240,
                                                "sku" => "musora-membership-gift-card-1-year"
                                            ],
                                        ];
                                @endphp
                                @foreach($variations as $variant)
                                    <option
                                        class="bg-white text-black"
                                        @if(isset($variant->soldOut) && $variant->soldOut) disabled @endif
                                    value="{{$variant->sku}}"
                                        data-price="{{$variant->price ?? 0}}"
                                        data-product-json='{"{{$variant->sku}}": 1}'
                                    >{{ $variant->name }}</option>
                                @endforeach
                            </select>
                            <a
                                class="online-atc merch vue-add-to-cart selected-pack2"
                                href="#"
                                data-base-url="https://www.drumeo.com/ecommerce/add-to-cart?locked=true"
                            >
                                <button class="join border-none mt-2 mb-4 w-full" style="background: #000;font: 400 20px/1em 'Bebas Neue', sans-serif !important;">
                                    <i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart
                                </button>
                            </a>
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
                <p>The Musora gift card is a physical access pass that you can use for yourself, or to send as a gift to another musician. Simply choose a membership card with 3 months or 1 year of access. We'll ship it to your doorstep and it can be <a class="text-blue-500" href="/redeem">redeemed any time</a>.
                    <br><br>
                    This gift card is an all-access pass to learn drums, piano, vocals, and guitar. You'll have full access to all four of our brands. Musora offers so many ways to build your musical ability:
                    <br><br>
                </p>
                <ul class="pl-8" style="list-style: disc;">
                    <li><strong>Method:</strong> A 10-level step-by-step curriculum that shows you exactly what to practice next.</li>
                    <li><strong>Songs:</strong> On-screen practice tools so you can play with a metronome, create loops, and learn songs faster.</li>
                    <li><strong>Support:</strong> One-on-one instructor feedback, weekly live streams, community forums, and a Musora Mentor to help guide you!</li>
                </ul>
            </div>
        </div>
    </div>
@stop

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var originalLink2 = 'https://www.drumeo.com/ecommerce/add-to-cart?locked=true';
            var selects = document.querySelectorAll('.pack-pick2');
            var priceSpan = document.querySelector('.chosen-variant-price-float');
            var orderButton = document.querySelector('.selected-pack2');

            selects.forEach(select => {
                select.selectedIndex = 0;
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    priceSpan.innerHTML = selectedOption.dataset.price;
                    this.classList.remove('error');
                    orderButton.classList.add('active');
                    orderButton.href = originalLink2 + '&products[' + selectedOption.value + ']=1';
                    orderButton.dataset.productJson = selectedOption.dataset.productJson;
                });
            });

            orderButton.addEventListener('click', function(ev) {
                if (!this.classList.contains('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    selects[0].classList.add('error');
                }
            });
        });
    </script>
@endsection
