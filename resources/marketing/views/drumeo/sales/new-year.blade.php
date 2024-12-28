@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp

@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
])
@section('body-data')
    x-data ='{
    demoVid : false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    @foreach($drumeo['packs'] as $modalData)
        {{ $modalData['name'] }}: false,
    @endforeach
    }'
@endsection

@section('final')
    <section
        class="px-4 lg:px-8 py-10 sm:py-16 lg:py-20 relative overflow-hidden text-white text-center customize relative overflow-hidden"
        style="background: linear-gradient(to bottom, #1D4689, #0f1d34);">
        <div class="container mx-auto max-w-5xl">
            <h4 class="relative w-auto inline-block mb-4 lg:mb-6 font-black font-lexend leading-none uppercase">
                NEW YEAR. <span class="text-drumeo">NO EXCUSES.</span>
            </h4><br>
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-3 sm:mb-5 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO
                <br class="sm:hidden">LEARN THE DRUMS.
            </h1>
            <h5 class="leading-tight relative inline-block mx-auto text-musora mb-7 sm:mb-10">
                Save 20% On Your First Year<br class="sm:hidden"> + <strong>Get 7 Free Bonuses</strong></h5>
            <img class="hidden md:inline object-cover max-w-2xl lg:max-w-4xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/drumeo/promos/january/order-collage.webp" alt="Bundle Collage">
            <img class="md:hidden object-cover w-full sm:max-w-2xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/january/order-collage-m.webp" alt="Bundle Collage Mobile">
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mt-3 md:mt-4"><s class="opacity-50"> $240</s><strong> $192</strong> <span class="text-musora text-xl">Save 20%</span></h2>
                <p class="text-sm mt-1"><em>For the first year, then $240.</em></p>
                <a class="join drumeo my-4 sm:my-6 w-full max-w-md uppercase" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-new-years-bundle]=1&promo-code=NYPHD25,new-year&locked=true">Save 20%</a>
                <p class="text-sm"><em>Need drums too? <a class="underline" href="/drumshop/kit">Click here to grab the<br class="sm:hidden"> Drumeo Nitro Max E-Kit + 1 year of lessons.</a></em></p>
            </div>
        </div>
    </section>
    <section
        class="px-4 lg:px-8 pb-10 sm:pb-16 lg:pb-24 pt-10 relative overflow-hidden text-white text-center relative overflow-hidden"
        style="background: #0C1524;">
        <div class="w-full px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <p class="text-sm"><em>VAT an issue? <a class="underline" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-double-bass]=1&products[30-day-independence]=1&products[30-day-jazz]=1&products[30-day-chops]=1&products[30-day-drummer-4]=1&promo-code=welcome-back,NYD25&locked=true">Click here to join Drumeo<br class="sm:hidden"> for $180 with no physical bonuses.</a></em></p>
            </div>
        </div>
    </section>
@endsection
