@extends('guitareo.sales.standard-layout', [
"openVersion" => true,
])
{{--"trialVersion" => true,--}}

@section('meta')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    @parent
@endsection

@section('promo-banner')
    <section class="py-10 md:py-20 bg-center bg-cover bg-no-repeat" style="background-image:url('https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice_better_promo_bg.png')">
        <div class="max-w-md md:max-w-5xl mx-auto text-white px-2 lg:px-4">
            <div class="md:flex md:items-center md:gap-6 mb-10 text-center md:text-left">
                <div class="md:w-3/5 mb-6 md:mb-0">
                    <img class="h-16 md:h-20 lg:h-24 mb-4" src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/october/scary_logo_coloured.png" alt="scary good lesson logo">
                    <p class="mb-2 leading-tight">
                        <b>JOIN GUITAREO + GET 3 TRICK-FREE <br class="md:hidden">TREATS WORTH $441</b>
{{--                        <br>--}}
{{--                        <span class="tzcd-full text-coaches uppercase hidden md:inline"></span>--}}
{{--                        <span class="tzcd-small text-coaches uppercase md:hidden"></span>--}}
                    </p>
                    <p>
                        Don’t let guitar theory haunt you.
                        When you join today, you’ll get full access to the Guitareo METHOD – a 10-level curriculum designed to eliminate boring theory lessons AND help you to play music right away. <br><br>
                        You will have loads of fun advancing your guitar skills with resources such as play-along tracks and guitar challenges. <br><br>
                        Now that’s scary good. <br><br>
                        And as a special Halloween treat, you’ll also get LIFETIME access to three of the most popular lesson packs in Guitareo – so you can continue to unlock new guitar skills by playing songs you love.
                    </p>
                </div>
                <div class="md:w-2/5">
                    <img class="h-96 md:h-auto" src="https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/october/collage.png" alt="collage">
                </div>
            </div>
            <div class="text-center">
                <a class="join smaller md:w-52 lg:w-60" href="#orderNow" style="color:black;">See the deal</a>
            </div>
        </div>
    </section>
@endsection

@section('sticky-bar')
   <div class="h-10 relative w-full block"></div>
   <a href="#customize-anchor" {{--style="background-image:url(https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/september/sticky_bar.jpg)"--}}
           class="anchor-slide promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md z-0 mx-auto -mt-10 text-xs">
       <div class="relative">
        <div class="absolute inset-0" style="background:radial-gradient(50.22% 125.94% at 0% 0%, #00C9AC 0%, #E1FFFB 100%); transform:rotate(-180deg)"></div>
           <div class="inline-block align-middle text-left py-1 relative">
               <div class="inline-block leading-none font-bebas align-middle mx-auto text-2xl mr-2{{--py-0.5 px-1 bg-black rounded-md--}}text-white">
                   <img class="h-7 sm:h-8" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/october/scary_logo.png" alt="play-better-solos">
               </div>
{{--                --}}{{--<h5 class="leading-none font-bebas inline-block align-middle mx-auto text-2xl mr-2 h-8 py-1.5 px-2 bg-black rounded-md text-white">PLAY BETTER SOLOS</h5>--}}
               <p class="inline-block align-middle mx-auto text-black leading-none text-base font-bebas">GET SCARY GOOD GUITAR LESSONS <br>+ 3 TRICK-FREE TREATS WORTH $391</p>
           </div>
       </div>
   </a>
@endsection

{{--@section('final')--}}
{{--    @include("guitareo.sales.partials._subscribe-options")--}}
{{--@endsection--}}

{{--@section('start-button', '/choose-your-trial/')--}}
@section('final')
    {{-- @include("guitareo.sales.partials._final-trial", [ "sevenDay" => true, "url" => "/choose-your-trial/" ]) --}}
    @include('guitareo.sales.partials._subscribe-bonus-tiles')
@endsection
