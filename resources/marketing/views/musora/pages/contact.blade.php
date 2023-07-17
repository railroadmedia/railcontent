@extends('musora._partials.layout')

@section('head-includes')
    {{-- Main --}}
    <title>Contact Us | Musora</title>
    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, Pianote, and Singeo. ">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        a {
            color:inherit!important;
        }
    </style>

    <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
    <script type="text/javascript">
        window.Beacon('init', '9f119028-29b4-4fcd-8b9d-03c86f3d2521')
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
@endsection

<!-- Main -->
@section('body-class', 'light')

@section('layout-body')
    <section class="py-16 md:py-20 text-white text-center relative bg-[#030814] px-4 md:px-0">
        <div class="container mx-auto relative z-0 max-w-xl md:max-w-none">
            <h3><strong>Advice and answers from the Musora team</strong></h3>
            <p class="my-4">Find an answer on your own or get in touch with your dedicated Musora Mentor.</p>
            <div>
                <form onsubmit="handleSearch(event)">
                    <input class="border-2 border-white rounded-full py-3 pl-4 text-black md:max-w-lg w-full mr-2 md:mr-0 mb-2 md:mb-0" placeholder="Search the knowledgebase" id="searchInput" />
                    <br class="md:hidden">
                    <button type="submit" class="rounded-full border-2 border-white uppercase font-bebas py-2.5 px-10 text-xl tracking-wide w-full md:w-auto inline-block">Search</button>
                </form>
            </div>
        </div>
    </section>
    <section class="py-14 md:py-20 bg-[#f6f8fc]">
        <div class="max-w-4xl mx-auto px-4">
            <h3 class="text-center mb-10"><strong>Frequently Asked Questions</strong></h3>
            <div class="grid grid-cols-2 md:grid-cols-3
{{--            lg:grid-cols-4 --}}
            gap-3 sm:gap-4">
                <div  class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9 relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fal fa-toggle-on text-3xl md:text-4xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Membership options</p>
                    <p class="text-sm">What different types of memberships are available? </p>
                    <a href="#" data-beacon-article-sidebar="64272ebf8fe95055b525a84d" class="absolute inset-0" aria-label="Membership options"></a>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9 relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fal fa-book-open text-3xl md:text-4xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Lesson curriculum</p>
                    <p class="text-sm">Do you have a specific lesson curriculum?</p>
                    <a href="#" data-beacon-article-sidebar="637fe0fc6eb6095a0543930a" class="absolute inset-0" aria-label="Lesson curriculum"></a>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9 relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fal fa-truck-fast text-3xl md:text-4xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Shipment tracking</p>
                    <p class="text-sm">I ordered a product from you, how can I track my shipment?</p>
                    <a href="#" data-beacon-article-sidebar="634b2901927a2c1634dfac43" class="absolute inset-0" aria-label="Shipment tracking"></a>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9 relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fal fa-tag text-3xl md:text-4xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Free and paid</p>
                    <p class="text-sm">What’s the difference between free and paid content?</p>
                    <a href="#" data-beacon-article-sidebar="6467ad5b67acd170a44c2eb8" class="absolute inset-0" aria-label="Free and paid"></a>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9 relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fal fa-badge-check text-3xl md:text-4xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">90-day guarantee</p>
                    <p class="text-sm">What are the terms for your refund guarantee? </p>
                    <a href="#" data-beacon-article-sidebar="6467b2256413a34741154344" class="absolute inset-0" aria-label="90-day guarantee"></a>
                </div>
                <div class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9 relative" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">
                    <i class="fal fa-hand-holding-dollar text-3xl md:text-4xl mb-3"></i>
                    <p class="font-bold mb-1 text-sm">Customs fees</p>
                    <p class="text-sm">Does Musora cover customs fees?</p>
                    <a href="#" data-beacon-article-sidebar="6467b51367acd170a44c2ef9" class="absolute inset-0" aria-label="Customs fees"></a>
                </div>
{{--                <a href="" class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">--}}
{{--                    <i class="fal fa-trophy text-3xl md:text-4xl mb-3"></i>--}}
{{--                    <p class="font-bold mb-1 text-sm"> Learning outcomes</p>--}}
{{--                    <p class="text-sm"></p>--}}
{{--                </a>--}}
{{--                <a href="" class="bg-[#030814] text-white text-center rounded-xl px-3 py-6 sm:py-9" style="box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.25);">--}}
{{--                    <i class="fal fa-desktop text-3xl md:text-4xl mb-3"></i>--}}
{{--                    <p class="font-bold mb-1 text-sm">Online or in-person lessons?</p>--}}
{{--                    <p class="text-sm"></p>--}}
{{--                </a>--}}
            </div>
        </div>
    </section>

    <section class="py-14 md:py-20 px-4 lg:px-8" id="contactPageApp">
        <div class="container max-w-3xl mx-auto text-center">
            <h3><strong>Reach Out Directly</strong></h3>
            <p class="mt-4 mb-5 text-sm md:text-base max-w-3xl mx-auto">
                Get in touch with your dedicated Musora Mentor!
            </p>
            <div class="text-left">
                <contact-email-form-marketing
                    brand="drumeo"
                    captchakey="6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx"
                    email-subject="Support Request From Musora"
                    email-type="support-contact"
                    email-endpoint="{{url()->route('mailora.public.send') }}"
                    email-logo="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/logo.png"
                    input-label="Report your issue here.."
                    recipient="support@musora.com"
                    success-message="Your email has been sent!"
                />
            </div>
        </div>
    </section>

    <section class="bg-[#F6F8FC] py-12 md:py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-center mb-7"><strong>Have A More Urgent Request? Give Us A Shout.</strong></h3>
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
    <script>
        function handleSearch(e) {
            e.preventDefault();
            const keyword = document.getElementById('searchInput').value;
            if(keyword){
                window.location = `https://help.musora.com/search?query=${keyword}`;
            }
        }
    </script>
    <script src="{{ mix('platform/js/manifest.js') }}"></script>
    <script src="{{ mix('platform/js/vendor.js') }}"></script>
    <script src="{{ mix('platform/js/app.js') }}"></script>
    <script>

    </script>
@endsection
