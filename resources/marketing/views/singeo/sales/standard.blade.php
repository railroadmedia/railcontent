@extends('singeo.sales.standard-layout', [
    "openVersion" => true
])

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:url" content="https://www.singeo.com"/>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    @parent
@endsection

@section('top-promo-bar') @endsection

@section('promo-banner')
{{--    <div id="promo" class="anchor"></div>--}}
{{--    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/promo_bg.jpg" style="background-color:#0b0b0b;" --}}{{--style="background:radial-gradient(#022040, #01050f 80%);"--}}{{-->--}}
{{--        <div class="container mx-auto relative z-10 max-w-4xl">--}}
{{--            <img class="h-16 sm:h-20 md:h-24 lg:h-36 mb-6 md:mb-10" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/promo_logo.png" alt="singeo turning one image">--}}
{{--            --}}{{--<h1 class="font-bebas leading-none mb-1 text-5xl md:text-6xl">YOU CAN SING - <br class="inline md:hidden"> <span class="text-coaches">HERE'S HOW!</span></h1>--}}
{{--            <h5 class="leading-normal mb-3 md:mb-5"><strong>Raise your hand if you’re ready <br> for $30 OFF your annual membership.</strong>--}}
{{--                <br><span class="uppercase text-coaches">ONLY <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span> LEFT!</span>--}}
{{--            </h5>--}}


{{--            <div class="flex flex-wrap items-start justify-center mx-auto my-5 sm:my-10">--}}
{{--                <div class="flex flex-wrap items-start flex-image mx-auto w-full md:w-4/12 lg:w-4/12 md:order-1 mb-5 md:mb-0 justify-center">--}}
{{--                    <img class="h-72 md:h-auto" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/promo_collage.png">--}}
{{--                </div>--}}
{{--                <div class="text-left md:pr-3 lg:pr-8 w-full md:w-8/12 lg:w-8/12">--}}
{{--                    <p class="mx-auto">It’s that time of the year again!--}}
{{--                        <br><br>--}}
{{--                        The relaxed days of summer are great, but going back to school (or work) always comes with an air of excitement. So many people to see and so many things to do.--}}
{{--                        <br><br>--}}
{{--                        That’s until a couple of weeks after when your day-to-day becomes extremely busy, and your passions (and singing) fall down the sidelines.--}}
{{--                        <br><br>--}}
{{--                        Luckily, it doesn’t have to be like that anymore. Singeo has your back with structured step-by-step lessons and timed vocal exercise routines that fit even in the busiest schedule. Plus, you can get all the personal feedback and support you need to guarantee you’re making progress.--}}
{{--                        <br><br>--}}
{{--                        This year you’re going back to school with Singeo and loving every second of it! Become a Singeo Member for <strong>ONLY <s>${{ SingeoPrices::$singeoMembershipAnnualFull }}</s> ${{ SingeoPrices::$singeoMembershipAnnual }}</strong>.--}}
{{--                        <br><br>--}}
{{--                        Get straight A’s on your singing and achieve the beautiful voice you’ve always wanted.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            --}}{{--<div class="max-w-lg lg:max-w-2xl mx-auto relative my-3 md:my-5">--}}
{{--                --}}{{--<div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">--}}
{{--                    --}}{{--<iframe class="absolute w-full h-full" src="//player.vimeo.com/video/658674279" frameborder="0" allowfullscreen allow="autoplay" title="find your true voice with shelea"></iframe>--}}
{{--                --}}{{--</div>--}}
{{--                --}}{{--<img style="transform: translate(-100%, -50%);" class="absolute hidden sm:inline top-1/2 -left-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/march/left_spread.png" alt="left-spread">--}}
{{--                --}}{{--<img style="transform: translate(100%, -50%);" class="absolute hidden sm:inline top-1/2 -right-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/march/right_spread.png" alt="right-spread">--}}
{{--            --}}{{--</div>--}}
{{--            <a class="anchor-slide join smaller coaches mt-5" href="#customize-anchor">START MY SINGING LESSONS &raquo;</a>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection

@section('sticky-bar')
{{--    <div class="h-10 relative w-full block" style="background-color:#000;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/promo_bg.jpg'); background-size:cover;"></div>--}}
{{--    <a--}}
{{--        href="#customize-anchor"--}}
{{--        class="promo-banner anchor-slide block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap text-white bg-cover bg-center shadow-md py-1 hover:text-gray-100 z-0 mx-auto -mt-10 text-xs"--}}
{{--        style="background-color:#000;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/promo_bg.jpg'); background-size:cover;"--}}
{{--    >--}}
{{--        <div class="container mx-auto relative">--}}
{{--            <div class="inline-block align-middle text-center">--}}
{{--                <img class="inline-block align-middle mr-2 h-6 sm:h-8 mt-2" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/order_sticky_logo.png">--}}
{{--                 --}}{{--<h5 class="font-bebas inline-block align-middle mx-auto text-2xl leading-none mr-1.5 h-8 py-1.5 px-2 bg-black rounded-md">FIND YOUR TRUE VOICE WITH SHELÉA</h5> --}}
{{--                <p class="inline-block align-middle mx-auto font-bebas text-sm leading-none sm:text-base sm:leading-none text-left uppercase">--}}
{{--                    Get a full year of singing <br>--}}
{{--                    lessons for just $97.--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </a>--}}
@endsection

@section('final')
     @include("sales.partials._subscribe-options")
@endsection
