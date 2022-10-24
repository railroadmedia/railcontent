@extends('guitareo.products.guitar-quest.guitar-quest-sales-layout')

@php
    $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/order&payment-plan=1';
    $orderLinkAlt = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/order&payment-plan=5';
    $productPrice = GuitareoPrices::$guitarQuestRegular
@endphp
@section('top-promo-banner')
    @include('guitareo._partials.promo-banner', [
                "name" => "Guitar Quest",
                "fullPrice" => GuitareoPrices::$guitarQuestFull,
                "price" => GuitareoPrices::$guitarQuestRegular,
                "noBreadcrumb" => true
            ])
@endsection

@section('quest-section')
    @include("guitareo.products.guitar-quest.partials.sections._your-quest")
@endsection

@section('promo-banner')
    {{--<section class="py-8 bg-black md:py-12 relative" style="z-index: 51;margin: 0 auto -50px;background:linear-gradient(to bottom, #000419, #000f28);">--}}
        {{--<div class="max-w-screen-xl m-auto px-3 md:px-6 flex">--}}
            {{--<div class="w-full m-auto text-white text-center md:text-left">--}}
                {{--<div class="text-center mx-auto" style="max-width: 900px;">--}}
                    {{--<h2 class="uppercase font-bison-bold text-3xl md:text-6xl">Rob's <span class="text-goldenrod">32nd </span> Birthday Sale!</h2>--}}
                    {{--<h2 class="uppercase font-primary text-base md:text-md lg:text-lg mt-2 mb-7">--}}

                        {{--Get {{ round(100 - (100 * (GuitareoPrices::$guitarQuestRegular / GuitareoPrices::$guitarQuestFull))) }}% off until Sunday, August 28th at midnight.--}}
                        {{--SAVE {{ round(100 - (100 * (GuitareoPrices::$guitarQuestRegular / GuitareoPrices::$guitarQuestFull))) }}% + BONUS 1-YEAR GUITAREO  <br>--}}
                        {{--MEMBERSHIP FOR EXTRA LESSONS & SUPPORT--}}
                        {{--<br><strong class="text-goldenrod">ONLY <span class="tzcd-small inline md:hidden">A LIMITED TIME</span> <span class="tzcd-full hidden md:inline">A LIMITED TIME</span> LEFT!</strong>--}}
                    {{--</h2>--}}
                    {{--<a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient transition duration-500 linear px-8 py-3 w-auto inline-block uppercase text-black font-roboto-condensed-bold rounded-full text-center text-xl mb-5">--}}
                        {{--GET STARTED »--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="flex flex-wrap items-center justify-center mx-auto" style="max-width: 900px;">--}}
                    {{--<div class="mx-auto mb-4 md:mb-0 w-2/3 md:w-1/3 lg:w-4/12 md:order-1">--}}
                        {{--<img class="mx-auto" src="https://guitareo.s3.amazonaws.com/sales/promos/october/gq-spread.png">--}}
                    {{--</div>--}}
                    {{--<div class="text-left md:pr-6 lg:pr-8 w-full md:w-2/3 lg:w-8/12">--}}
                        {{--<p class="font-primary text-base my-4" style="max-width: 550px;">--}}
                            {{--Hey it’s Rob here. You might know my band <a href="https://en.wikipedia.org/wiki/First_of_October_(band)"><u>First of October</u></a> where every year, for one day, I jump into a recording studio with my buddy Andrew Huang to write & record an entire 10-track album in a single session.--}}
                            {{--<br><br>--}}
                            {{--And I do that because playing music should be about making cool projects happen & expressing yourself!--}}
                            {{--<br><br>--}}
                            {{--And GuitarQuest is no different. It’s designed to help you learn the guitar through fun missions — so it’s more about playing than practicing, and tricking yourself into seeing tons of progress because you keep returning to the guitar time and time again.--}}
                            {{--<br><br>--}}
                            {{--So to celebrate my October tradition, this month you’ll save a bunch of money and get a free bonus. I’m calling it The <strong>Burst</strong> of October, to give you the extra push you need towards your musical goals. Enjoy!--}}
                        {{--</p>--}}
                        {{--<a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient transition duration-500 linear px-4 py-3 w-full inline-block uppercase text-black font-roboto-condensed-bold rounded-full text-center text-xl mb-5 md:w-3/4">--}}
                            {{--GET STARTED »--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<!-- Banner -->--}}
    {{--<a href="{{ $orderLink }}" class="w-full py-1 text-center sticky z-50 block text-white"--}}
            {{--style="top: 56px;background:linear-gradient(to bottom, #000419, #000f28);"--}}
    {{-->--}}
        {{--<h2 class="uppercase font-bison-bold text-lg md:text-3xl inline-block align-middle m-0 leading-none">Rob's <span class="text-goldenrod">32nd </span> Birthday Sale!</h2>--}}
        {{--<p class="uppercase my-0 ml-2 inline-block align-middle text-xs md:text-sm text-center leading-none"><strong>Save {{ round(100 - (100 * (GuitareoPrices::$guitarQuestRegular / GuitareoPrices::$guitarQuestFull))) }}%</strong> on GuitarQuest<br> only until Aug 28th.</p>--}}
    {{--</a>--}}
@endsection
@section('final')
    @include("guitareo.products.guitar-quest.partials.sections._start-here")
@endsection
