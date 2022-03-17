@extends('guitareo.products.guitar-quest.guitar-quest-sales-layout')

@php $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&promo-code=siah-deal&redirect=/order&payment-plan=1' @endphp
@php $orderLinkAlt = '/ecommerce/add-to-cart?products[guitar-quest]=1&promo-code=siah-deal&redirect=/order&payment-plan=5' @endphp
@php $productPrice = \App\Prices::$guitarQuestSpecial @endphp

@section('promo-banner')
    <section class="tw-py-8 md:tw-py-12 tw-relative tw-text-white tw-text-center" style="z-index: 51;margin: 0 auto -70px; background:#000612;">
        <div class="tw-max-w-screen-xl tw-m-auto tw-px-6 lg:tw-flex lg:tw-items-start">
            <img class="tw-inline-block tw-w-3/4 sm:tw-w-full sm:tw-max-w-sm tw-mb-5 lg:tw-mb-0 tw-mx-auto lg:tw-mx-0" src="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/logo-with.png">
            <div class="lg:tw-pl-10 tw-max-w-lg lg:tw-max-w-2xl tw-mx-auto lg:tw-mx-0">
                <p class="font-primary tw-text-lg sm:tw-text-xl"><strong class="tw-font-black">CONTINUE YOUR JOURNEY <i class="fas fa-long-arrow-right tw-mx-1 text-goldenrod"></i> <span class="tw-inline-block"> SAVE {{ round(100 - (100 * (\App\Prices::$guitarQuestSpecial / \App\Prices::$guitarQuestFull))) }}% ON GUITAR QUEST</span></strong></p>
                <p class="font-primary tw-text-sm sm:tw-text-base tw-my-4 tw-leading-relaxed tw-text-left">
                    Congratulations on learning 2 Simple Guitar Tricks. Now let’s put them to use! These tricks are taken directly from a level of Rob GuitarQuest course.
                    <br><br>
                    So if you’ve enjoyed learning these tricks, we know you’ll love the rest. And because we want you to keep learning and having fun on the guitar, we’re giving you a {{ round(100 - (100 * (\App\Prices::$guitarQuestSpecial / \App\Prices::$guitarQuestFull))) }}% discount to continue your journey with Rob. Just click any of the big buttons on this page to get started.
                </p>
                <a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient tw-transition tw-duration-500 tw-linear tw-px-12 tw-py-1 tw-inline-block tw-uppercase tw-text-black font-roboto-condensed-bold tw-rounded-full tw-text-lg">
                    GET MY DISCOUNT &raquo;
                </a>
            </div>
        </div>
    </section>
    <!-- Banner -->
    <a href="{{ $orderLink }}" class="tw-w-full bg-gq-purple tw-py-2 tw-text-center tw-sticky tw-z-50 tw-block tw-text-white"
            style="top: 56px;"
    >
        <img class="tw-inline-block tw-w-32" src="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/logo-with.png">
        <p class="tw-uppercase tw-my-0 tw-ml-3 tw-inline-block tw-align-middle tw-text-sm sm:tw-text-base tw-text-left" style="line-height: 1.2!important;">
            SAVE {{ round(100 - (100 * (\App\Prices::$guitarQuestSpecial / \App\Prices::$guitarQuestFull))) }}% ON GUITAR QUEST<br>
        <s class="tw-opacity-60">WAS ${{ \App\Prices::$guitarQuestFull }}</s> <strong class="tw-font-black text-goldenrod">ONLY ${{ $productPrice }}</strong>
        </p>
    </a>
@endsection

@section('final')
    <!-- Start Here -->
    {{-- Guitar Quest: Start Here --}}
    <section class="tw-py-24 tw-bg-top tw-bg-cover md:tw-py-48" style="background-image: url({{ imgix("https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/order-background.jpg", ["auto" => "format", "w" => 1500]) }})">
        <div class="tw-max-w-screen-xl tw-m-auto tw-px-4 md:tw-px-6 tw-flex">
            <div class="tw-w-full tw-m-auto tw-text-white tw-text-center lg:tw-w-10/12">
                <img src="{{ imgix("https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png", ["auto" => "format", "w" => 700]) }}" width="400px" class="tw-m-auto tw-block tw-mb-10">
                <h2 class="tw-uppercase tw-text-3xl font-bison-bold sm:tw-text-5xl md:tw-text-6xl tw-mb-2">Your Guitar Journey<br class="tw-inline xl:tw-hidden"> Starts Here.</h2>

                <h4 class="tw-text-xl tw-mb-2 md:tw-mb-10 font-primary sm:tw-text-2xl md:tw-text-3xl">
                    @if($productPrice < \App\Prices::$guitarQuestFull)
                        <span class="tw-text-gray-500 tw-line-through">Normally&nbsp;$197</span>
                        <span class="tw-font-bold text-goldenrod tw-uppercase tw-font-extrabold">Only&nbsp;${{ $productPrice }}</span>
                        <span>(Save&nbsp;{{ round(100 - (100 * ($productPrice / \App\Prices::$guitarQuestFull))) }}%)</span>
                    @else
                        <span class="text-goldenrod tw-uppercase">
                        Reach your goals on the <br class="tw-inline xl:tw-hidden">
                        guitar for just&nbsp;${{ $productPrice }}</span>
                    @endif
                </h4>

                <a title="Go To Order Page" href="{{ $orderLink }}" class="bg-goldenrod-gradient tw-transition tw-duration-500 tw-linear tw-px-4 tw-py-4 tw-w-full tw-inline-block tw-uppercase tw-text-black font-roboto-condensed-bold tw-rounded-full tw-text-3xl tw-mb-5 md:tw-w-3/4">
                    Start Your Quest &raquo;
                </a>
                <p class="font-primary tw-text-sm tw-mb-10">
                    <a href="{{ $orderLinkAlt }}" class="text-goldenrod tw-underline tw-font-bold tw-transition-colors text-goldenrod-hover" title="Go To Order Page">OR CHOOSE A PAYMENT PLAN<br class="tw-inline sm:tw-hidden">
                        ON THE NEXT PAGE</a>
                </p>

                <div class="tw-opacity-40 tw-flex tw-justify-center tw-text-5xl tw-mb-4">
                    <i class="fab fa-cc-visa tw-mr-2"></i>
                    <i class="fab fa-cc-mastercard tw-mr-2"></i>
                    <i class="fab fa-cc-amex tw-mr-2"></i>
                    <i class="fab fa-cc-paypal tw-mr-2"></i>
                </div>
                <p class="tw-opacity-40 tw-text-xs tw-m-0 tw-font-semibold">Any questions? Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.</p>
            </div>
        </div>
    </section>
    {{--@include("products.guitar-quest.partials.sections._start-here", [--}}
    {{--"discountVersion" => true--}}
    {{--])--}}
@endsection