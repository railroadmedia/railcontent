@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Quebec Drum Festival | Drumeo</title>
    <meta property="og:title" content="Quebec Drum Festival | Drumeo">

    <meta name="description" content="Save on your Drumeo Membership + get FREE bonuses.">
    <meta property="og:description" content="Save on your Drumeo Membership + get FREE bonuses.">

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/festival/quebec-festival-header-bg.jpg">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
    ])

    <header class="bg-cover bg-top py-6 text-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/festival/quebec-festival-header-bg.jpg">
        <img class="h-44 md:h-56 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/festival/quebec-festiva-logo.svg" alt="Quebec Festival Logo">
    </header>

    <section class="py-12 sm:py-20 text-center text-white" style="background: #01050F;">
        <p class="tracking-widest mb-4" style="color:#FFAE00;">
            FESTIVAL ATTENDEE EXCLUSIVE
        </p>
        <h3 class="font-extrabold leading-tight">
            Save on your Drumeo <br>Membership + get FREE bonuses.
        </h3>
        <h6 class="mt-4 mb-8 leading-tight" style="color: #A4AFC7;">
            You’ll have one year of unlimited<br class="inline sm:hidden">
            drum lessons, including:
        </h6>
        <div class="md:grid md:grid-cols-3 md:gap-4 max-w-md md:max-w-3xl mx-auto mb-20 md:mb-32 px-6 sm:px-4 lg:px-2">
            <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/thumb-method.jpg"></div>
                <div class=" px-3 lg:px-4 py-5 lg:py-7">
                    <i class="text-4xl align-middle icon-drumeo-method text-drumeo"></i>
                    <img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                    <p class="mt-2" style="color:#A3AEC6;">
                        Step-by-step drum lessons for ALL skill levels.
                    </p>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/thumb-songs2.jpg"></div>
                <div class="px-3 lg:px-4 py-5 lg:py-7">
                    <i class="text-4xl align-middle icon-songs text-songs"></i>
                    <img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                    <p class="mt-2" style="color:#A3AEC6;">
                        Play-along tools for 3100+ famous drum songs.
                    </p>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden" style="background-color:#051124;">
                <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/thumb-coaches.jpg"></div>
                <div class="px-3 lg:px-4 py-5 lg:py-7">
                    <img class="h-8 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                    <img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                    <p class="mt-2" style="color:#A3AEC6;">
                        Ongoing support from legendary drummers.
                    </p>
                </div>
            </div>
        </div>

        <h3 class="font-extrabold leading-tight">
            Plus, choose your FREE bonus <br>bundle with your membership:
        </h3>

        <div class="flex flex-wrap items-end justify-center 2-full max-w-md md:max-w-3xl my-5 sm:my-7 mx-auto px-4 lg:px-0">
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl bg-drumeo"><strong>LIMITED TIME DEAL</strong></p>
                <a href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[quietkick]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&locked=true&promo-code=drumfest" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3">Better Practice Bundle</h5>
                        <h1 class="inline-block leading-none">
                            <s style="color:#BBBBBF;">$240</s>
                            <strong>$175</strong></h1>
                            <p class="inline-block -mr-5 italic">USD</p>
                        <p class="text-sm my-4"><em>Includes $126.95 in FREE bonuses</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Buy now</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>WHAT'S INCLUDED:</strong></p>
                        <p class="mb-1"><strong>Annual Drumeo Membership</strong></p>
                        <p class="mb-1">QuietKick <span class="text-drumeo">(FREE)</span></p>
                        <p class="mb-1">QuietPad <span class="text-drumeo">(FREE)</span></p>
                        <p>5A Drumsticks <span class="text-drumeo">(FREE)</span></p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl" style="background:
                #FFAE00;"><strong>LIMITED TIME DEAL</strong></p>
                <a href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=1&locked=true&promo-code=drumfest" class="text-black overflow-hidden rounded-2xl block mx-auto group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3">Sound Better Bundle</h5>
                        <h1 class="inline-block leading-none">
                            <s style="color:#BBBBBF;">$240</s>
                            <strong>$175</strong></h1><p class="inline-block -mr-5 italic">USD</p>
                        <p class="text-sm my-4"><em>Includes $161.95 in FREE bonuses</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px; background: #FFAE00;">Buy now</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>WHAT'S INCLUDED:</strong></p>
                        <p class="mb-1"><strong>Annual Drumeo Membership</strong></p>
                        <p class="mb-1">EarDrum In-ear Headphones <span class="text-drumeo">(FREE)</span></p>
                        <p class="sm:mb-1">5A Drumsticks <span class="text-drumeo">(FREE)</span></p>
                        <p class="hidden sm:inline-block">&nbsp;</p>
                    </div>
                </a>
            </div>
    </section>

    <section class="content-section text-center" style="background: #0c1429;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")

    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection
