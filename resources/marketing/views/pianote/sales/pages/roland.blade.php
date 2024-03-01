@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    'hideHeader' => true,
])

@section('global-head')
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/roland">
    <style>
        form input, form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            form input, form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px!important;
            visibility:visible!important;
            opacity:1!important;
            padding:15px!important;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 20px!important;
            }
        }
    </style>
    @parent
@endsection
@section('promo-banner')
    <header class="text-center text-white" style="background-color:#0e1213;">
        <div class="container relative mx-auto px-2 md:px-0 pb-7 md:pb-12 lg:pb-16 pt-3 lg:pt-5 bg-cover bg-top" style="background-image:url(https://www.musora.com/musora-cdn/image/width=1920,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/roland/header.jpg);">
            <div class="z-10 relative">
                <h5 class="text-light-navy mb-1"><em>Learn piano for FREE with</em></h5>
                <img class="w-64 md:w-80 lg:w-96" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/roland/pianote-roland-logo-blue.png"><br>
                <i class="fas fa-play play-button autoplay-video memvideo mt-40 md:mt-48 lg:mt-60 mb-10 md:mb-7 lg:mb-20" x-on:click="rolandTrailer = true;"></i>
                <h2><strong>Learn to play your Roland piano <br class="hidden md:inline">
                        anytime with real teachers.</strong></h2>
                <h5 class="leading-tight text-light-navy my-4"><strong style="font-weight: 900;">Technology meets tradition:</strong> Online video lessons you can watch anytime,<br class="hidden sm:inline">
                    along with real teachers who’ll support you every step of the way.</h5>
                <a href="#customize-anchor" class="join anchor-slide memcta">Start Your Free Trial »</a>
            </div>
            <div class="absolute inset-0 z-0 hidden lg:block" style="background:linear-gradient(to right, #0e1213, transparent 15%, transparent 85%, #0e1213);"></div>
        </div>
    </header>
    <section class="big-promo-banner text-white text-center relative z-10 overflow-hidden px-5 md:px-8 py-6 mx:py-8 lg:py-10" style="background:linear-gradient(to bottom, #000318, #01082a);">
            <div class="container mx-auto relative">
                <h3 class="leading-tight"><strong>Take a bow. Because you just <br class="inline md:hidden">
                        did something amazing.</strong></h3>
                <div class="flex flex-wrap items-start justify-center mx-auto mt-1 md:mt-10 lg:mt-12" style="max-width:890px">
                    <div class="flex-image md:order-1 mx-auto my-4 md:my-0 w-full md:w-5/12 relative">
                        <i class="fas fa-play play-button smaller autoplay-video transform -translate-x-1/2 -translate-y-1/2 absolute top-1/2 left-1/2" x-on:click="rolandTrailer = true;"></i>
                        <img class="w-full max-w-xs md:max-w-none" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/roland/roland-lisa.png">
                    </div>
                    <div class="text-left w-full md:pr-6 lg:pr-10 md:w-7/12">
                        <p class="mx-auto max-w-xl leading-relaxed">
                            You bought a Roland piano.
                            <br><br>
                            A beautiful instrument that will help you fall deeper in love with the piano and music.
                            <br><br>
                            At Pianote, we’ve been using Roland pianos since we began back in 2016, and we’re so excited to help YOU learn with 3 months of lessons, completely free.
                            <br><br>
                            Click any of the buttons on this page to activate your free membership and create your profile.
                            <br><br>
                            And don’t worry…
                            <br><br>
                            You don’t need to enter any credit card information.
                            <br><br>
                            We’ll see you in your first lesson.
                        </p>
                    </div>
                </div>

            </div>
    </section>
@endsection

