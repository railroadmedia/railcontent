@extends('musora._partials.layout')

@section('head-includes')
    {{-- Main --}}
    <title>Contact Us | Musora</title>
    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2021/share-image.jpg">
    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        a {
            color:inherit!important;
        }
    </style>
@endsection

<!-- Main -->
@section('body-class', 'dark')

@section('layout-body')
    <section class="py-16 md:py-20 text-white text-center relative bg-[#030814]">
        <div class="container mx-auto relative z-0">
            <h2><strong>Advice and answers from the Drumeo team</strong></h2>
            <p class="my-4">Find an answer on your own or get in touch with your dedicated Musora Mentor.</p>
            <div>
                <input class="rounded-full py-3 pl-4 text-black max-w-lg w-full mr-2" placeholder="Search the knowledgebase" /> <span class="rounded-full border border-white uppercase font-bebas py-3 px-8 text-xl tracking-wide">Search</span>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-12 bg-[#F2F3F5]">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-center mb-6"><strong>Frequently asked questions</strong></h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-comments text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Instructor Support</p>
                    <p class="text-sm">How can I get personalized feedback from my instructor?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-sharp fa-regular fa-download text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Downloading Lessons</p>
                    <p class="text-sm">Can I download lessons and replay them later without using data?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-file-music text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Downloading Sheet Music</p>
                    <p class="text-sm">How do I download or print sheet music and chord charts?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-sharp fa-regular fa-truck-fast text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Shipment Tracking</p>
                    <p class="text-sm">I ordered a product from you, how can I track my shipment?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-file-invoice-dollar text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Billing Information</p>
                    <p class="text-sm">Where can I find my billing history and invoices?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-sharp fa-regular fa-circle-pause text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Pause Subscription</p>
                    <p class="text-sm">I need a short break, can I pause my account?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-light fa-circle-xmark text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Cancel Subscription</p>
                    <p class="text-sm">How can I make sure my subscription doesn't renew?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-circle-dollar text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Request a Refund</p>
                    <p class="text-sm">I purchased less than 90 days ago and I would like a refund.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="pt-20 pb-10 text-white bg-musora-black">
        <div class="container mx-auto text-center px-4 lg:px-8">
            <h2 class="font-bold text-xl md:text-3xl">Reach out directly</h2>
            <p class="mt-5 text-sm md:text-base text-[#a1afc9] max-w-3xl mx-auto">
                Get in touch with your dedicated Musora Mentor, [dynamic]!
            </p>
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
                email-logo="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://d3fzm1tzeyr5n3.cloudfront.net/musora/logo.png"
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
