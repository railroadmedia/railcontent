@extends('drumeo.sales.subscription')

@section('global-head')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/trial/">
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('promo-banner')
    <div class="text-white px-4 py-8 md:py-16 relative z-10 bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/bg.jpg');">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-start text-center" style="max-width: 1050px;">
                <img class="avatar mx-auto mb-3 sm:mb-0 w-48 md:w-52 lg:w-72" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/logo2.png">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong>Blue Man Group: Unlimited Drum Lessons For 30 Days</strong></h2>
                    <h6 class="leading-normal my-3 md:my-5">Drumeo and Blue Man Group have teamed up to help you learn the world's greatest instrument. For a limited time, you can grab your first 30 days of drum lessons FREE. Inside Drumeo, you'll find all the lessons, songs and support you need to get started or take your drumming to the next level. Scroll down to redeem your offer.</h6>
                    <a href="/choose-your-trial-month" class="join smaller musora">START MY FREE TRIAL <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
