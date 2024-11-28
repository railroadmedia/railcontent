@php
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data-2024.php'));
@endphp

@extends('musora._partials.layout', [
    'hideJoin' => true,
])

@section('head-includes')
    <title>Extend your membership | Musora</title>
    <meta property="og:title" content="Extend your membership | Musora">

    <meta name="description" content="Your Musora+ membership will be extended beyond the current renewal date – to add one full year, no matter when your renewal date is scheduled.">
    <meta property="og:description" content="Your Musora+ membership will be extended beyond the current renewal date – to add one full year, no matter when your renewal date is scheduled.">

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

@section('layout-body')
<div x-data="scrollComponent">
    <section class="text-white relative overflow-hidden z-10 object-cover object-center py-10 md:py-20"
        style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/musora/promos/november/extend/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="container mx-auto text-center px-4">
            <div id="customize-anchor" class="anchor"></div>
            <img alt="Bundle" class="h-16 sm:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/musora/promos/november/extend/students-logo.webp"><br>
                <h2 class="leading-tight pt-3 lg:pt-6"><strong>Get a free $100 electronic gift card <br class="hidden sm:inline"> when you extend your membership.</strong></h2>

            <div class="w-full max-w-4xl mx-auto my-4 sm:my-8 ">
                <img alt="Bundle" class="w-full h-full hidden sm:inline-block opacity-0 transition-opacity duration-500"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/musora/promos/november/extend/musora-collage.webp"
                    loading="lazy" onload="this.classList.remove('opacity-0')">
                <img alt="Bundle" class="w-full h-full sm:hidden inline-block opacity-0 transition-opacity duration-500"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/786x0/filters:quality(95)/marketing/musora/promos/november/extend/musora-collage.webp"
                    loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h5 class="leading-none mb-1"><strong>$240</strong> <em>(Includes free $100 gift card.)</em></h5>
                <a
                    href="/ecommerce/add-to-cart?products[musora-annual-recurring-membership]=1&products[musora-gift-card-100-extend]=1&promo-code=MEBF24&locked=true"
                    class="join w-full sm:max-w-xs musora smaller mt-4"
                >
                    GET THE DEAL
                </a>
            </div>
        </div>
    </section>
    @php
        $videoTargetSkus = ['extension', 'all-access', 'store-credit', 'redeem-credit'];
    @endphp

    <section class="pt-8 pb-16 sm:py-20 lg:pt-20 md:pb-32 px-4 sm:px-6 bg-white text-center">
        <div class="container mx-auto max-w-5xl">
            <h2 class="leading-tight text-center mb-3 md:pb-6">
                <strong>Here are the details:</strong>
            </h2>
            <div class="text-left">
                @include('drumeo._partials.bf-bonus-section', [
                'videoTargetSkus' => $videoTargetSkus,
                'noButton' => 'true',
                ])
            </div>

            <div class="bg-[#CFEBFF] px-4 py-4 md:py-8 md:px-16 rounded-lg  w-auto inline-block mx-auto mt-6 md:mt-16">
                <div class="flex items-start justify-center gap-3 max-w-4xl w-auto">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                    </div>
                    <p class="leading-normal text-sm md:text-base">
                        <span class="font-semibold">This offer is only available for Black Friday – and only for existing<br class="hidden sm:inline"> Musora members (Drumeo, Pianote, Guitareo, Singeo).</span>
                    </p>
                </div>
            </div>
<br>
            <a
                href="/ecommerce/add-to-cart?products[musora-annual-recurring-membership]=1&products[musora-gift-card-100-extend]=1&promo-code=MEBF24&locked=true"
                class="join w-full sm:max-w-xs musora mt-7"
            >
                GET THE DEAL
            </a>

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


