@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Survey Offer</title>
    <meta property="og:title" content="Survey Offer">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "subscriptionVersion" => true,
        "scrollToJoin" => true
    ])
    <section
        class="py-14 sm:py-20 lg:py-32 relative overflow-hidden text-white text-center px-4 sm:px-6 relative overflow-hidden text-center relative z-50 lazyload"
        style="background-color:#0C1524;"
        x-data="{
            selectedNum: 0,
            query: '',
        }"
    >
        <div class="container mx-auto max-w-4xl relative z-50">
            <h3><strong>Thank You!</strong></h3>
            <h5 class="mt-2 mb-7 sm:mb-10" style="line-height: 1.4em;">Save 60% on the Following Products (You can choose more than one!)</h5>

            <div class="mx-auto max-w-xs sm:max-w-full" style="font-size: 0;">
                @php

                    $bonuses = [
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
                            'title' => 'Practice<br> Planner',
                            'description' => 'Always know exactly what to practice.',
                            'price' => 39,
                            'discount-price' => 15.60,
                            'shipping' => true,
                            'sku' => '&products[pianote-practice-planner]=1',
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                            'title' => 'Piano Chords<br> & Scales',
                            'description' => 'Your encyclopedia of piano chords & scales.',
                            'price' => 39,
                            'discount-price' => 15.60,
                            'shipping' => true,
                            'sku' => '&products[piano-chords-and-scales-guide]=1',
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Piano_Chords_Card.jpg',
                            'title' => 'Chords<br> Poster',
                            'description' => 'Hang these piano chords in your practice space.',
                            'price' => 9,
                            'discount-price' => 3.60,
                            'shipping' => true,
                            'sku' => '&products[poster-chords]=1',
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Piano_Scales_Card.jpg',
                            'title' => 'Scales<br> Poster',
                            'description' => 'All the major and minor piano scales in one poster.',
                            'price' => 9,
                            'discount-price' => 3.60,
                            'shipping' => true,
                            'sku' => '&products[poster-scales]=1',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4"
                        x-data="{
                            selected: false,
                        }"
                        x-on:click="
                            if (selected){
                                selected = !selected;
                                query = query.replace('{{ $bonus['sku'] }}', '');
                                selectedNum--;
                            } else if(!selected) {
                                selected = !selected;
                                selectedNum++;
                                query = query + '{{ $bonus['sku'] }}';
                            }
                        "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-pianote front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    :class="selected && 'border-4'"
                                    style="backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                    @endif
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/{{ $bonus['image'] }});"></div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                            <span class="leading-tight inline-block">{!!  $bonus['title']  !!}</span><br>
                        </p>
                        <h5 class="w-full leading-normal uppercase">
                                <s class="opacity-40">${{ $bonus['price'] }}</s> <strong class="text-promo font-black">${{ number_format($bonus['discount-price'], 2) }}</strong>
                        </h5>
                    </div>
                @endforeach
            </div>
            <a
                class="join pianote my-4 md:my-8 w-full max-w-xs sm:max-w-md lg:max-w-xl"
                :class="selectedNum === 0 && 'sold-out'"
                :href="selectedNum !== 0 ? '/ecommerce/add-to-cart?promo-code=survey'+query : '#customize-anchor'"
                x-text="selectedNum !== 0 ? 'CHECKOUT &raquo;' : 'Choose products'"></a>
        </div>
    </section>


    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-30 23:59:59',
        'promoVersion' => false
    ])
@stop
