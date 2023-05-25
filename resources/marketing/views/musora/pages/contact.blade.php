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

@section('layout-body')
    <section class="py-16 md:py-20 text-white text-center relative bg-[#030814]">
        <div class="container mx-auto relative z-0 max-w-xl md:max-w-none px-4 md:px-0">
            <h2><strong>Advice and answers from the Drumeo team</strong></h2>
            <p class="my-4">Find an answer on your own or get in touch with your dedicated Musora Mentor.</p>
            <div>
                <input class="rounded-full py-3 pl-4 text-black md:max-w-lg w-full mr-2 md:mr-0 mb-2 md:mb-0" placeholder="Search the knowledgebase" /> <br class="md:hidden"><span class="rounded-full border-2 border-white uppercase font-bebas py-3 px-10 text-xl tracking-wide w-full md:w-auto inline-block">Search</span>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-12 bg-[#F2F3F5]">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-center mb-6"><strong>Frequently asked questions</strong></h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-comments text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Instructor Support</p>
                    <p class="text-sm">How can I get personalized feedback from my instructor?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-sharp fa-regular fa-download text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Downloading Lessons</p>
                    <p class="text-sm">Can I download lessons and replay them later without using data?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-file-music text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Downloading Sheet Music</p>
                    <p class="text-sm">How do I download or print sheet music and chord charts?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-sharp fa-regular fa-truck-fast text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Shipment Tracking</p>
                    <p class="text-sm">I ordered a product from you, how can I track my shipment?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-file-invoice-dollar text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Billing Information</p>
                    <p class="text-sm">Where can I find my billing history and invoices?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-sharp fa-regular fa-circle-pause text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Pause Subscription</p>
                    <p class="text-sm">I need a short break, can I pause my account?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-light fa-circle-xmark text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Cancel Subscription</p>
                    <p class="text-sm">How can I make sure my subscription doesn't renew?</p>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-5 py-6 sm:py-10">
                    <i class="fa-regular fa-circle-dollar text-4xl md:text-5xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Request a Refund</p>
                    <p class="text-sm">I purchased less than 90 days ago and I would like a refund.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="pt-20 pb-10">
        <div class="container mx-auto text-center px-4 lg:px-8">
            <h2 class="font-bold text-xl md:text-3xl">Reach out directly</h2>
            <p class="mt-5 text-sm md:text-base text-[#a1afc9] max-w-3xl mx-auto">
                Get in touch with your dedicated Musora Mentor, [dynamic]!
            </p>
        </div>
    </div>

    <section>
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

    <section class="bg-[#F6F8FC] py-10 md:py-12">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-center mb-10"><strong>Have a more urgent request? Give us a shout.</strong></h2>
            <div class="md:grid md:grid-cols-3 md:gap-6 max-w-sm mx-auto md:max-w-none">
                <div class="md:border md:border-[#AAACAA] md:rounded-xl flex items-center md:justify-center py-4 md:py-6 px-2">
                    <i class="fa-regular fa-phone-volume text-3xl mr-6"></i>
                    <div class="text-sm">
                        <strong class="font-bold">Toll Free:</strong> <br class="hidden md:inline">
                        1-800-439-8921
                    </div>
                </div>
                <div class="md:border md:border-[#AAACAA] md:rounded-xl flex items-center md:justify-center py-4 md:py-6 px-2">
                    <i class="fa-regular fa-globe text-3xl mr-6"></i>
                    <div class="text-sm">
                        <strong class="font-bold">Direct/International:</strong> <br class="hidden md:inline">
                        1-604-855-7605
                    </div>
                </div>
                <div class="md:border md:border-[#AAACAA] md:rounded-xl flex items-center md:justify-center py-4 md:py-6 px-2">
                    <i class="fa-regular fa-clock text-3xl mr-6"></i>
                    <div class="text-sm">
                        <strong class="font-bold">Office Hours:</strong> <br class="hidden md:inline">
                        Monday - Friday<br>
                        8AM - 4PM Pacific Time
                    </div>
                </div>
            </div>
        </div>
    </section>


{{--    @include('musora._partials._lets-chat', [--}}
{{--        'onContact' => true--}}
{{--    ])--}}
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/manifest.js') }}"></script>
    <script src="{{ mix('platform/js/vendor.js') }}"></script>
    <script src="{{ mix('platform/js/app.js') }}"></script>
@endsection
