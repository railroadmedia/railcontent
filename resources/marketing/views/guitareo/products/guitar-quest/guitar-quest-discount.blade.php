@extends('guitareo.products.guitar-quest.guitar-quest-sales-layout')

@php $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&promo-code=siah-deal&redirect=/order&payment-plan=1' @endphp
@php $orderLinkAlt = '/ecommerce/add-to-cart?products[guitar-quest]=1&promo-code=siah-deal&redirect=/order&payment-plan=5' @endphp
@php $productPrice = GuitareoPrices::$guitarQuestSpecial @endphp

@section('promo-banner')
    <section class="py-8 md:py-12 relative text-white text-center" style="z-index: 51;margin: 0 auto -70px; background:#000612;">
        <div class="max-w-screen-xl m-auto px-6 lg:flex lg:items-start">
            <img class="inline-block w-3/4 sm:w-full sm:max-w-sm mb-5 lg:mb-0 mx-auto lg:mx-0" src="https://musora.imgix.net/https%3A%2F%2Fguitareo.s3.amazonaws.com%2Flead-gen%2Fsong-in-an-hour%2Flogo-purple-discount.png?auto=format&ixlib=php-1.2.1&w=770&s=4d7d292914d2861e342201198a006f95" alt="logo purple">
            <div class="lg:pl-10 max-w-lg lg:max-w-2xl mx-auto lg:mx-0">
                <p class="font-primary text-lg sm:text-xl"><strong class="font-black">CONTINUE YOUR JOURNEY <i class="fas fa-long-arrow-right mx-1" style="color:#6100a6;"></i> <span class="inline-block"> SAVE {{ round(100 - (100 * (GuitareoPrices::$guitarQuestSpecial / floatval($productPrices['guitar-quest']->price)))) }}% ON GUITAR QUEST</span></strong></p>
                <p class="font-primary text-sm sm:text-base my-4 leading-relaxed text-left">
                    Congratulations on taking the Song In An Hour Challenge. We’re so excited that you’ve started your guitar journey and we’re here to support you the rest of the way.
                    <br><br>
                    Song In An Hour is actually the FIRST level of GuitarQuest. And because we hope you’ll keep learning with us, we’re giving you a {{ round(100 - (100 * (GuitareoPrices::$guitarQuestSpecial / floatval($productPrices['guitar-quest']->price)))) }}% discount to make things a little easier. Just click any of the big buttons on this page to continue your journey.
                </p>
                <a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient transition duration-500 linear px-12 py-1 inline-block uppercase text-black font-roboto-condensed-bold rounded-full text-lg">
                    GET MY DISCOUNT &raquo;
                </a>
            </div>
        </div>
    </section>
    <!-- Banner -->
    <a href="{{ $orderLink }}" class="w-full bg-gq-purple py-2 text-center sticky z-50 block text-white"
            style="top: 56px;"
    >
        <img class="inline-block w-32" src="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-white.png">
        <p class="uppercase my-0 ml-3 inline-block align-middle text-sm sm:text-base text-left" style="line-height: 1.2!important;">
            SAVE {{ round(100 - (100 * (GuitareoPrices::$guitarQuestSpecial / floatval($productPrices['guitar-quest']->price)))) }}% ON GUITAR QUEST<br>
        <s class="opacity-60">WAS ${{ floatval($productPrices['guitar-quest']->price) }}</s> <strong class="font-black text-goldenrod">ONLY ${{ $productPrice }}</strong>
        </p>
    </a>
@endsection

@section('final')
    <!-- Start Here -->
    {{-- Guitar Quest: Start Here --}}
    <section class="py-24 bg-top bg-cover md:py-48" style="background-image: url('https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Forder-background.jpg?auto=format&ixlib=php-1.2.1&w=1500&s=102f8f89fa2527e02113803a5fa19e3c')">
        <div class="max-w-screen-xl m-auto px-4 md:px-6 flex">
            <div class="w-full m-auto text-white text-center lg:w-10/12">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fguitar-quest-logo.png?auto=format&ixlib=php-1.2.1&w=700&s=5768e9ca4e1a3a4a28966bd8fcad1d61" width="400px" class="m-auto block mb-10">
                <h2 class="uppercase text-3xl font-bison-bold sm:text-5xl md:text-6xl mb-2">Your Guitar Journey<br class="inline xl:hidden"> Starts Here.</h2>

                <h4 class="text-xl mb-2 md:mb-10 font-primary sm:text-2xl md:text-3xl">
                    @if($productPrice < floatval($productPrices['guitar-quest']->price))
                        <span class="text-gray-500 line-through">Normally&nbsp;$197</span>
                        <span class="font-bold text-goldenrod uppercase font-extrabold">Only&nbsp;${{ $productPrice }}</span>
                        <span>(Save&nbsp;{{ round(100 - (100 * ($productPrice / floatval($productPrices['guitar-quest']->price)))) }}%)</span>
                    @else
                        <span class="text-goldenrod uppercase">
                        Reach your goals on the <br class="inline xl:hidden">
                        guitar for just&nbsp;${{ $productPrice }}</span>
                    @endif
                </h4>

                <a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient transition duration-500 linear px-4 py-4 w-full inline-block uppercase text-black font-roboto-condensed-bold rounded-full text-3xl mb-5 md:w-3/4">
                    Start Your Quest &raquo;
                </a>
                <p class="font-primary text-sm mb-10">
                    <a href="{{ $orderLinkAlt }}" class="text-goldenrod underline font-bold transition-colors text-goldenrod-hover" title="Go To Order Page">OR CHOOSE A PAYMENT PLAN<br class="inline sm:hidden">
                        ON THE NEXT PAGE</a>
                </p>

                <div class="opacity-40 flex justify-center text-5xl mb-4">
                    <i class="fab fa-cc-visa mr-2"></i>
                    <i class="fab fa-cc-mastercard mr-2"></i>
                    <i class="fab fa-cc-amex mr-2"></i>
                    <i class="fab fa-cc-paypal mr-2"></i>
                </div>
                <p class="opacity-40 text-xs m-0 font-semibold">Any questions? Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.</p>
            </div>
        </div>
    </section>
    {{--@include("guitareo.products.guitar-quest.partials.sections._start-here", [--}}
    {{--"discountVersion" => true--}}
    {{--])--}}
@endsection
