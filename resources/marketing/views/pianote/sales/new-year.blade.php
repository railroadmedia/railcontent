@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data.php'));
@endphp

@extends('pianote.sales.subscription', [
    "promoVersion" => true,
])
@section('body-data')
    x-data ='{
    demoVid : false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    @foreach($pianote['packs'] as $modalData)
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
                NEW YEAR. <span class="text-pianote">NO EXCUSES.</span>
            </h4><br>
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-3 sm:mb-5 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO
                <br class="sm:hidden">LEARN THE PIANO.
            </h1>
            <br>
            <h5 class="leading-tight relative inline-block mx-auto text-musora mb-7 sm:mb-10">
                Save 20% On Your First Year<br class="sm:hidden"> + <strong>Get 8 Free Bonuses</strong></h5>
            <div x-data="{lazyLoad: false}">
            @php
                $targetSkus = ['best-beginner-piano-book','pianote-practice-planner', 'piano-chords-and-scales-guide', 'new-piano-players-start-here', 'easy-chords', '30-day-blues-piano', '30-days-to-better-technique', 'classical-piano-collection'];
            @endphp
                <div id="customize-anchor"></div>
                    @include('drumeo._partials.ny-order-section-bonuses', [
                    'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
                    'topImage' => 'marketing/pianote/promos/black-friday/the-book-bundle/bonus-AM.webp',
                    'secondImage' => 'marketing/pianote/membership/homepage/2025/bonuses-02.webp',
                    'thirdImage' => 'marketing/pianote/membership/homepage/2025/bonuses-03.webp',
                    'fourthImage' => 'marketing/pianote/membership/homepage/2025/bonuses-01.webp',
                    'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
                    'bundle'=> "holiday-pianote",
                    'targetSkus' => $targetSkus,
                    'maxWidth' => 'max-w-5xl',
                    ])
                </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mt-3 md:mt-4"><s class="opacity-50"> $240</s><strong> $192</strong> <span class="text-musora text-xl">Save 20%</span></h2>
                <p class="text-sm mt-1"><em>For the first year, then $240.</em></p>
                <a class="join pianote my-4 sm:my-6 w-full max-w-md uppercase" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-new-years-bundle]=1&promo-code=NYPHP25,new-year,ny-member-shipping&locked=true">Save 20%</a>
                <p class="text-sm"><em>Need a piano?  <a class="underline" href="/shop/prima">Get the Keyboard Bundle</a></em></p>
            </div>
        </div>
    </section>
   
    <section
        class="px-4 lg:px-8 pb-10 sm:pb-16 lg:pb-24 pt-10 relative overflow-hidden text-white text-center relative overflow-hidden"
        style="background: #0C1524;">
        <div class="w-full px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <p class="text-sm"><em>VAT an issue? <a class="underline" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&products[30-days-to-better-technique]=1&products[classical-piano-collection]=1&promo-code=welcome-back,NYP25&locked=true">Click here to join Pianote<br class="sm:hidden"> for $180 with no physical bonuses.</a></em></p>
            </div>
        </div>
    </section>
@endsection
