@extends('_partials.layout.global-template')

@section('layout-styles')
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>

        .splide__arrow--next {
            right: -12px;
        }

        @media (min-width: 1140px) {
            .splide__arrow--next {
                right: -50px;
            }
        }
        .splide__arrow svg{
            fill: #0B76DB !important;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
        shippingModal: false,
        @yield('x-data')
    }"
@endsection

@section('layout-body')

    @yield('body')

    @component('_partials.components.modal', ['name' => 'shippingModal'])
        @slot('content')
            <div class="max-w-2xl mx-auto">
                <div class="info-wrap shipping-info bg-white py-5 px-4 md:px-10 rounded-xl">
                    <p>
                        <strong class="font-extrabold">Free Shipping Over $150</strong> <br>
                        Spend over $150 and you'll unlock free worldwide shipping on any order (e-kit excluded).
                    </p>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection


@section('layout-scripts')
    @if(Carbon\Carbon::create(2024, 7, 18, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        @include('_partials.components.countdown',[
            'countdownDate' => '2024-07-18 00:00:00',
            'promoVersion' => true
        ])
    @else
        @include('_partials.components.countdown',[
            'countdownDate' => '2023-08-01 00:00:00',
            'promoVersion' => true
        ])
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/misc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <!-- {{-- Platform --}}-->
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script>
        var Sorting = {
            sortItems: function(sortValue, sortDirection){
                var sortItems = [];

                $('.product-wrap').each(function(){
                    var thisItem = $(this),
                        thisData = $(this).data(sortValue);

                    sortItems.push({
                        item: thisItem,
                        data: thisData
                    });
                });

                if(sortDirection === 'desc'){
                    sortItems.sort(
                        Sorting.dynamicSort('data')
                    );
                }
                else {
                    sortItems.sort(
                        Sorting.dynamicSort('-data')
                    );
                }

                $.each(sortItems, function(){
                    var thisItem = $(this.item),
                        lastItem = $(sortItems[sortItems.length - 1].item);

                    thisItem.insertBefore(lastItem);
                });
            },
            sortInSection: function(sortValue, sortDirection){
                var sections = $('.category-section');

                sections.each(function(){
                    var sortItems = [];
                    var sectionCards = $(this).find('.product-wrap');

                    sectionCards.each(function(){
                        var thisItem = $(this),
                            thisData = $(this).data(sortValue);

                        sortItems.push({
                            item: thisItem,
                            data: thisData
                        });
                    });

                    if(sortDirection === 'desc'){
                        sortItems.sort(
                            Sorting.dynamicSort('data')
                        );
                    }
                    else {
                        sortItems.sort(
                            Sorting.dynamicSort('-data')
                        );
                    }

                    $.each(sortItems, function(){
                        var thisItem = $(this.item),
                            lastItem = $(sortItems[sortItems.length - 1].item);

                        thisItem.insertBefore(lastItem);
                    });
                });
            },
            dynamicSort: function(property){
                var sortOrder = 1;

                if(property[0] === "-") {
                    sortOrder = -1;
                    property = property.substr(1);
                }
                return function (a,b) {
                    var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
                    return result * sortOrder;
                };
            }
        };

        $(function () {
            $('#sortOrder')
                .change(function () {
                    switch($(this).val()){
                        case 'Price: Low to High':
                            Sorting.sortItems('price', 'desc');
                            break;
                        case 'Price: High to Low':
                            Sorting.sortItems('price', 'asc');
                            break;
                    }
                });

            $('#sortBySection')
                .change(function () {
                    switch($(this).val()){
                        case 'Price: Low to High':
                            Sorting.sortInSection('price', 'desc');
                            break;
                        case 'Price: High to Low':
                            Sorting.sortInSection('price', 'asc');
                            break;
                    }
                });
        });

        $(function () {
            $('.product-wrap').click(function (e) {
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
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
  
@endsection
