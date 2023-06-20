@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora - Social Learning Communities For Musicians</title>
    <meta property="og:title" content="Musora - Social Learning Communities For Musicians">

    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote. ">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote.">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
@endsection

<!-- Main -->
@section('layout-body')

    <section class="py-12 md:py-20 relative overflow-hidden text-black text-center">
        <div class="container mx-auto relative z-0">
            <p class="text-4xl text-green-500"><strong><i class="fas fa-check"></i> Success!</strong></p>
            <h2 class="text-7xl font-bold mt-5 mb-5">Check your email.</h2>
            <p><em>You should receive an email with more information from team@musora.com within 10 minutes.
                    <br class="show-for-medium"> If you don’t, then check your spam folder or re-enter your email address again.</em>
            </p>

            <a href="/members" class="btn-primary btn-small text-base leading-none bg-musora mt-8 border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Log In</a>
            <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop" class="btn-primary btn-small mt-8 text-base leading-none bg-drumeo border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Drumeo Shop</a>
            <a href="{{ get_legacy_brand_base_url('pianote') }}/shop" class="btn-primary btn-small mt-8 text-base leading-none bg-pianote border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Pianote Shop</a>
            <a href="{{ get_legacy_brand_base_url('guitareo') }}/shop" class="btn-primary btn-small mt-8 text-base leading-none bg-guitareo border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Guitareo Shop</a>
            <a href="{{ get_legacy_brand_base_url('singeo') }}/shop" class="btn-primary btn-small mt-8 text-base leading-none bg-singeo border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Singeo Shop</a>
        </div>
    </section>
@stop
