@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Support | Pianote</title>
    <meta name="description" content="You can contact Pianote Support by phone at 604-855-7605 or use the links on this page. We’re always here to help.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="You can contact Pianote Support by phone at 604-855-7605 or use the links on this page. We’re always here to help.">
    <meta property="og:url" content="https://www.pianote.com/contact/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" />
    <link href="/assets/marketing/nav-footer.css" rel="stylesheet">

    <!-- Tailwind -->
    <link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}">

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>

    <!-- Styles -->
    <style>
        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.nav', [
        "joinVersion" => true
    ])

    <!-- Header -->
    <header class="tw-py-10 md:tw-py-16 tw-bg-black tw-bg-center tw-bg-cover" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg);">
        <div class="container mx-auto">
            <h2 class="tw-mx-auto tw-text-center tw-text-white {{--tw-text-2xl md:tw-text-4xl--}} tw-font-bold">
                <i class="fas fa-phone fa-flip-horizontal tw-text-pianote tw-text-3xl tw-mr-1"></i>
                Contact Us
            </h2>
        </div>
    </header>

    <main class="tw-flex tw-flex-col tw-max-w-3xl tw-mx-auto tw-px-4">

        <!-- Intro -->
        <section>
            <div class="tw-my-8 tw-text-center">
                <h3 class="tw-font-bold {{--tw-text-3xl--}} tw-mb-6">We'd love to hear from you!</h3>
                <p class="tw-mb-6 {{--tw-text-base--}}">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!</p>
                <p class="{{--tw-text-base--}}">You may find your response in our <a href="https://help.pianote.com/" class="tw-font-bold tw-no-underline tw-text-pianote" title="go to help center">Help Center here</a>, but if not, fill out the quick form below.</p>
            </div>
        </section>

        <!-- Form -->
        <section id="app">
            <contact-email-form
                    brand="pianote"
                    captchakey="6LcSMHgdAAAAAOFqEZob05w0ZZAInbnfqMdMnhNB"
                    email-subject="Support Request From Pianote.com"
                    email-type="support-contact"
                    email-endpoint="/mailora/public/send"
                    email-logo="https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo.png"
                    input-label="Report your issue here.."
                    recipient="{{ config('mail-recipients.members-area-support') ?? 'support@pianote.com' }}"
                    success-message="Your email has been sent!"
            />
        </section>

        <!-- Contact -->
        <section class="tw-flex tw-flex-col tw-text-center tw-my-8">
            <h3 class="tw-font-bold {{--tw-text-3xl--}}">Old fashioned phone calls work too!</h3>
            <div class="tw-flex tw-my-8 tw-flex-col tw-items-center sm:tw-flex-row">
                <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3 tw-border-solid tw-border-0 tw-border-b-2 sm:tw-border-b-0 sm:tw-border-r-2 tw-border-gray-300">
                    <p class="tw-font-bold tw-mb-1">Toll-Free</p>
                    <a href="tel:+18004398921" class=" tw-text-pianote sm:mb-2 tw-no-underline {{--tw-text-base--}}">1-800-439-8921</a>
                </div>
                <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3 tw-border-solid tw-border-0 tw-border-b-2 sm:tw-border-b-0 sm:tw-border-r-2 tw-border-gray-300">
                    <p class="tw-font-bold tw-mb-1">Direct/International</p>
                    <a href="tel:+16048557605" class=" tw-text-pianote sm:mb-2 tw-no-underline {{--tw-text-base--}}">1-604-855-7605</a>
                </div>
                <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3">
                    <p class="tw-font-bold tw-mb-1">Office Hours</p>
                    <p class="tw-text-pianote tw-font-bold {{--tw-text-base--}}"> Monday-Friday</p>
                    <p class="tw-text-pianote tw-font-bold sm:mb-2 {{--tw-text-base--}}">8 AM - 4 PM Pacific Time</p>
                </div>
            </div>
        </section>

        <!-- Join -->
        <section class="tw-flex tw-flex-col tw-text-center tw-mb-12">
            <h3 class="tw-font-bold {{--tw-text-3xl--}} tw-mb-3 md:tw-mb-6">Want to join the team?</h2>
            <p class="{{--tw-text-base--}}">For current available positions at our company, please visit <a href="https://musora.com/jobs" title="go to help center" class="tw-font-bold tw-no-underline tw-text-pianote">Musora.com/Jobs</a>.</p>
        </section>

    </main>

    @include('pianote.sales.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script src="{{ mix('marketing/parcel/pianote/manifest.js') }}"></script>
    <script src="{{ mix('marketing/parcel/pianote/vendor.js') }}"></script>
    <script src="{{ mix('marketing/parcel/pianote/app.js') }}"></script>
@stop
