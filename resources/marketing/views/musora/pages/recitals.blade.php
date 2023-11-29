@extends('musora._partials.layout')

@section('head-includes')
    @parent

    <title>Recitals | Musora</title>
    <meta property="og:title" content="Recitals | Musora">

    <meta name="description" content="We can’t wait to see your submission. Don’t be shy! Submit today!">
    <meta property="og:description" content="We can’t wait to see your submission. Don’t be shy! Submit today!">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

<!-- Main -->
@section('layout-body')
    <div class="promo-banner py-1 mt-10 md:mt-0 hidden md:block bg-musora">
        <div class="container mx-auto relative z-10">
            <div class="text text-center flex justify-center items-center">
                <p class="leading-tight">
                    <strong class="font-extrabold">Share your progress with the community!</strong> <br>
                    Submission deadline <strong class="font-extrabold">December 8th, 2023.</strong></p>
            </div>
        </div>
    </div>
    <section class="text-center text-white py-5 md:py-10 lg:py-16 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto max-w-5xl">
            <img class="h-32 sm:h-48 lg:h-52 mb-3" src="https://dmmior4id2ysr.cloudfront.net/recitals/winter-logo-23.png" alt="recital logo">
            <h3 class="leading-tight"><strong>Be a part of the<br class="sm:hidden"> Musora Winter Recital!</strong></h3>
            <a class="btn-primary anchor-slide mt-5 mb-10 md:mt-7 md:mb-20 bg-musora text-black border-none hover:opacity-90" href="#form">Submit Now &raquo;</a>
            <div class="flex flex-wrap items-center justify-center mx-auto max-w-4xl">
                <div class="flex flex-wrap items-start flex-image mx-auto w-full md:w-2/5 lg:w-5/12 md:order-1 mb-5 md:mb-0 justify-center">
                    <img class="h-72 md:h-auto" src="https://dmmior4id2ysr.cloudfront.net/recitals/collage.png">
                </div>
                <div class="text-left md:pr-3 lg:pr-8 w-full md:w-3/5 lg:w-7/12">
                    <p class="mx-auto">
                        What are you submitting for our annual Winter Recital? With over {{ number_format(round (Prices::$students, -3)) }} Musora students, we're sure to see a variety of talents shared.
                        <br><br>
                        It's always a great way for our community - from beginners through to advanced players - to share their progress with each other and celebrate how far they've come together.
                        <br><br>
                        It's super easy to make your submission. You can choose ANY video of yourself playing your instrument.
                        <br><br>
                        It could be a song, a beat, a riff, or a fill!
                        <br><br>
                        Anything that you learned this year and you're proud of.
                        <br><br>
                        Once you've submitted, we'll connect with you the 2nd week of December with your recital date and session time, but feel free to join and watch any time during the week of December 18-22nd where we'll be streaming the recitals all week!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 md:py-6 lg:py-8" style="background:#f6f8fc;">
        <div class="container mx-auto max-w-3xl">
            <div id="form" class="anchor"></div>
            <iframe class="google-form w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSdCE27g48yJ4MECweLJD5RZl5TUSid_N-2WMK6Q4G4DFEy2iA/viewform?embedded=true" height="690" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div>
    </section>
@stop
