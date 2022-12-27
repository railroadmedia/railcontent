@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true
        ])


    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
        <div class="container max-w-6xl mx-auto">
            <h1><strong>Your first week<br class="inline sm:hidden"> is free.</strong></h1>
            <h5 class="mt-2 md:mt-4">Choose the plan that will continue on <br class="inline lg:hidden">
                    {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} (after your free trial). Cancel anytime.</h5>

            <div class="flex items-end justify-center">
                <div class="px-2">
                    <p class="inline-block relative -bottom-1 mb-1 px-3 py-0.5 z-10 leading-tight text-black text-xs rounded-full" style="background-color:#00c9ac;">MOST POPULAR</p>
                    <div class="flex items-center rounded-xl border-2 border-drumeo px-3 py-2" style="background-color:#273040;">
                        <div class="text-left">
                            <img class="h-5 sm:h-6" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
                            <p class="opacity-60 text-sm"><em>Lessons + Songs</em></p>
                        </div>
                        <i class="fas fa-check-circle text-drumeo text-2xl ml-1 sm:ml-10"></i>
                    </div>
                </div>
                <div class="px-2">
                    <div class="flex items-center rounded-xl px-3 py-2" style="background-color:#273040;">
                        <div class="text-left">
                            <img class="h-5 sm:h-6" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
                            <p class="opacity-60 text-sm"><em>Lessons only.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em></p>
                        </div>
                        <i class="far fa-circle text-2xl ml-1 sm:ml-10"></i>
                    </div>
                </div>

            </div>

            <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-7 mx-auto">
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-black text-sm rounded-full" style="background-color:#ffac00;">SAVE 33%</p>
                    <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                        <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                            <h2 class="leading-none mb-3"><strong>Annual</strong></h2>
                            <h4 class="inline-block leading-none"><strong>${{ number_format(Prices::$drumeoEdgeAnnual / 12) }}/month</strong></h4>
                            <p class="text-sm mb-4"><em>Billed at ${{Prices::$drumeoEdgeAnnual}} per year.</em></p>
                            <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Free for 7 days</div>
                        </div>
                        <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                            <p class="mb-1"><strong>The world’s best drum lessons.</strong></p>
                            <p class="mb-1"><strong>5000+ popular songs.</strong></p>
                            <p class="mb-1"><strong>Unlimited personal support</strong></p>
                            <p class="mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                            <p class="mb-1">Lesson access for piano, guitar, and singing.</p>
                            <p>90-day money back guarantee.</p>
                        </div>
                    </a>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                        <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                            <h2 class="leading-none mb-3"><strong>Monthly</strong></h2>
                            <h4 class="inline-block leading-none"><strong>${{ Prices::$drumeoEdgeRegular }}/month</strong></h4>
                            <p class="text-sm mb-4"><em>Pay as you go.</em></p>
                            <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Free for 7 days</div>
                        </div>
                        <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                            <p class="mb-1"><strong>The world’s best drum lessons.</strong></p>
                            <p class="mb-1"><strong>5000+ popular songs.</strong></p>
                            <p class="mb-1"><strong>Unlimited personal support</strong></p>
                            <p class="mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                            <p class="mb-1">Lesson access for piano, guitar, and singing.</p>
                            <p>90-day money back guarantee.</p>
                        </div>
                    </a>
                </div>
            </div>
            <p><em>All prices listed in USD.</em></p>
        </div>
    </section>

    @include('musora.sales.components.plans-different-section')
    @include('drumeo._partials.faq')

    @include("drumeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stop
