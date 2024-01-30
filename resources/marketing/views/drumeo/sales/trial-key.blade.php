@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
])
@section('body-data')
    x-data ='{
    soundslice : false,
    waitlist: false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    keyTrailer : false,
    }'
@endsection

@section('top-bar')
<div class="h-10 w-full block"></div>
    <a href="/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&products[Drumeo-Key]=1&promo-code=key-trial&locked=true" class="promo-banner flex items-center justify-center py-1.5 px-2 sm:px-0 w-full z-[100] -mt-10 transition-none" style="background: linear-gradient(330deg, #79EE9A, #12E3FF, #79EE9A);">
        <h4 class="inline-block ml-0 mr-4 bg-white rounded-md font-bebas py-0.5 px-2 leading-none text-black">FEB 1-10</h4>
        <p class="text-sm sm:text-lg font-bebas uppercase mx-0 leading-none sm:leading-none text-black">
            Get a FREE Drum Key when you try Drumeo for 7 days.<br>
            ONLY
            <span x-cloak x-data="timer()" x-init="countdown()">
                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                 </span>
            LEFT
        </p>
    </a>
@endsection

@section('promo-banner')

    <section class="text-center px-5 sm:px-6 pb-6 sm:py-0 text-black" style="background: linear-gradient(330deg, #79EE9A, #12E3FF, #79EE9A);">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-48 sm:h-72 lg:h-96 sm:order-1" src="https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drum-key.png">
                <div class="text-center sm:text-left w-full sm:w-auto">
                    <h2><strong>Free Drum Key</strong></h2>
                    <h5 class="leading-tight mt-2 sm:mt-3 mb-6 sm:mb-8">Grab a solid pewter drum key when <br class="hidden sm:inline"> you start a 7-day trial of Drumeo.</h5>
                    <a class="sm:mx-1 join smaller black" href="/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&products[Drumeo-Key]=1&promo-code=key-trial&locked=true">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
                    <div class="sm:mx-1 join smaller outline black" x-on:click="keyTrailer = true;">WATCH VIDEO</div>
                    <p class="text-sm mt-2"><em>Free worldwide shipping!</em></p>
                </div>

            </div>
        </div>
    </section>
    <div class="sticky-trigger block"></div>
@endsection
@section('final')
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-black" style="background: linear-gradient(330deg, #79EE9A, #12E3FF, #79EE9A);">
        <div class="container mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="hidden sm:inline-block sm:h-64 lg:h-96 order-1" src="https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drum-key-free-shipping.png">
                <img class="h-48 inline-block sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drum-key-free-shipping-m.png">
                <div class="text-center w-full sm:w-auto">
                    <h2><strong>Try Drumeo for 7 days<br class="hidden sm:inline"> & get a free drum key.</strong></h2>
                    <p class="leading-normal my-4 sm:my-5">Click below to start your plan that will continue on<br class="hidden sm:inline"> {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} (after your free trial). Cancel anytime. <br>
                        <strong class="uppercase font-black">ONLY
                            <span x-cloak x-data="timer()" x-init="countdown()">
                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                 </span>
                            LEFT</strong>
                    </p>
                    <a class="join drumeo w-full my-6" href="/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&products[Drumeo-Key]=1&promo-code=key-trial&locked=true">7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
                    <a class="text-sm" href="/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true"><em><u>OR start a Monthly membership (no free bonuses).</u></em></a>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('scripts')
    @include('_partials.components.video-modal',[
        'name' => 'keyTrailer',
        'video' => '834810213',
        'vimeo' => true,
    ])

    @include('_partials.components.countdown',[
    'countdownDate' => '2024-02-10 00:00:00',
    'promoVersion' => false
    ])
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            window.addEventListener('scroll', function () {
                var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
                var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
                if (window.scrollY > (unstickTrigger - 115)) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < stickTrigger - 115) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                    stickyBar.classList.add('fixed', 'mt-0');
                }
            });
        });
    </script>
@endsection