@section('final')
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative overflow-hidden" style="background:linear-gradient(to bottom, #000318, #01082a);">
        <div class="container mx-auto">
            <h3><em>Learn piano for FREE with</em></h3>
            <img class="w-full max-w-sm md:max-w-lg lg:max-w-xl mb-6 md:mb-10 mt-1 md:mt-2 px-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/roland/pianote-roland-logo.png"><br>

            <h4 class="leading-normal" style="margin:0 auto"><strong>Activate your 90 days of <br class="inline md:hidden">
                    FREE lessons with Pianote.<br>
                    Enter your email for your access <br class="inline md:hidden">
                    code to start your free lessons</strong></h4>
            <p class="mt-3 mb-5 md:mb-8 text-navy px-4 leading-normal">
                <em><strong>(No credit card required. No recurring billing. Just awesome piano lessons)</strong><br class="hidden md:inline">
                    Offer valid for new Pianote members only</em></p>
            <div class="max-w-2xl mx-auto px-4">
                <form id="ajaxForm" accept-charset="UTF-8" action="/claim-roland-90-day-access" class="ajax-form clearfix infusion-form facebook-track-lead w-full mx-auto" method="POST">
                    <input class="w-full mb-2 text-left rounded-full py-2 px-5 text-gray-400 text-base md:text-lg" name="email" type="email" placeholder="Email Address..." required/>
                    <button class="submit w-full transition-opacity duration-300 hover:opacity-90 uppercase cursor-pointer text-center text-white text-base md:text-lg font-bebas font-bold bg-pianote rounded-full" type="submit">
                        <span class="pre-add">Get Started <i class="fad fa-paper-plane"></i></span>
                        <span class="pending hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
                        <span class="success hidden">Sent <i class="fad fa-thumbs-up"></i></span>
                        <span class="fail hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>
                    </button>
                </form>
                <div class="disclaimer block opacity-70 mx-auto mt-3 max-w-lg">
                    <div class="flex w-full">
                    <i class="fa-light fa-info-circle leading-none text-xl md:text-3xl" style="width:40px"></i>
                    <p class="mx-auto text-left leading-tight pl-2 text-xs"><em>By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</em></p>
                    </div>
                </div>
                <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                    <h5 class="mx-auto"><strong><i class="fas fa-check"></i> Success!</strong></h5>
                    <h2 class="leading-none text-pianote my-3 md:my-4 font-bebas"><strong>CHECK YOUR EMAIL</strong></h2>
                    <p class="leading-normal mx-auto max-w-xl"><em>You should receive an email from team@pianote.com within 10 minutes.
                            If you don’t, then check your spam folder or re-enter your email address again.</em></p>
                    <div class="mt-5 lg:mt-6">
                        <a href="https://youtube.com/user/pianolessonscom" target="_blank" class="text-white transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 youtube" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                        <a href="https://facebook.com/pianoteofficial" target="_blank" class="text-white transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 facebook" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/pianoteofficial" target="_blank" class="text-white transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 instagram" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="inline-block px-3 md:px-4 questions">
                <p><strong>Any questions?</strong><br class="inline sm:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline sm:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.</p>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'rolandTrailer',
        'video' => '567535328',
        'vimeo' => true,
    ])
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function (){

            $(".ajax-form").submit(function(e) {
                e.preventDefault();

                var pre = $(this).find(".pre-add"),
                    pending = $(this).find(".pending"),
                    success = $(this).find(".success"),
                    fail = $(this).find(".fail"),
                    submitButton = $(this).find(".submit"),
                    disclaimer = $(this).parent().find(".disclaimer"),
                    thankBanner = $(this).parent().find(".thank-you-box"),
                    form = $(this),
                    url = form.attr("action");

                pre.addClass("hide hidden");
                success.addClass("hide hidden");
                fail.addClass("hide hidden");
                pending.removeClass("hide hidden");
                submitButton.removeClass("error");

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function() {
                        form.addClass("hide hidden");
                        disclaimer.addClass("hide hidden");
                        thankBanner.addClass("active");

                        pending.addClass("hide hidden");
                        success.removeClass("hide hidden");
                    },
                    error: function() {
                        submitButton.addClass("error");

                        pending.addClass("hide hidden");
                        fail.removeClass("hide hidden");
                    }
                });
            });
        });
    </script>
@endsection
