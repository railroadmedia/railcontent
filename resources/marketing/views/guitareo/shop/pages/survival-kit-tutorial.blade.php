@extends('guitareo.shop.shop-page-layout')

@section('styles')
    @parent
    <title>The Guitarist's Survival Kit</title>
    <meta name="description" content="How to U  se The Guitarist's Survival Kit in 3 Simple Steps">
    <meta property="og:description" content="How to U  se The Guitarist's Survival Kit in 3 Simple Steps">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-fb-share.jpg" style="display: none;">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
@stop()
@section('scripts')
    @parent
    <script type="text/javascript" src="/marketing/js/modal.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/js/modal-autoplay.js"></script>
@stop()

@section('banner')
    <section class="pb-60 bg-cover bg-center" style="background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-tutorial-header.jpg')">
    </section>

    <section class="py-6 md:py-20 text-2xl">
        <h4 class="font-extrabold mb-4 text-center">How to Use The Guitarist's Survival Kit <br class="hidden md:inline">in 3 Simple Steps</h4>
        <div class="grid md:grid-cols-3 gap-4 md:gap-2 lg:gap-4 max-w-xl md:max-w-5xl mx-auto px-4 lg:px-0">
            <div data-open="step1" class="cursor-pointer autoplay-video">
                <img class="rounded-xl w-full" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-thumb-01.jpg" alt="thumb 1">
                <div class="font-bold text-sm md:text-base">Step 1: Stay Perfectly in Tune</div>
                <div class="text-sm md:text-base">Using the Nexxus 360 Tuner</div>
            </div>
            <div data-open="step2" class="cursor-pointer autoplay-video">
                <img class="rounded-xl w-full" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-thumb-02.jpg" alt="thumb 2">
                <div class="font-bold text-sm md:text-base">Step 2: Get Crisp, Clean Notes</div>
                <div class="text-sm md:text-base">Changing Your Strings on Electric or Acoustic Guitar</div>
            </div>
            <div data-open="step3" class="cursor-pointer autoplay-video">
                <img class="rounded-xl w-full" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-thumb-03.jpg" alt="thumb 3">
                <div class="font-bold text-sm md:text-base leading-tight">Step 3: Pick on Great Licks // Freshen up Your Look</div>
                <div class="text-sm md:text-base">Referring to the Survival Guide</div>
            </div>
        </div>
    </section>


    <div class="reveal large" id="step1" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/774474864?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="reveal large" id="step2" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/774474985?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="reveal large" id="step3" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/774475015?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
@endsection

