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
    <style>
        .option-buttons.active {
            border-color:#0b76db!important;
            background-color:#0c2949!important;
        }
        .option-buttons.active .radio-check {
            border-color:#0b76db!important;
            background-color:#0b76db!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
    </style>
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

            <div class="flex items-end justify-center my-5">
                <div class="px-2">
                    <p class="inline-block relative -bottom-1 mb-1 px-3 py-0.5 z-10 leading-tight text-black text-xs rounded-full" style="background-color:#00c9ac;">MOST POPULAR</p>
                    <div id="plusButton" class="active option-buttons hover:opacity-90 cursor-pointer border-2 flex items-center rounded-xl py-4 px-5" style="border-color:#0c1524;background-color:#273040;">
                        <div class="text-left">
                            <img class="h-5 sm:h-6" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeoplus_logo.svg">
                            <p class="opacity-60 text-xs no-select mt-0.5"><em>Lessons + Songs</em></p>
                        </div>
                        <div class="radio-check ml-1 sm:ml-10 w-7 h-7 flex content-center justify-center border-2 rounded-full border-gray-500 text-gray-500">
                            <i class="fas fa-check text-base text-white hidden"></i>
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <div id="nonPlusButton" class="option-buttons hover:opacity-90 cursor-pointer border-2 flex items-center rounded-xl py-4 px-5" style="border-color:#0c1524;background-color:#273040;">
                        <div class="text-left">
                            <img class="h-5 sm:h-6" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                            <p class="opacity-60 text-xs no-select mt-0.5"><em>Lessons only.</em></p>
                        </div>
                        <div class="radio-check ml-1 sm:ml-14 w-7 h-7 flex content-center justify-center border-2 rounded-full border-gray-500 text-gray-500">
                            <i class="fas fa-check text-base text-white hidden"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div id="plusOptions" class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto">
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-black text-sm rounded-full" style="background-color:#ffac00;">SAVE 33%</p>
                    <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="leading-none mb-6"><strong>Annual</strong></h2>
                            <h4 class="inline-block leading-none"><strong>${{ number_format(Prices::$drumeoEdgeAnnual / 12) }}/month</strong></h4>
                            <p class="text-sm mb-6"><em>Billed at ${{Prices::$drumeoEdgeAnnual}} per year.</em></p>
                            <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Free for 7 days</div>
                        </div>
                        <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #e7edf4;">
                            <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                            <p class="text-sm mb-1"><strong>5000+ popular songs.</strong></p>
                            <p class="text-sm mb-1"><strong>Unlimited personal support</strong></p>
                            <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                            <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                            <p class="text-sm">90-day money back guarantee.</p>
                        </div>
                    </a>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="leading-none mb-6"><strong>Monthly</strong></h2>
                            <h4 class="inline-block leading-none"><strong>${{ Prices::$drumeoEdgeRegular }}/month</strong></h4>
                            <p class="text-sm mb-6"><em>Pay as you go.</em></p>
                            <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Free for 7 days</div>
                        </div>
                        <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #e7edf4;">
                            <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                            <p class="text-sm mb-1"><strong>5000+ popular songs.</strong></p>
                            <p class="text-sm mb-1"><strong>Unlimited personal support</strong></p>
                            <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                            <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                            <p class="text-sm">90-day money back guarantee.</p>
                        </div>
                    </a>
                </div>
            </div>
            <div id="nonPlusOptions" class="hidden flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto">
                <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-black text-sm rounded-full" style="background-color:#ffac00;">SAVE 33%</p>
                    <a href="todo" class="text-black overflow-hidden rounded-t-2xl block mx-auto group">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="leading-none mb-6"><strong>Annual</strong></h2>
                            <h4 class="inline-block leading-none"><strong>${{ number_format(200 / 12, 2) }}/month</strong></h4>
                            <p class="text-sm mb-6"><em>Billed at ${{200}} per year.</em></p>
                            <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Free for 7 days</div>
                        </div>
                    </a>
                        <div class="text-black overflow-hidden rounded-b-2xl block mx-auto group px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #e7edf4;">
                            <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                            <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                            <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                            <p class="text-sm mb-2">90-day money back guarantee.</p>
                            <a class="todo" href=""><p class="text-sm text-{{ $theme }}">You can add 5000+ popular songs<br> for just $40/year. <u>Click Here.</u></p></a>
                        </div>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                    <a href="todo" class="text-black overflow-hidden rounded-t-2xl block mx-auto group">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="leading-none mb-6"><strong>Monthly</strong></h2>
                            <h4 class="inline-block leading-none"><strong>${{ 25 }}/month</strong></h4>
                            <p class="text-sm mb-6"><em>Pay as you go.</em></p>
                            <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Free for 7 days</div>
                        </div>
                    </a>
                        <div class="text-black overflow-hidden rounded-b-2xl block mx-auto group px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #e7edf4;">
                            <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                            <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                            <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                            <p class="text-sm mb-2">90-day money back guarantee.</p>
                            <a class="todo" href=""><p class="text-sm text-{{ $theme }}">You can add 5000+ popular songs<br> for just $40/year. <u>Click Here.</u></p></a>
                        </div>
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
    <script>
        $(document).ready(function ($) {
            $('#plusButton').on('click', function(){
                $('#nonPlusButton').removeClass('active');
                $('#nonPlusOptions').addClass('hidden');

                $('#plusButton').addClass('active');
                $('#plusOptions').removeClass('hidden');
            });
            $('#nonPlusButton').on('click', function(){
                $('#plusButton').removeClass('active');
                $('#plusOptions').addClass('hidden');

                $('#nonPlusButton').addClass('active');
                $('#nonPlusOptions').removeClass('hidden');
            });
        });
    </script>
@stop
