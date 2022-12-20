@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Support | Pianote</title>
    <meta name="description" content="You can contact Pianote Support by phone at 604-855-7605 or use the links on this page. We’re always here to help.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="You can contact Pianote Support by phone at 604-855-7605 or use the links on this page. We’re always here to help.">
    <meta property="og:url" content="https://www.pianote.com/contact/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" />
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">


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
    @include('pianote._partials._nav', [
        "joinVersion" => true
    ])

    <!-- Header -->
    <header class="py-10 md:py-16 bg-black bg-center bg-cover" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg);">
        <div class="container mx-auto">
            <h2 class="mx-auto text-center text-white {{--text-2xl md:text-4xl--}} font-bold">
                <i class="fas fa-phone fa-flip-horizontal text-pianote text-3xl mr-1"></i>
                Contact Us
            </h2>
        </div>
    </header>

    <main class="flex flex-col max-w-3xl mx-auto px-4">

        <!-- Intro -->
        <section>
            <div class="my-8 text-center">
                <h3 class="font-bold {{--text-3xl--}} mb-6">We'd love to hear from you!</h3>
                <p class="mb-6 {{--text-base--}}">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!</p>
                <p class="{{--text-base--}}">You may find your response in our <a href="https://help.pianote.com/" class="font-bold no-underline text-pianote" title="go to help center">Help Center here</a>, but if not, fill out the quick form below.</p>
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
        <section class="flex flex-col text-center my-8">
            <h3 class="font-bold {{--text-3xl--}}">Old fashioned phone calls work too!</h3>
            <div class="flex my-8 flex-col items-center sm:flex-row">
                <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3 border-solid border-0 border-b-2 sm:border-b-0 sm:border-r-2 border-gray-300">
                    <p class="font-bold mb-1">Toll-Free</p>
                    <a href="tel:+18004398921" class=" text-pianote sm:mb-2 no-underline {{--text-base--}}">1-800-439-8921</a>
                </div>
                <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3 border-solid border-0 border-b-2 sm:border-b-0 sm:border-r-2 border-gray-300">
                    <p class="font-bold mb-1">Direct/International</p>
                    <a href="tel:+16048557605" class=" text-pianote sm:mb-2 no-underline {{--text-base--}}">1-604-855-7605</a>
                </div>
                <div class="flex flex-col w-10/12 sm:w-1/3 font-bold justify-center p-3">
                    <p class="font-bold mb-1">Office Hours</p>
                    <p class="text-pianote font-bold {{--text-base--}}"> Monday-Friday</p>
                    <p class="text-pianote font-bold sm:mb-2 {{--text-base--}}">8 AM - 4 PM Pacific Time</p>
                </div>
            </div>
        </section>

        <!-- Join -->
        <section class="flex flex-col text-center mb-12">
            <h3 class="font-bold {{--text-3xl--}} mb-3 md:mb-6">Want to join the team?</h2>
            <p class="{{--text-base--}}">For current available positions at our company, please visit <a href="https://musora.com/jobs" title="go to help center" class="font-bold no-underline text-pianote">Musora.com/Jobs</a>.</p>
        </section>

    </main>

    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/nav-footer.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/app.js') }}"></script>
@stop
