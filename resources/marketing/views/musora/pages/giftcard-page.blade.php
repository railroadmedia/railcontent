@php
    $variations = [
            (object)[
                "name" => "1 Month",
                "fullPrice" => 29,
                "price" => 29,
                "sku" => "PASS-1"
            ],
            (object)[
                "name" => "6 Month",
                "fullPrice" => 127,
                "price" => 127,
                "sku" => "PASS-6"
            ],
            (object)[
                "name" => "1 Year",
                "fullPrice" => 240,
                "price" => 240,
                "sku" => "PASS-12"
            ],
        ];
@endphp

@extends('musora._partials.layout')

@section('head-includes')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-product.css') }}" rel="stylesheet">
    @yield('head')
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
        }
    </style>
@stop

@section('layout-body')
    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            <div class="product-wrap lg:w-2/3 px-3 md:px-4">
                <div class="pack-details slider-wrap w-full pt-5 mx-auto mb-1 md:pt-9 md:mt-2 lg:pt-11 lg:mt-5">
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
                                <iframe class="absolute w-full h-full inset-0" src="//player.vimeo.com/video/113327941" frameborder="0" allowfullscreen id="videoPlayer"></iframe>
                                <div class="hidden" id="videoSrc">//player.vimeo.com/video/113327941</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="side-bar sliding-function lg:px-4 lg:w-1/3 px-3 md:px-4 md:pt-9 md:mt-2 lg:pt-11 lg:mt-5">
                <div class="lg:h-0">
                <div id="order" class="anchor"></div>
                    <div class="side-slide overflow-hidden rounded border border-solid" style="border-color: #CCD3D3;">
                        <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">
                            <h1 class="text-center text-3xl uppercase md:text-4xl">
                                <strong class="font-black">$<span class="chosen-variant-price-float">29</span></strong>
                            </h1>
                            <select class="pack-pick2 mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required>
                                <option hidden value="">Pick duration</option>
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
                                data-base-url="https://www.drumeo.com/laravel/public/shopping-cart/api/query?locked=true"
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
                <p>
                    The Musora gift card is a physical access pass that you can use for yourself, or to send as a gift to another musician. Simply choose a membership card with 1, 6, or 12 months of access. We'll ship it to your doorstep and it can be redeemed any time. <br><br>
                    Although the physical card has the Drumeo logo, this Musora gift card is an all-access pass to learn drums, piano, vocals, and guitar. You'll have full access to all four of our brands. Musora offers so many ways to build your musical ability: <br><br>
                </p>
                <ul class="pl-8" style="list-style: disc;">
                    <li>Method: A 10-level step-by-step curriculum that shows you exactly what to practice next.</li>
                    <li>Songs: On-screen practice tools so you can play with a metronome, create loops, and learn songs faster.</li>
                    <li>Support: One-on-one instructor feedback, weekly live streams, community forums, and a Musora Mentor to help guide you!</li>
                </ul>
            </div>
        </div>
    </div>
@stop

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/pack-drumshop.js') }}"></script>
    <script>
        $(document).ready(function () {
            //customize section pack picker
            var originalLink2 = 'https://www.drumeo.com/laravel/public/shopping-cart/api/query?locked=true';

            $('select').prop('selectedIndex', 0);
            $('.pack-pick2').change(function () {
                var orderButton = $(this).parent().find('.selected-pack2');
                var selectedOption = $(this).find('option:selected');
                var selectedPrice = $(selectedOption).data('price');
                var variantPriceSpanElement = $(this).parent().find('.chosen-variant-price-float2');

                variantPriceSpanElement.html(selectedPrice);

                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', originalLink2);
                orderButton.attr('href', orderButton.attr('href') + '&products[' + selectedOption.val() + ']=1');
                orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
            });

            $('.selected-pack2').on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter = $(this).parent().find('.pack-pick2');
                    selecter.addClass('error');
                }
            });

        });

    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@endsection
