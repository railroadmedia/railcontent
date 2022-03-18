@extends('guitareo.products.guitar-quest.guitar-quest-sales-layout')

@php
    $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/shop&payment-plan=1';
    $orderLinkAlt = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/shop&payment-plan=5';
    $productPrice = \App\Prices::$guitarQuestRegular
@endphp
@section('top-promo-banner')
    @include('shop.elements.promo-banner', [
                "name" => "Guitar Quest",
                "fullPrice" => App\Prices::$guitarQuestFull,
                "price" => App\Prices::$guitarQuestRegular,
                "noBreadcrumb" => true
            ])
@endsection
@section('promo-banner')

    {{--<section class="tw-py-8 tw-bg-black md:tw-py-12 tw-relative" style="z-index: 51;margin: 0 auto -50px;background:linear-gradient(to bottom, #000419, #000f28);">--}}
        {{--<div class="tw-max-w-screen-xl tw-m-auto tw-px-3 md:tw-px-6 tw-flex">--}}
            {{--<div class="tw-w-full tw-m-auto tw-text-white tw-text-center md:tw-text-left">--}}
                {{--<div class="tw-text-center tw-mx-auto" style="max-width: 900px;">--}}
                    {{--<h2 class="tw-uppercase font-bison-bold tw-text-3xl md:tw-text-6xl">THE <span class="text-goldenrod">BURST</span> OF OCTOBER</h2>--}}
                    {{--<h2 class="tw-uppercase font-primary tw-text-base md:tw-text-md lg:tw-text-lg tw-mt-2 tw-mb-7">--}}
                        {{--SAVE {{ round(100 - (100 * (\App\Prices::$guitarQuestRegular / \App\Prices::$guitarQuestFull))) }}% + BONUS 1-YEAR GUITAREO  <br>--}}
                        {{--MEMBERSHIP FOR EXTRA LESSONS & SUPPORT--}}
                        {{--<br><strong class="text-goldenrod">ONLY <span class="tzcd-small tw-inline md:tw-hidden">A LIMITED TIME</span> <span class="tzcd-full tw-hidden md:tw-inline">A LIMITED TIME</span> LEFT!</strong>--}}
                    {{--</h2>--}}
                {{--</div>--}}
                {{--<div class="tw-flex tw-flex-wrap tw-items-center tw-justify-center tw-mx-auto" style="max-width: 900px;">--}}
                    {{--<div class="tw-mx-auto tw-mb-4 md:tw-mb-0 tw-w-2/3 md:tw-w-1/3 lg:tw-w-4/12 md:tw-order-1">--}}
                        {{--<img class="tw-mx-auto" src="https://guitareo.s3.amazonaws.com/sales/promos/october/gq-spread.png">--}}
                    {{--</div>--}}
                    {{--<div class="tw-text-left md:tw-pr-6 lg:tw-pr-8 tw-w-full md:tw-w-2/3 lg:tw-w-8/12">--}}
                        {{--<p class="font-primary tw-text-base tw-my-4" style="max-width: 550px;">--}}
                            {{--Hey it’s Rob here. You might know my band <a href="https://en.wikipedia.org/wiki/First_of_October_(band)"><u>First of October</u></a> where every year, for one day, I jump into a recording studio with my buddy Andrew Huang to write & record an entire 10-track album in a single session.--}}
                            {{--<br><br>--}}
                            {{--And I do that because playing music should be about making cool projects happen & expressing yourself!--}}
                            {{--<br><br>--}}
                            {{--And GuitarQuest is no different. It’s designed to help you learn the guitar through fun missions — so it’s more about playing than practicing, and tricking yourself into seeing tons of progress because you keep returning to the guitar time and time again.--}}
                            {{--<br><br>--}}
                            {{--So to celebrate my October tradition, this month you’ll save a bunch of money and get a free bonus. I’m calling it The <strong>Burst</strong> of October, to give you the extra push you need towards your musical goals. Enjoy!--}}
                        {{--</p>--}}
                        {{--<a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient tw-transition tw-duration-500 tw-linear tw-px-4 tw-py-3 tw-w-full tw-inline-block tw-uppercase tw-text-black font-roboto-condensed-bold tw-rounded-full tw-text-center tw-text-xl tw-mb-5 md:tw-w-3/4">--}}
                            {{--GET STARTED »--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<!-- Banner -->--}}
    {{--<a href="{{ $orderLink }}" class="tw-w-full tw-py-1 tw-text-center tw-sticky tw-z-50 tw-block tw-text-white"--}}
            {{--style="top: 56px;background:linear-gradient(to bottom, #000419, #000f28);"--}}
    {{-->--}}
        {{--<h2 class="tw-uppercase font-bison-bold tw-text-lg md:tw-text-3xl tw-inline-block tw-align-middle tw-m-0 tw-leading-none">THE <span class="text-goldenrod">BURST</span> OF OCTOBER</h2>--}}
        {{--<p class="tw-uppercase tw-my-0 tw-ml-2 tw-inline-block tw-align-middle tw-text-xs md:tw-text-sm tw-text-left tw-leading-none"><strong>Save {{ round(100 - (100 * (\App\Prices::$guitarQuestRegular / \App\Prices::$guitarQuestFull))) }}%</strong> + BONUS 1-YEAR<br>  GUITAREO MEMBERSHIP</p>--}}
    {{--</a>--}}
@endsection
@section('final')

    @include("products.guitar-quest.partials.sections._start-here")
@endsection