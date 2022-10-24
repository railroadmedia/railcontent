@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Contact Us | Drumeo</title>
    <meta name="description" content="You can contact Drumeo Support by phone at 604-855-7605 or use the contact form on this page. We’re always here to help.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="You can contact Drumeo Support by phone at 604-855-7605 or use the contact form on this page. We’re always here to help.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('drumeo._partials._fonts')

    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/tailwindcss/tailwind.css') }}" />

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>

    <!-- Styles -->
    <style>
        /* Resets */
        * { box-sizing: border-box; }
        body { margin: 0; }
        p, h2 { margin: 0; }

        .thank-you-box{width:100%;max-width:960px;border-radius:5px;height:auto;max-height:0;visibility:hidden;opacity:0;transition:all .4s ease-in;display:block;margin:0 auto;background:#FFF;text-align:center;overflow:hidden;color:#000}.thank-you-box.active{max-height:1000px;visibility:visible;opacity:1;padding:15px}@media (min-width: 40em){.thank-you-box.active{padding:20px}}@media (min-width: 64em){.thank-you-box.active{padding:30px}}.thank-you-box p{font:400 15px/1.4em "Open Sans",sans-serif;margin:0 auto}@media (min-width: 40em){.thank-you-box p{font-size:19px}}@media (min-width: 64em){.thank-you-box p{font-size:23px}}.thank-you-box p em{line-height:1.4em;max-width:550px;display:inline-block;font-size:12px}@media (min-width: 40em){.thank-you-box p em{font-size:14px}}.thank-you-box h2{font:700 30px/1em "Roboto Condensed",sans-serif;margin:15px auto;text-transform:uppercase;color:#0b76db}@media (min-width: 40em){.thank-you-box h2{font-size:37px;margin:20px auto}}@media (min-width: 64em){.thank-you-box h2{font-size:44px}}.thank-you-box .social-media a{background:#000;color:#fff;border-radius:50%;display:inline-block;text-align:center;margin:20px 3px 0;width:50px;height:50px;line-height:50px;font-size:26px}@media (min-width: 64em){.thank-you-box .social-media a{width:70px;height:70px;line-height:70px;font-size:35px;margin:25px 10px 0}}
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "edgeVersion" => true
    ])

    <!-- Header -->
    <header class="tw-py-10 md:tw-py-16 tw-bg-black tw-bg-center tw-bg-cover" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/sales/sub-options-bg.jpg);">
        <div class="container mx-auto">
            <h1 class="tw-mx-auto tw-text-center tw-text-white tw-text-2xl md:tw-text-4xl tw-font-bold">
                <i class="fas fa-phone fa-flip-horizontal tw-text-drumeo tw-text-3xl tw-mr-1"></i>
                Contact Us
            </h1>
        </div>
    </header>

    <main class="tw-flex tw-flex-col tw-max-w-3xl tw-mx-auto tw-px-4">

        <!-- Intro -->
        <section>
            <div class="tw-my-8 tw-text-center">
                <h2 class="tw-font-bold tw-text-3xl tw-mb-6">We'd love to hear from you!</h2>
                <p class="tw-mb-6 tw-text-base">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!</p>
                <p class="tw-text-base">You may find your response in our <a href="https://help.drumeo.com/" class="tw-font-bold tw-no-underline tw-text-drumeo" title="go to help center">Help Center here</a>, but if not, fill out the quick form below.</p>
            </div>
        </section>

        <!-- Form -->
        <section id="app">
            <contact-email-form
                brand="drumeo"
                captchakey="6LcBSxYUAAAAANEVgiFM3kmHOjzbcrkspWBtQd9n "
                email-subject="Support Request From Drumeo.com"
                email-type="support-contact"
                email-endpoint="/laravel/public/mailora/public/send"
                email-logo="https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo.png"
                input-label="Report your issue here.."
                recipient="support@drumeo.com"
                success-message="Your email has been sent!"
            />
        </section>

        <!-- Contact -->
        <section class="tw-flex tw-flex-col tw-text-center tw-my-8">
            <h2 class="tw-font-bold tw-text-3xl">Old fashioned phone calls work too!</h2>
            <div class="tw-flex tw-my-8 tw-flex-col tw-items-center sm:tw-flex-row">
                <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3 tw-border-solid tw-border-0 tw-border-b-2 sm:tw-border-b-0 sm:tw-border-r-2 tw-border-gray-300">
                    <h4 class="tw-font-bold tw-mb-1">Toll-Free</h4>
                    <a href="tel:+18004398921" class=" tw-text-drumeo sm:mb-2 tw-no-underline tw-text-base">1-800-439-8921</a>
                </div>
                <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3 tw-border-solid tw-border-0 tw-border-b-2 sm:tw-border-b-0 sm:tw-border-r-2 tw-border-gray-300">
                    <h4 class="tw-font-bold tw-mb-1">Direct/International</h4>
                    <a href="tel:+16048557605" class=" tw-text-drumeo sm:mb-2 tw-no-underline tw-text-base">1-604-855-7605</a>
                </div>
                <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3">
                    <h4 class="tw-font-bold tw-mb-1">Office Hours</h4>
                    <p class="tw-text-drumeo tw-text-base"> Monday-Friday</p>
                    <p class="tw-text-drumeo sm:mb-2 tw-text-base">8 AM - 4 PM Pacific Time</p>
                </div>
            </div>
        </section>

        <!-- Join -->
        <section class="tw-flex tw-flex-col tw-text-center tw-mb-12">
            <h2 class="tw-font-bold tw-text-3xl tw-mb-3 md:tw-mb-6">Want to join the team?</h2>
            <p class="tw-text-base">For current available positions at our company, please visit <a href="https://musora.com/jobs" title="go to help center" class="tw-font-bold tw-no-underline tw-text-drumeo">Musora.com/Jobs</a>.</p>
        </section>

    </main>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>
@stop
