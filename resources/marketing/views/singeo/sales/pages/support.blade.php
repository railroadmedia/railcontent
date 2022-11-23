@extends('singeo._partials.layout')

@section('head-includes')
    @parent

    <title>Contact Us | Singeo</title>
    <meta name="description" content="You can contact Singeo Support by phone at 604-855-7605 or use the links on this page. We’re always here to help.">

    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="You can contact Singeo Support by phone at 604-855-7605 or use the links on this page. We’re always here to help.">
    <meta property="og:url" content="https://www.singeo.com/contact/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.4/tailwind.min.css" />
    <link href="/assets/css/tailwind-helpers.css" rel="stylesheet">
    <link href="/assets/marketing/nav-footer.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/marketing/nav-footer.css">

    <!-- Tailwind -->
    <link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}">

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

@section('layout-body')
    @include("singeo.sales.partials._nav", [
        "joinVersion" => true,
    ])

    <!-- Header -->
    <header class="py-10 md:py-16 bg-black bg-center bg-cover" style="background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/background-order.jpg);">
        <div class="container mx-auto">
            <h1 class="mx-auto text-center text-white text-2xl md:text-4xl font-bold">
                <i class="fas fa-phone fa-flip-horizontal text-singeo text-3xl mr-1"></i>
                Contact Us
            </h1>
        </div>
    </header>

    <main class="flex flex-col max-w-3xl mx-auto px-4">

        <!-- Intro -->
        <section>
            <div class="my-8 text-center">
                <h2 class="font-bold text-3xl mb-6">We'd love to hear from you!</h2>
                <p class="mb-6 text-base">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!</p>
                <p class="text-base">You may find your response in our <a href="https://help.singeo.com/" class="font-bold no-underline text-singeo" title="go to help center">Help Center here</a>, but if not, fill out the quick form below.</p>
            </div>
        </section>

        <!-- Form -->
        <section id="app">
            <contact-email-form
                brand="singeo"
                captchakey="6LcSMHgdAAAAAOFqEZob05w0ZZAInbnfqMdMnhNB"
                email-subject="Support Request From Singeo.com"
                email-type="support-contact"
                email-endpoint="/mailora/public/send"
                email-logo="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                input-label="Report your issue here.."
                recipient="support@singeo.com"
                success-message="Your email has been sent!"
            />
        </section>

        <!-- Contact -->
        <section class="flex flex-col text-center my-8">
            <h2 class="font-bold text-3xl">Old fashioned phone calls work too!</h2>
            <div class="flex my-8 flex-col items-center sm:flex-row">
                <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3 border-solid border-0 border-b-2 sm:border-b-0 sm:border-r-2 border-gray-300">
                    <h4 class="font-bold mb-1">Toll-Free</h4>
                    <a href="tel:+18004398921" class=" text-singeo sm:mb-2 no-underline text-base">1-800-439-8921</a>
                </div>
                <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3 border-solid border-0 border-b-2 sm:border-b-0 sm:border-r-2 border-gray-300">
                    <h4 class="font-bold mb-1">Direct/International</h4>
                    <a href="tel:+16048557605" class=" text-singeo sm:mb-2 no-underline text-base">1-604-855-7605</a>
                </div>
                <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3">
                    <h4 class="font-bold mb-1">Office Hours</h4>
                    <p class="text-singeo text-base"> Monday-Friday</p>
                    <p class="text-singeo sm:mb-2 text-base">8 AM - 4 PM Pacific Time</p>
                </div>
            </div>
        </section>

        <!-- Join -->
        <section class="flex flex-col text-center mb-12">
            <h2 class="font-bold text-3xl mb-3 md:mb-6">Want to join the team?</h2>
            <p class="text-base">For current available positions at our company, please visit <a href="https://musora.com/careers" title="go to help center" class="font-bold no-underline text-singeo">Musora.com/Careers</a>.</p>
        </section>

    </main>

    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script src="{{ mix('marketings/js/manifest.js') }}"></script>
    <script src="{{ mix('marketings/js/vendor.js') }}"></script>
    <script src="{{ mix('marketing/js/app.js') }}"></script>
@stop
