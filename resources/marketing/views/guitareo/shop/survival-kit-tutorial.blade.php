@extends('shop.product-layout')

@section('styles')
    @parent
    <title>The Guitarist's Survival Kit</title>
    <meta name="description" content="How to U  se The Guitarist's Survival Kit in 3 Simple Steps">
    <meta property="og:description" content="How to U  se The Guitarist's Survival Kit in 3 Simple Steps">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/shop/survival-kit/survival-kit-fb-share.jpg" style="display: none;">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    <link href="{{ asset('/assets/marketing/sales-page.css') }}" rel="stylesheet">
@stop()
@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop()

@section('banner')
    <section class="tw-pb-60 tw-bg-cover tw-bg-center" style="background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d122ay5chh2hr5.cloudfront.net/shop/survival-kit/survival-kit-tutorial-header.jpg')">
    </section>

    <section class="tw-py-6 md:tw-py-20 tw-text-2xl">
        <h4 class="tw-font-extrabold tw-mb-4 tw-text-center">How to Use The Guitarist's Survival Kit <br class="tw-hidden md:tw-inline">in 3 Simple Steps</h4>
        <div class="tw-grid md:tw-grid-cols-3 tw-gap-4 md:tw-gap-2 lg:tw-gap-4 tw-max-w-xl md:tw-max-w-5xl tw-mx-auto tw-px-4 lg:tw-px-0">
            <div data-open="step1" class="tw-cursor-pointer autoplay-video">
                <img class="tw-rounded-xl tw-w-full" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d122ay5chh2hr5.cloudfront.net/shop/survival-kit/survival-kit-thumb-01.jpg" alt="thumb 1">
                <div class="tw-font-bold tw-text-sm md:tw-text-base">Step 1: Stay Perfectly in Tune</div>
                <div class="tw-text-sm md:tw-text-base">Using the Nexxus 360 Tuner</div>
            </div>
            <div data-open="step2" class="tw-cursor-pointer autoplay-video">
                <img class="tw-rounded-xl tw-w-full" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d122ay5chh2hr5.cloudfront.net/shop/survival-kit/survival-kit-thumb-02.jpg" alt="thumb 2">
                <div class="tw-font-bold tw-text-sm md:tw-text-base">Step 2: Get Crisp, Clean Notes</div>
                <div class="tw-text-sm md:tw-text-base">Changing Your Strings on Electric or Acoustic Guitar</div>
            </div>
            <div data-open="step3" class="tw-cursor-pointer autoplay-video">
                <img class="tw-rounded-xl tw-w-full" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d122ay5chh2hr5.cloudfront.net/shop/survival-kit/survival-kit-thumb-03.jpg" alt="thumb 3">
                <div class="tw-font-bold tw-text-sm md:tw-text-base tw-leading-tight">Step 3: Pick on Great Licks // Freshen up Your Look</div>
                <div class="tw-text-sm md:tw-text-base">Referring to the Survival Guide</div>
            </div>
        </div>
    </section>


    <div class="reveal large" id="step1" data-reveal data-reset-on-close="false">
        <div class="tw-aspect-16:9 tw-w-full tw-relative">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/774474864?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="reveal large" id="step2" data-reveal data-reset-on-close="false">
        <div class="tw-aspect-16:9 tw-w-full tw-relative">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/774474985?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="reveal large" id="step3" data-reveal data-reset-on-close="false">
        <div class="tw-aspect-16:9 tw-w-full tw-relative">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/774475015?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
@endsection


