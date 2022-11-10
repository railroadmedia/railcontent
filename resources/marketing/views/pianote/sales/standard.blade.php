{{--@extends('pianote.sales.standard-layout')--}}

@section('meta')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    {{ App\Analytics\Tracker::trackProductDetailsImpression('PIANOTE-MEMBERSHIP-1-MONTH') }}
    {{ App\Analytics\Tracker::trackProductDetailsImpression('PIANOTE-MEMBERSHIP-1-YEAR') }}
@endsection

@section('promo-banner')
{{--    <section class="bg-center bg-cover bg-no-repeat pt-12 md:pt-20" style="background-image: url('https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice_better_promo_bg.png');">--}}
{{--        <div class="container max-w-md md:max-w-3xl lg:max-w-4xl mx-auto text-white px-6 lg:px-0">--}}
{{--            <div class="md:flex md:items-center mb-10 text-center md:text-left">--}}
{{--                <div class="md:w-7/12 lg:flex-1 mb-6 md:mb-0">--}}
{{--                    <img class="h-16 md:h-20 mb-2" src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice-better-logo.png" alt="practice better logo">--}}
{{--                    <p class="leading-tight mb-6 uppercase">--}}
{{--                        <b>JOIN PIANOTE + GET 6 FREE BONUSES WORTH $262</b>--}}
{{--                        <br>--}}
{{--                        <span class="text-coaches">--}}
{{--                        ONLY--}}
{{--                        <span class="tzcd-full hidden md:inline">a limited time</span>--}}
{{--                        <span class="tzcd-small md:hidden">a limited time</span>--}}
{{--                        LEFT!--}}
{{--                            </span>--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        Better practice makes a better piano player. <br><br>--}}
{{--                        It’s simple. But that doesn’t mean it’s easy. Because so many online apps and resources leave you on your own to figure out what to do.--}}
{{--                        We’re changing that. <br><br>--}}
{{--                        This month when you join Pianote you’ll get 6 great bonuses to help you practice better -- so you’ll play better. You’ll get a custom Practice Planner made exclusively for piano players. You’ll also get some great posters to hang in your practice space and LIFETIME access to 2 full-length courses.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="w-2/3 md:w-5/12 lg:flex-1 md:pl-6 lg:pl-10 text-center mx-auto md:mx-0">--}}
{{--                    <img src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice-better-collage.png" alt="practice better collage image">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="text-center">--}}
{{--                <a href="#orderNow" class="join smaller blue anchor-slide md:w-1/4 mx-auto">See the deal</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection

@section('sticky-bar')
{{--   <div class="h-10 w-full block" style="background:linear-gradient(140deg, #fff, #fd5257);"></div>--}}
{{--   <a href="#orderNow" style="background:linear-gradient(140deg, #fff, #fd5257);"--}}
{{--       class="promo-banner anchor-slide block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap--}}{{--text-white--}}{{----}}{{-- bg-cover bg-center shadow-md py-1 --}}{{----}}{{--hover:text-gray-100--}}{{--z-0 mx-auto -mt-10 text-xs py-2">--}}
{{--       <div class="container mx-auto relative">--}}
{{--           <div class="inline-block align-middle text-center">--}}
{{--               <img class="inline-block align-middle mr-2 h-8 filter saturate-0 brightness-0" src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/october/logo_black.png" alt="promo logo">--}}
{{--              --}}{{-- <h5 class="leading-none font-bebas inline-block align-middle mx-auto text-2xl mr-2 h-8 py-1.5 px-2 bg-black rounded-md">Try Pianote</h5> --}}
{{--               <p class="leading-none inline-block align-middle mx-auto text-xs text-left mt-1"><strong>PRACTICE BETTER. PLAYER BETTER.<br> 6 BONUSES WORTH $262</strong></p>--}}
{{--           </div>--}}
{{--       </div>--}}
{{--   </a>--}}
@endsection

@section('final')
     @include('pianote.sales.partials._subscribe-cards')
{{--    @include('pianote.sales.partials._subscribe-bonus-list')--}}
@endsection
