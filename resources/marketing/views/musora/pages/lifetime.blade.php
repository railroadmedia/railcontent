@extends('musora._partials.layout')

@section('head-includes')
    <title>Lifetime Deal | Musora</title>
    <meta property="og:title" content="Musora | Lifetime Deal">

    <meta name="description" content="Unlimited music lessons for life.">
    <meta property="og:description" content="Unlimited music lessons for life.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <style>
        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }
        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background-color:#FFAE00;
            border-radius:50px;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            filter: brightness(1.05);
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }


        .join.smaller {
            padding:14px 30px;
            font-size:18px;
        }
         .join.musora {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora:hover, .join.musora:focus {
            background:#FFAE00;
            color:#000;
            filter: brightness(1.05);
        }
    </style>
    
@endsection


<!-- Main -->
@section('layout-body')

    {{-- @php
        if(!empty($products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability())) {
            $stock = $products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability() - 16;
        }
        else {
            $stock = 0;
        }
    @endphp --}}
{{--    @include('_partials.components.shop.promo-banner', [--}}
{{--                "name" => "Lifetime",--}}
{{--                "fullPrice" => 1200,--}}
{{--                "price" => 1200,--}}
{{--                    "specialText" => "<strong>Only <s class='opacity-60'>100</s> <span class='text-promo'>" . $stock . "</span> left!</strong>",--}}
{{--                "noBreadcrumb" => true,--}}
{{--                "noCountdown" => true--}}
{{--            ])--}}
<div x-data="scrollComponent">
    <section class="text-white relative overflow-hidden z-10 object-cover object-center py-10 md:py-20" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/musora/promos/november/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="container mx-auto text-center px-4">
        <img alt="Bundle" class="h-10 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-logo.svg"><br>
                <h2 class="leading-tight pt-3 lg:pt-6"><strong>Unlimited music lessons for life.</strong></h2>
                <h5 class="italic">Your last chance to grab a Lifetime Membership at the old price.</h5>
{{--                <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                    <span>--}}
{{--                        ENDS IN--}}
{{--                        <strong class="text-bold">--}}

{{--                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span--}}
{{--                                    x-text="dayText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span--}}
{{--                                    x-text="hourText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span--}}
{{--                                    x-text="minuteText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span--}}
{{--                                    x-text="secondText"></span></span>--}}
{{--                        </strong>--}}
{{--                    </span>--}}
{{--                </span>--}}

            <div class="w-full max-w-4xl mx-auto my-4 sm:my-8 ">
                <img alt="Bundle" class="w-full h-full opacity-0 transition-opacity duration-500" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/musora/promos/november/musora-devices.webp" loading="lazy" onload="this.classList.remove('opacity-0')"><br>            
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1"><strong>$1200 </strong><span class="text-musora text-2xl"> (last chance)</span></h2>
                
               {{-- @if($stock > 0) --}}
                   <a class="join musora mt-4 w-full text-black sm:max-w-[420px]"  @click="scrollToFinal" >GET THE DEAL</a>
                   <p class="leading-tight text-sm underline pt-2"><em>Payment plans available.</em></p>
               {{-- @else
                    <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
               @endif --}}
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative overflow-hidden bg-black text-white">
        <div class="container mx-auto max-w-4xl z-10 relative">
            <img class="h-16 md:h-20 mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-title.webp">
            <p class="leading-tight mb-4"><em>You’ll have a lifetime of unlimited music lessons for <br class="hidden sm:inline lg:hidden">the price of 5 years of access to Musora ($1200 total).</em></p>
            <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/musora/promos/november/timeline.webp">
            <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/promos/november/timeline-m.webp">
        </div>
    </section>
    <section class="bg-gray-100 py-8 px-4 lg:py-24 lg:px-8">
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center gap-8">
            <div class="w-full sm:w-10/12 md:w-5/12">
                <img 
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/musora/membership/homepage/webp-format/musora-m-team2.webp" 
                    alt="Group of people" 
                    class="w-full"
                />
            </div>

            <div class="w-full sm:w-10/12 md:w-1/2 text-left sm:text-center md:text-left lg:pl-6">
                <h3 class="mb-6">
                <strong>
                   The Times They Are A’ Changin
                </strong>
                </h3>
                <p class="mb-2 md:mb-4">
                    All good things must come to an end.
                </p>
                <p class="mb-2 md:mb-4">
                    And as your Musora Membership continues to expand with new courses, challenges, and instrument additions (and even more to come)...
                </p>
                <p class="mb-2 md:mb-4">
                     We can’t continue offering Lifetime Memberships for $1200.
                </p>
                <p class="mb-2 md:mb-8">
                    The price is going up next year.
                </p>
                <p class="mb-2 md:mb-8">
                    So this is your LAST CHANCE to lock in a lifetime of music lessons (drumming, singing, guitar, piano, and anything else added) at the old price.
                </p>
                <a 
                    href="/ecommerce/add-to-cart?products[musora-lifetime-membership-access]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true" 
                    class="join w-full sm:max-w-[350px] musora smaller mt-4 md:mt-0"
                >
                    GET THE DEAL
                </a>
            </div>
        </div>
    </section>
    
    @include('drumeo._partials.countdown-bundle-2024')

    <div id="final"></div>
    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background:linear-gradient(to bottom, #131633, #000000);"
    >
        <div class="container mx-auto relative z-50 max-w-4xl">
            <img alt="Bundle" class="h-10 sm:h-12 md:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-logo.svg"><br>
            <h3 class="leading-tight pt-2 md:pt-6"><strong>Your last chance to grab a Lifetime <br class="hidden sm:block">Membership at the old price.</strong></h3>
            <div class="w-full pt-2 md:pt-6">
            <img class="max-w-sm bg-center bg-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1250x0/filters:quality(95)/marketing/musora/promos/november/order.webp" alt="Lifetime Card Image">
                <br>
                {{-- <h2 class="leading-tight mt-4 sm:mt-6 mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2> --}}
               {{-- @if($stock > 0) --}}
                    <h2 class="leading-none my-4 md:my-6"><strong>$1200 </strong><span class="text-musora text-2xl"> (Last Chance)</span></h2>
                    <a class="join musora w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;" href="/ecommerce/add-to-cart?products[musora-lifetime-membership-access]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                    <p class="leading-tight text-sm underline pt-2"><em>Payment plans available.</em></p>
               {{-- @else
                    <span class="join sold-out mt-4 md:mt-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;">SOLD OUT</span>
               @endif --}}
            </div>
           
{{--            @if($stock > 0)--}}
{{--                <a class="join drumeo my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>--}}
{{--                <a class="inline-block leading-tight text-white" href="{{ $buttonLink2 }}"><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>--}}
{{--            @else--}}
                {{-- <a class="join sold-out my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;">SOLD OUT</a> --}}
{{--            @endif--}}
        </div>
    </section>
</div>

@if(Carbon\Carbon::create(2024, 12, 02, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
    {{--    end of BF weekend--}}
    @include('_partials.components.countdown',[
        'countdownDate' => '2024-12-02 00:00:00',
        'promoVersion' => true
    ])
@else
    {{--    end of cyber monday--}}
    @include('_partials.components.countdown',[
        'countdownDate' => '2024-12-03 00:00:00',
        'promoVersion' => true
    ])
@endif
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scrollComponent', () => ({
            scrollToFinal() {
                const finalSection = document.getElementById('final');
                if (finalSection) {
                    finalSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        }));
    });
</script>
@stop


