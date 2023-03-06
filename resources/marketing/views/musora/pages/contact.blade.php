@extends('musora._partials.layout')

@section('head-includes')
    {{-- Main --}}
    <title>Contact Us | Musora</title>
    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://musora-center.s3.amazonaws.com/homepage/2021/share-image.jpg">
    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@endsection

<!-- Main -->
@section('body-class', 'dark')

@section('layout-body')
    <section class="py-24 md:py-40 text-white text-center relative">
        <img
            src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://musora-center.s3.amazonaws.com/homepage/2021/header-about.jpg"
            class="absolute object-cover w-full h-full top-0 left-0 z-[-2] transition-opacity opacity-0"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            alt="header bg"
        />
        <div class="container mx-auto relative z-0">
            <h1><strong>Contact Us</strong></h1>
        </div>
    </section>

    <div class="pt-20 pb-10 text-white bg-musora-black">
        <div class="container mx-auto text-center px-4 lg:px-8">
            <h2 class="font-bold text-xl md:text-3xl">We'd love to hear from you!</h2>
            <p class="mt-5 text-sm md:text-base text-[#a1afc9] max-w-3xl mx-auto">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!
                <br><br>
                You may find your response in our <a href="https://help.drumeo.com/" class="tw-font-bold tw-no-underline tw-text-drumeo" title="go to help center"><u>Help Center here</u></a>, but if not, fill out the below.</p>
        </div>
    </div>

    <section class="bg-musora-black">
        <div class="max-w-3xl mx-auto px-4 lg:px-8" id="contactPageApp">
            <contact-email-form-marketing
                brand="drumeo"
                captchakey="6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx"
                email-subject="Support Request From Musora"
                email-type="support-contact"
                email-endpoint="{{url()->route('mailora.public.send') }}"
                email-logo="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://musora-web-platform.s3.amazonaws.com/musora/logo.png"
                input-label="Report your issue here.."
                recipient="support@musora.com"
                success-message="Your email has been sent!"
            />
        </div>
    </section>

    <div class="pt-16 text-white bg-musora-black">
        <div class="container mx-auto text-center max-w-3xl">
            <div class="flex flex-wrap items-center">
                <h2 class="font-bold text-xl md:text-3xl w-full">Old fashioned phone calls work too!</h2>
                <div class="md:w-1/3 w-full px-3 md:px-4 py-5">
                    <p class="mx-auto text-sm md:text-base"><strong>Toll-Free</strong><br> <a href="tel:+18004398921">1-800-439-8921</a></p>
                </div>
                <div class="md:w-1/3 w-full px-3 md:px-4 py-5 border-r border-l">
                    <p class="mx-auto text-sm md:text-base"><strong>Direct/International</strong><br> <a href="tel:+16048557605">1-604-855-7605</a></p>
                </div>
                <div class="md:w-1/3 w-full px-3 md:px-4 py-5">
                    <p class="mx-auto text-sm md:text-base"><strong>Office Hours</strong><br> <a target="_blank" href="https://www.google.com/search?q=time+in+pacific+time">Monday - Friday<br> 8 AM - 4 PM Pacific Time</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 text-white bg-musora-black">
        <div class="container mx-auto text-center">
            <h2 class="font-bold text-xl md:text-3xl">Want to join the team?</h2>
            <p class="mt-5 text-sm md:text-base text-[#a1afc9]">For current available positions at our company, please visit <a href="/careers"><u>Musora.com/Careers</u></a>.</p>
        </div>
    </div>

    @include('musora._partials._lets-chat', [
        'onContact' => true
    ])
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/manifest.js') }}"></script>
    <script src="{{ mix('platform/js/vendor.js') }}"></script>
    <script src="{{ mix('platform/js/app.js') }}"></script>
@endsection
