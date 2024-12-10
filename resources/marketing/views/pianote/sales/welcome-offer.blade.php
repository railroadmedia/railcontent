@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
])

@section('global-head')
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/welcome-offer">
    @parent
@endsection

@section('promo-banner')
    @php
        $bubbles =  [
             [
                 'src' => $bubble1,
                 'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
             ],
             [
                 'src' => $bubble2,
                 'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
             ],
             [
                 'src' => $bubble3,
                 'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
             ],
             [
                 'src' => $bubble4,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
             ],
             [
                 'src' => $bubble5,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
             ],
             [
                 'src' => $bubble6,
                 'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
             ],
             [
                 'src' => $bubble7,
                 'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
             ],
             [
                 'src' => $bubble8,
                 'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
             ]
         ];
          $features = $pianote['features'];
          $slides = $pianote['slides'];
    @endphp
    @include('musora.sales.components.header-section', [
        'header' => 'SAVE 25% ON YOUR<br> <span class="relative inline-block">FIRST YEAR OF LESSONS.
        <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>

        ',
        'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
        'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
        'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
        'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
        'pointOne' => 'GREAT TEACHERS',
        'pointTwo' => 'VIDEO LESSONS',
        'pointThree' => 'FUN PRACTICE',
        'pointFour' => 'POPULAR SONGS',
    ])
    <div class="sticky-trigger block"></div>
    <a href="#customize-anchor"
        class="promo-banner flex text-white items-center justify-center -mt-12 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        {{--        <img class="h-8 sm:h-10 mr-4" src="https://www.musora.com/musora-cdn/image/width=300,quality=90/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas mx-0 pr-3">SAVE 25% ON YOUR FIRST YEAR</h3>
        <p class="inline-block text-xs mx-0 leading-tight">

        </p>
    </a>
@endsection
@section('final')

    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(to right, #08203a, #0c1524);">
        <div class="container mx-auto max-w-6xl relative z-50">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <picture class="h-full w-full bg-top bg-cover opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true">
                                    <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp" media="(min-width: 640px)">
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp" alt="Top Image" class="w-full h-full object-cover transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Save 25% on your first year of lessons.</strong></h2>
                <h3 class="leading-tight mt-4 sm:mt-5 mb-2">
                    <s class="opacity-50">$240</s>
                    <strong>$180</strong> <span class="text-musora">(Save 25%)</span>
                </h3>
                <p class="text-sm mb-4 sm:mb-6">For your first year, then $240/yr.</p>
{{--                <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&redirect=/order&locked=true&promo-code=welcome-offer">GET STARTED &raquo;</a>--}}
            </div>
            <p class="opacity-70 text-sm mt-2"><em>90-day money-back guarantee. Cancel anytime.</em></p>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            window.addEventListener('scroll', function () {
                var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
                var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
                if (window.scrollY > (unstickTrigger - 115)) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < stickTrigger - 115) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                    stickyBar.classList.add('fixed', 'mt-0');
                }
            });
        });
    </script>
@endsection
