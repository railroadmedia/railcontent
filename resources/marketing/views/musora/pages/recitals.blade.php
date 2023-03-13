@extends('musora._partials.layout')

@section('head-includes')
    @parent

    <title>Recitals | Musora</title>
    <meta property="og:title" content="Recitals | Musora">

    <meta name="description" content="We can’t wait to see your submission. Don’t be shy! Submit today!">
    <meta property="og:description" content="We can’t wait to see your submission. Don’t be shy! Submit today!">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/recitals/fb-share-image.png">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

<!-- Main -->
@section('layout-body')
    <div class="promo-banner text-white py-1 mt-10 md:mt-14 lg:mt-0 hidden md:block" style="background:linear-gradient(75.93deg, #00C9AC 0%, #0B76DB 32.62%, #8300E9 65.25%, #F61A30 92.11%)">
        <div class="container mx-auto relative z-10">
            <div class="text text-center flex justify-center items-center">
                <img class="logo h-11" src="https://dmmior4id2ysr.cloudfront.net/recitals/MusoraWinterRecital-logo.png">
                <p class="leading-tight">
                    <strong class="font-extrabold">Share your progress with the community!</strong> <br>
                    Submission deadline <strong class="font-extrabold">December 15th, 2022.</strong></p>
            </div>
        </div>
    </div>
    <section class="text-center text-white py-5 md:py-10 lg:py-16 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto max-w-5xl">
            <img class="h-24 sm:h-32 lg:h-40 mb-3 mt-10 md:mt-10" src="https://dmmior4id2ysr.cloudfront.net/recitals/MusoraWinterRecital-logo.png" alt="recital logo">
            <h3 class="leading-tight"><strong>Be a part of the first ever <br>Musora Winter Recital!</strong></h3>
            <a class="btn-primary anchor-slide mt-5 mb-10 md:mt-7 md:mb-20 bg-musora border-none" href="#form">Submit Now &raquo;</a>
            <div class="flex flex-wrap items-center justify-center mx-auto max-w-4xl">
                <div class="flex flex-wrap items-start flex-image mx-auto w-full md:w-2/5 lg:w-5/12 md:order-1 mb-5 md:mb-0 justify-center">
                    <img class="h-72 md:h-auto" src="https://dmmior4id2ysr.cloudfront.net/recitals/collage.png">
                </div>
                <div class="text-left md:pr-3 lg:pr-8 w-full md:w-3/5 lg:w-7/12">
                    <p class="mx-auto">
                        What are you submitting for our annual Winter Recital? With over 65,000 Musora students, we’re sure to see a variety of talents shared. <br><br>
                        It’s always a great way for our community - from beginners through to advanced players - to share their progress with each other and celebrate how far they’ve come together. <br><br>
                        It’s super easy to make your submission. You can choose ANY video of yourself playing your instrument. <br><br>
                        It could be a song, a beat, a riff, or a fill! <br><br>
                        Anything that you learned this year and you’re proud of. <br><br>
                        Once you’ve submitted, mark your calendar and join us on December 17th for the event so that you can cheer on the rest of the Musora community. <br><br>
                        We’re all on this learning journey together. Be proud of your progress and submit your video today!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 md:py-10 lg:py-16" style="background:linear-gradient(74.85deg, rgba(0, 201, 172, 0.1) 0%, rgba(11, 118, 219, 0.1) 32.1%, rgba(131, 0, 233, 0.1) 64.2%, rgba(246, 26, 48, 0.1) 90.64%);">
        <div class="container mx-auto max-w-3xl">
            <div id="form" class="anchor"></div>
            <iframe class="google-form w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSe1OVOvfpYBC16bvflk_bB8rCv1GQ42DjgmyF73woI1RqnO0Q/viewform?embedded=true" height="1110" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div>
    </section>
@stop
