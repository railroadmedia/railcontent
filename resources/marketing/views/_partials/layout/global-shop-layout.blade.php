@extends('_partials.layout.global-template')

@section('layout-styles')
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop.css') }}" rel="stylesheet">
@endsection

@section('body-data')
    x-data="{
        shippingModal: false,
        @yield('x-data')
    }"
@endsection

@section('layout-body')
    <div class="shipping-delay p-2 z-50">
        <div class="delay-bar text-center">
            <div class="container mx-auto">
                <p class="cursor-pointer hover:underline" @click="shippingModal = true;"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $150</strong></p>
            </div>
        </div>
    </div>

    @yield('body')

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
@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/misc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
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
