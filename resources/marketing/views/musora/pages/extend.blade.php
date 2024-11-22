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
                <h2 class="leading-tight pt-3 lg:pt-6"><strong>Get a free $100 electronic gift card <br> when you extend your membership.</strong></h2>

            <div class="w-full max-w-4xl mx-auto my-4 sm:my-8 ">
                <img alt="Bundle" class="w-full h-full opacity-0 transition-opacity duration-500" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/musora/promos/november/musora-devices.webp" loading="lazy" onload="this.classList.remove('opacity-0')"><br>
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1"><strong>$240 </strong></h2>

               {{-- @if($stock > 0) --}}
                <a
                    href="/ecommerce/add-to-cart?products[musora-lifetime-membership-access]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true"
                    class="join w-full sm:max-w-xs musora smaller mt-4"
                >
                    GET THE DEAL
                </a>
               {{-- @else
                    <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
               @endif --}}
            </div>
        </div>
    </section>
    <section class="py-8 px-4 lg:py-16 lg:px-8">
        <div class="container mx-auto max-w-2xl">

            <div class="w-full text-left">
                <p class="leading-normal">
                    Here are the details:
                </p>
                <ul class="fa-ul list-disc pl-4 my-4">
                    <li class="leading-normal mb-2"><strong>Membership Extension:</strong> Your Musora+ membership will be extended beyond the current renewal date – to add one full year, no matter when your renewal date is scheduled.</li>
                    <li class="leading-normal mb-2"><strong>All-Access:</strong> Your membership extension gives you access to Drumeo, Pianote, Guitareo, Singeo – and includes our Songs experience.</li>
                    <li class="leading-normal mb-2"><strong>Receive Store Credit:</strong> You’ll receive an email with an electronic gift card with $100 that will work in any of the Musora stores.</li>
                    <li class="leading-normal"><strong>Redeem Store Credit:</strong> Simply apply the e-gift card code during checkout to redeem your store credit. There’s no expiration date – so you can use it whenever you want on the music accessories or merchandise of your preference.</li>
                </ul>
                <p class="leading-normal">
                    This offer is only available for Black Friday – and only for existing Musora members (Drumeo, Pianote, Guitareo, Singeo).
                </p>
            </div>
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


