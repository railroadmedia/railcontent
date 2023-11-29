@extends('guitareo.products.guitar-quest-layout')

@php $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&promo-code=lead-discount3&redirect=/order&locked=true' @endphp
@php $productPrice = 47 @endphp

@section('promo-banner')
    <section class="py-8 md:py-12 relative text-white text-center" style="z-index: 51;margin: 0 auto -70px; background:#000612;">
        <div class="max-w-screen-xl m-auto px-6 lg:flex lg:items-start">
            <img class="inline-block w-3/4 sm:w-full sm:max-w-sm mb-5 lg:mb-0 mx-auto lg:mx-0" src="https://d122ay5chh2hr5.cloudfront.net/lead-gen/guitar-tricks/logo-with.png">
            <div class="lg:pl-10 max-w-lg lg:max-w-2xl mx-auto lg:mx-0">
                <p class="font-primary text-lg sm:text-xl"><strong class="font-black">CONTINUE YOUR JOURNEY <i class="fas fa-long-arrow-right mx-1 text-goldenrod"></i> <span class="inline-block"> SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['guitar-quest']->price)))) }}% ON GUITAR QUEST</span></strong></p>
                <p class="font-primary text-sm sm:text-base my-4 leading-relaxed text-left">
                    Congratulations on learning 2 Simple Guitar Tricks. Now let’s put them to use! These tricks are taken directly from a level of Rob GuitarQuest course.
                    <br><br>
                    So if you’ve enjoyed learning these tricks, we know you’ll love the rest. And because we want you to keep learning and having fun on the guitar, we’re giving you a {{ round(100 - (100 * ($productPrice / floatval($productPrices['guitar-quest']->price)))) }}% discount to continue your journey with Rob. Just click any of the big buttons on this page to get started.
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
        <img class="inline-block w-32" src="https://d122ay5chh2hr5.cloudfront.net/lead-gen/guitar-tricks/logo-with.png">
        <p class="uppercase my-0 ml-3 inline-block align-middle text-sm sm:text-base text-left" style="line-height: 1.2!important;">
            SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['guitar-quest']->price)))) }}% ON GUITAR QUEST<br>
        <s class="opacity-60">WAS ${{ floatval($productPrices['guitar-quest']->price) }}</s> <strong class="font-black text-goldenrod">ONLY ${{ $productPrice }}</strong>
        </p>
    </a>
@endsection

@section('final')
    <!-- Start Here -->
    {{-- Guitar Quest: Start Here --}}
    <section class="py-24 bg-top bg-cover md:py-48" style="background-image: url('https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/order-background.jpg')">
        <div class="max-w-screen-xl m-auto px-4 md:px-6 flex">
            <div class="w-full m-auto text-white text-center lg:w-10/12">
                <img src="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png" width="400px" class="m-auto block mb-10">
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

                <div class="opacity-40 flex justify-center text-5xl mt-10 mb-4">
                    <i class="fab fa-cc-visa mr-2"></i>
                    <i class="fab fa-cc-mastercard mr-2"></i>
                    <i class="fab fa-cc-amex mr-2"></i>
                    <i class="fab fa-cc-paypal mr-2"></i>
                </div>
                <p class="opacity-40 text-xs m-0 font-semibold">Any questions? Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.</p>
            </div>
        </div>
    </section>
@endsection
