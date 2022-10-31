@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Hand Technique - The Motions Of Drumming | Drumeo</title>
    <meta name="description" content="">
    <!-- Social Media -->
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/share-image.jpg">
    <meta property="og:title" content="Hand Technique - The Motions Of Drumming">
    <meta property="og:description" content="Learn drumming's 3 hand techniques in this FREE series.">
    <meta property="og:url" content="https://www.drumeo.com/hand-technique/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
@stop

@section('content')
    <header class="pt-8 sm:pt-20">
        <div class="max-w-xl md:max-w-4xl mx-auto flex flex-col md:flex-row px-3 sm:px-4 lg:px-0 text-center md:text-left md:items-center">
            <div class="w-full md:w-7/12 lg:w-1/2">
                <div class="md:px-2">
                    <picture>
                        <source media="(min-width:768px)" srcset="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/logo_left.png">
                        <img class="h-16 mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/logo_center.png" alt="hand technique logo">
                    </picture>

                    <img class="md:hidden object-cover h-full w-full rounded-lg mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/intro_m.jpg" alt="intro image">

                    <h3 class="font-extrabold leading-tight">
                        Learn drumming's 3 hand techniques in this FREE series.
                    </h3>
                    <p class="my-4" style="color: rgba(0, 0, 0, 0.8);">
                        Enter your email address below to unlock your lessons...
                    </p>
                </div>

                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "formId" => "Drumeo - Engagement - Trigger - Hand Technique - Web Form",
                    "formName" => 'Hand Technique',
                    "buttonText" => "Get started for free ",
                    'stacked' => true,
                    'inputBorder' => '1px solid #7A8491',
                ])
            </div>
            <div class="w-full sm:w-5/12 lg:w-1/2">
                <div class="px-4 lg:px-10 h-full w-full">
                    <img class="hidden md:inline-block object-cover h-full w-full rounded-lg lazyload" data-src="https://cdn.musora.com/image/fetch/w_860,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/intro.jpg" alt="intro image">
                </div>
            </div>

        </div>
    </header>

    <section class="py-20">
        <div class="max-w-lg sm:max-w-4xl lg:max-w-6xl mx-auto">
            <p class="text-center text-xs uppercase mb-2 sm:mb-4 tracking-widest" style="color: #ABB5C2;">
                What you'll get
            </p>
            <h3 class="text-center leading-tight font-extrabold mb-10 px-2 sm:px-0">
                Improve your speed & control <br>
                around the drum set.
            </h3>
            <div class="flex flex-wrap mb-14 sm:px-2">
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_740,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/Lesson1.jpg" alt="thumb1">
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/Lesson2.jpg" alt="thumb2">
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/Lesson3.jpg" alt="thumb3">
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/Lesson4.jpg" alt="thumb4">
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/Lesson5.jpg" alt="thumb5">
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/Lesson6.jpg" alt="thumb6">
                </div>
            </div>
            <h5 class="font-extrabold text-center italic">
                You’ll get 6 FREE lessons in total.
            </h5>
        </div>
    </section>

    <section class="pt-32 pb-20 px-2 sm:px-4 relative" style="background: #F2F8FB;">
        <div class="h-10 absolute left-0 right-0" style="background: linear-gradient(to top left, #F2F8FB calc(50% - 1px), #F2F8FB, #fff calc(50% + 1px)); top: -1px;"></div>
        <div class="max-w-xl md:max-w-3xl mx-auto text-center">
            <img class="h-20 sm:h-24 lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/logo_center.png" alt="logo centered">
            <h3 class="leading-tight font-extrabold my-10">
                Enter your email address<br class="inline sm:hidden"> below to get started:
            </h3>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "formId" => "Drumeo - Engagement - Trigger - Hand Technique - Web Form",
                "formName" => 'Hand Technique',
                "buttonText" => "Get started for free ",
                'inputBorder' => '1px solid #7A8491',
            ])
        </div>
    </section>
@stop
