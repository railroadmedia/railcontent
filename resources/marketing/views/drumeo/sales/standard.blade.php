@extends('drumeo.sales.standard-layout')

@section('meta')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta property="og:url" content="https://www.drumeo.com/">
@endsection

@section('promo-banner')
{{--    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-top lazyload" style="background-color:#040811;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/september/bg.jpg" --}}{{--style="background:radial-gradient(#022040, #01050f 80%);"--}}{{-->--}}
{{--        <div class="container mx-auto relative z-10 max-w-4xl">--}}
{{--            <img class="h-7 md:h-12 lg:h-14 mb-3 sm:mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/september/sticktember-logo.png" alt="10year_logo">--}}
{{--            --}}{{--<h1 data-aos="fade-down" class="font-bebas leading-none mb-1 text-4xl md:text-6xl">REACH YOUR  <br class="inline md:hidden">  <span class="text-coaches">DRUMMING GOALS.</span></h1>--}}
{{--            <h4 class="leading-normal"><strong>Get 6 free pairs of sticks + support <br class="inline sm:hidden"> underfunded music programs!</strong>--}}
{{--                <br><span class="uppercase" style="color:#cda880">ONLY <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span> LEFT!</span>--}}
{{--            </h4>--}}
{{--            --}}{{--<p class="leading-normal mb-3 md:mb-5 uppercase"><strong>--}}
{{--                    --}}{{--GET 3 BONUS TRAINING PACKS<br class="inline md:hidden"> FREE WHEN YOU JOIN DRUMEO--}}
{{--                    --}}{{--<br><span class="text-coaches uppercase">ONLY <span class="tzcd-full">A LIMITED TIME</span> LEFT!</span>--}}
{{--                --}}{{--</strong></p>--}}
{{--            <div class="flex flex-wrap items-start justify-center mx-auto my-5 sm:my-10">--}}
{{--                <div class="flex flex-wrap items-start flex-image mx-auto w-full md:w-4/12 lg:w-4/12 md:order-1 mb-5 md:mb-0 justify-center">--}}
{{--                    <img class="h-72 md:h-auto" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/september/collage.png">--}}
{{--                </div>--}}
{{--                <div class="text-left md:pr-3 lg:pr-8 w-full md:w-8/12 lg:w-8/12">--}}
{{--                    <p class="mx-auto">September is the ultimate win-win for your drumming.--}}
{{--                        <br><br>--}}
{{--                        When you join Drumeo, 20% of your membership will be donated toward <u>underfunded school music programs</u> – look at you go! That’s the first win. Now for the second…--}}
{{--                        <br><br>--}}
{{--                        Your annual Drumeo membership also includes 6 FREE pairs of 5A Drumsticks by Vater shipped to your door anywhere in the world. You’ll have unlimited drum lessons for a year + all the sticks you need to make some noise.--}}
{{--                        <br><br>--}}
{{--                        You get lessons, kids get instruments, and we get to see the next generation of drummers thrive.--}}
{{--                        <br><br>--}}
{{--                        <a class="anchor-slide" href="#customize-anchor"><u>Click below to see the full deal and start your membership.</u></a>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            --}}{{--<div class="max-w-lg lg:max-w-2xl mx-auto relative my-7">--}}
{{--                --}}{{--<div class="aspect-16:9 w-full relative rounded-xl border-4 border-drumeo overflow-hidden">--}}
{{--                    --}}{{--<iframe class="absolute w-full h-full" src="//player.vimeo.com/video/738385463" frameborder="0" allowfullscreen allow="autoplay"></iframe>--}}
{{--                --}}{{--</div>--}}
{{--                --}}{{--<img class="absolute hidden sm:inline -top-10 lg:-top-20 -right-24 lg:-right-32 w-24 lg:w-28 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/watch_icon.svg">--}}
{{--                --}}{{--<img style="transform: translate(-100%, -50%);" class="absolute hidden sm:inline top-1/2 -left-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/march/left_spread.png">--}}
{{--                --}}{{--<img style="transform: translate(100%, -50%);" class="absolute hidden sm:inline top-1/2 -right-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/march/right_spread.png">--}}
{{--            --}}{{--</div>--}}
{{--            <a class="anchor-slide join smaller --}}{{--coaches--}}{{--" style="background-color:#cda880;color:#000;" href="#customize-anchor">SEE THE DEAL</a>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section class="pt-7 pb-52 sm:py-10 lg:py-20 px-4 sm:px-6 text-white bg-center bg-cover bg-no-repeat promo-bg">--}}
{{--        <div class="max-w-4xl mx-auto">--}}
{{--            <div class="w-full md:w-9/12 lg:w-7/12 text-center md:text-left">--}}
{{--                <img class="h-20 md:h-24 lg:h-28 mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_450,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/october/logo2.png" alt="better hands logo">--}}
{{--                <p class="mb-2 leading-tight uppercase">--}}
{{--                    <strong>Get a FREE practice pad, drumsticks, Drumeo Rudiments Poster <span class="text-coaches">(NEW)</span>, and more!</strong><br>--}}
{{--                </p>--}}
{{--                <p class="text-light-navy leading-tight">Learning your rudiments will help you express yourself effortlessly on the drums. So we’re celebrating the launch of the first-ever Drumeo Rudiment Poster by giving you everything you need to run your rudiments day OR night:</p>--}}
{{--                <ul class="text-light-navy leading-tight my-3">--}}
{{--                    <li><i class="fas fa-check text-drumeo"></i> Drumeo QuietPad <strong class="text-coaches">(FREE)</strong></li>--}}
{{--                    <li><i class="fas fa-check text-drumeo"></i> 5A Drumsticks <strong class="text-coaches">(FREE)</strong></li>--}}
{{--                    <li><i class="fas fa-check text-drumeo"></i> Drumeo Rudiments Poster<strong class="text-coaches">(NEW)</strong></li>--}}
{{--                </ul>--}}
{{--                <p class="text-light-navy leading-tight mb-3">Plus, you’ll get 3 of our most popular packs to boost your better hand speed.--}}
{{--                    <br><br>--}}
{{--                    Click below to see everything included in the all NEW Drumeo Rudiments Bundle.--}}
{{--                </p>--}}
{{--                <a class="join smaller anchor-slide md:w-52 lg:w-60 blue" href="#customize-anchor">See the deal</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection

@section('sticky-bar')

    {{--<div class="h-10 relative w-full block" style="background:linear-gradient(to bottom, #022040, #01050f);"></div>--}}
    {{--<a href="#customize-anchor" style="background:linear-gradient(to bottom, #022040, #01050f);"--}}
            {{--class="promo-banner anchor-slide block text-white text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 z-0 mx-auto -mt-10 text-xs">--}}
        {{--<div class="container mx-auto relative">--}}
            {{--<div class="inline-block align-middle text-center">--}}
                {{--<img class="inline-block align-middle mr-2 h-8"--}}
                        {{--src="https://cdn.musora.com/image/fetch/w_130,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/30logo.png">--}}
                {{--<h5 class="font-bebas inline-block align-middle mx-auto text-2xl leading-none mr-2 h-8 py-1.5 px-2 bg-black rounded-md">31% OFF</h5>--}}
                {{--<p class="inline-block align-middle mx-auto font-bebas text-sm leading-none sm:text-lg sm:leading-none text-left">--}}
                    {{--<span class="uppercase">Learn the drums by <br> playing the drums.</span></p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</a>--}}
@endsection

@section('final')
     @include("drumeo.sales.partials._subscribe-options")
@endsection
