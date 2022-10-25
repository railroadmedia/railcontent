@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>{{ 'todo' }} gifted you 30 days of free drum lessons! | Drumeo</title>
    <meta property="og:title" content="Drumeo | The Ultimate Online Drum Lesson Experience">

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee. ">
    <meta property="og:description" content="Reach your drumming goals with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/fb-share-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css" />
    <link href="/marketing/css/drumeo/tailwind-helpers.css" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        h1 strong,
        label strong {
            font-weight:900
        }

        h1, h5, li, p {
            font-weight:400;
            line-height:1em;
            font-family:"Open Sans", sans-serif;
            margin:0 auto
        }

        h1 {
            line-height:1.2em;
            font-size:24px
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

        h5, li {
            font-size:15px
        }

        @media (min-width:768px) {
            h5, li {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5, li {
                font-size:20px
            }
        }

        p, label {
            line-height:1.6em;
            font-size:15px
        }

        @media (min-width:1024px) {
            p, label {
                font-size:16px
            }
        }
        input[type=email], input[type=tel], input[type=password], input[type=text], input[type=url] {
            height: 50px;
            border-radius: 25px;
            background: #fff;
            color: #000;
            box-shadow: none;
            border: 1px solid #d1d1d1;
            outline: none;
            width: 100%;
            font: 400 16px/1.5em Open Sans, sans-serif;
            padding-left: 25px;
            padding-right: 25px;
        }

        .social-bubble::after {
            display:block;
            font:300 12px/1em "Open Sans";
            margin:25px auto 0;
        }

        .social-bubble.facebook::after {
            content:'Facebook';
        }

        .social-bubble.twitter::after {
            content:'Twitter';
        }

        .social-bubble.email::after {
            content:'Email';
        }

        .social-bubble.copy::after {
            content:'Copy Link';
        }

    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="text-center text-white py-6 md:py-10 lg:pt-12 lg:pb-16" style="background:linear-gradient(to bottom, #010e2c, #000c17);">
        <div class="container mx-auto max-w-6xl">
            <h1 class="leading-tight lg:mb-14"><strong>{{ 'todo' }} gifted you 30 days<br class="hidden md:inline"> of free drum lessons!</strong></h1>
            <div class="flex flex-wrap lg:flex-nowrap items-center px-4">
                <div class="flex-shrink-0 w-full lg:w-auto my-5 md:my-6 lg:my-0">
                    <div class="relative">
                        <img class="inline-block w-full max-w-xs md:max-w-sm lg:max-w-xl" src="https://drumeo-assets.s3.amazonaws.com/redeem/referral/30-day-guest-pass.png">
                    </div>
                    <ul class="fa-ul text-left mb-0 mt-4 md:mt-6 lg:mt-14 ml-6 md:ml-7 lg:ml-8 w-auto inline-block">
                        <li class="mb-4 lg:mb-6 leading-tight"><i class="fas fa-li fa-check text-drumeo"></i> Organized step-by-step lessons for all skill levels.</li>
                        <li class="mb-4 lg:mb-6 leading-tight"><i class="fas fa-li fa-check text-drumeo"></i> Play your favorite songs with better practice tools.</li>
                        <li class="leading-tight"><i class="fas fa-li fa-check text-drumeo"></i> Get your questions answered by helpful drum teachers.</li>
                    </ul>
                </div>

                <div class="lg:pl-10 max-w-md lg:max-w-none mx-auto">
                    <form id="commentform" name="drumeo" method="post" action="{{ URL::route('access-codes.form-claim') }}">
                        <input type="hidden" name="redirect" value="/members">

                        <label class="inline-block w-full text-left" for="name"><strong>Your name</strong> <em class="opacity-70 text-xs md:float-right">Used to say hello!</em></label>
                        <input class="inline-block w-full mt-1 mb-4 default-form-field" type="text" id="name" name="name" placeholder="Your name..." value="{{ Input::old('name') }}">

                        <label class="inline-block w-full text-left" for="email"><strong>Email address</strong> <em class="opacity-70 text-xs md:float-right">Used for member communication.</em></label>
                        <input class="inline-block w-full mt-1 mb-4 default-form-field" type="email" id="email" name="email" placeholder="Email address..." value="{{ Input::old('email') }}">

                        <label class="inline-block w-full text-left" for="phone"><strong>Phone number</strong> <em class="opacity-70 text-xs md:float-right">Used to validate you’re a human.</em></label>
                        <input class="inline-block w-full mt-1 mb-4 default-form-field" type="tel" id="phone" name="phone" placeholder="Phone number..." pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="{{ Input::old('phone') }}">

                        <label class="inline-block w-full text-left" for="password"><strong>Password</strong> <em class="opacity-70 text-xs md:float-right">Used to access your lessons.</em></label>
                        <input class="inline-block w-full mt-1 mb-4 default-form-field" type="password" id="password" name="password" placeholder="Password..." value="">

                        <label class="inline-block w-full text-left" for="password_confirmation"><strong>Password confirm</strong> <em class="opacity-70 text-xs md:float-right">No typos.</em></label>
                        <input class="inline-block w-full mt-1 mb-4 default-form-field" type="password" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm..." value="">

                        <input name="button" type="submit" id="button" class="bg-drumeo leading-none text-base font-bold border-0 rounded-full select-none cursor-pointer text-center py-4 px-16 uppercase font-roboto" value="Redeem Guest Pass"/>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{--members area version--}}
    <section class="text-center text-white py-6 md:py-10 lg:pt-12 lg:pb-16" style="background:linear-gradient(to bottom, #010e2c, #000c17);">
        <div class="container mx-auto max-w-6xl">
            <h1 class="leading-tight lg:mb-14"><strong>Share a free 30-day pass<br> with up to five friends.</strong></h1>
            <div class="flex flex-wrap lg:flex-nowrap items-center px-4">
                <div class="flex-shrink-0 w-full lg:w-auto my-5 md:my-6 lg:my-0">
                    <div class="relative">
                        <img class="inline-block w-full max-w-xs md:max-w-sm lg:max-w-xl" src="https://drumeo-assets.s3.amazonaws.com/redeem/referral/30-day-guest-pass.png">
                        <div class="absolute bottom-0 w-full p-4">
                            <p class="leading-none">PASSES REDEEMED</p>
                            <h1 class="leading-none"><strong>{{ 'todo' }}/5</strong></h1>
                        </div>
                    </div>
                </div>

                <div class="lg:pl-10 w-full max-w-md lg:max-w-none mx-auto">
                    <h5 class="leading-tight">Give a friend unlimited access <br>
                        to Drumeo, free for 30 days</h5>
                    <div class="my-7">
                        <p class="inline-block w-full mb-1"><strong>Share your link</strong></p>
                        <a class="social-bubble copy transition-opacity duration-300 py-4 w-16 h-16 text-3xl leading-none rounded-full inline-block text-center mx-1 md:mx-3 hover:opacity-70 cursor-pointer bg-gray-500" id="copyClipboard" data-clipboard-text="{{ 'https://www.drumeo.com/cf/todolink' }}"><i class="fas fa-link"></i></a>
                        <a class="social-bubble facebook transition-opacity duration-300 py-4 w-16 h-16 text-3xl leading-none rounded-full inline-block text-center mx-1 md:mx-3 hover:opacity-70" style="background-color:#3b5998;" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ 'https://www.drumeo.com/cf/todolink' }}"><i class="fab fa-facebook-f"></i></a>
                        <a class="social-bubble twitter transition-opacity duration-300 py-4 w-16 h-16 text-3xl leading-none rounded-full inline-block text-center mx-1 md:mx-3 hover:opacity-70" style="background-color:#1DA1F2;" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ 'https://www.drumeo.com/cf/todolink' }}"><i class="fab fa-twitter"></i></a>
                        <a class="social-bubble email transition-opacity duration-300 py-4 w-16 h-16 text-3xl leading-none rounded-full inline-block text-center mx-1 md:mx-3 hover:opacity-70 bg-yellow-500" target="_blank" rel="noopener" href="mailto:?&amp;subject=I'm gifting you 30 days of free drum lessons!&amp;body={{ 'https://www.drumeo.com/cf/todolink' }}"><i class="fas fa-envelope"></i></a>
                    </div>
                    <form id="commentform" name="drumeo" method="post" action="{{ URL::route('access-codes.form-claim') }}">
                        <label class="inline-block w-full text-left" for="email"><strong>Invite via email</strong></label>
                        <div class="flex flex-wrap lg:flex-nowrap items-center justify-center mt-1">
                            <input class="inline-block w-full mb-4 lg:mb-0 lg:mr-4 default-form-field lg:flex-grow" type="email" id="email" name="email" placeholder="Email address..." value="{{ Input::old('email') }}">
                            <input name="button" type="submit" id="button" class="bg-drumeo leading-none text-base font-bold border-0 rounded-full select-none cursor-pointer text-center py-4 px-6 uppercase font-roboto" value="Send Guest Pass"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section  class="text-center text-white py-5 md:py-8" style="background-color:#081f35;">
        <div class="container mx-auto max-w-6xl">
            <h5 class="leading-normal opacity-70">Guest passes are for new subscribers only and cannot be<br class="hidden lg:inline"> redeemed for renewals, extensions, or gift subscriptions.</h5>
        </div>
    </section>


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script>
        $(document).ready(function () {
            var clipboard = new ClipboardJS('#copyClipboard');

            clipboard.on('success', function(e) {
                document.getElementById('copyClipboard').className += ' bg-green-500';
            });
        });
    </script>
    {{--<script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>--}}
@stop
