@extends('guitareo.products.guitar-quest-layout')

@php
    $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/order';
    $productPrice = floatval($productPrices['guitar-quest']->discounted_price)
@endphp

@section('final')
    {{-- Guitar Quest: Start Here --}}
    <section class="py-24 bg-top bg-cover md:py-48" style="background-image: url('https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/order-background.jpg')">
        <div class="max-w-screen-xl m-auto px-6 flex">
            <div class="w-full m-auto text-white text-center lg:w-2/3">
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
