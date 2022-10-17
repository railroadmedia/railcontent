@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Win A Roland Digital Piano | Pianote</title>
    <meta property="og:title" content="Win A Roland Digital Piano | Pianote">

    <meta name="description" content="Simply enter your email address before October 10 to secure your chance to win.">
    <meta property="og:description" content="Simply enter your email address before October 10 to secure your chance to win.">

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/roland-share.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/giveaway">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/parcel/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="/marketing/parcel/pianote/lead-gen-learn-songs.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <style>
        header {
            background-image:url('https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/header-m.jpg');
            background-size: cover;
            background-position: center;
        }

        @media (min-width:768px) {
            header {
                background-image:url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/header.jpg');
                background-size: cover;
                background-position: center;
            }
        }

        @media (min-width:1024px) {
            header {
                background-size: 1700px;
            }
        }

    </style>
@endsection

@section('global-body')
    @include('pianote.sales.nav')

    <header class="py-12 sm:py-20 bg-no-repeat" style="background-color:#00101D;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap">
                <div class="w-full md:w-4/12 lg:w-5/12 md:order-1 flex justify-center items-center">
                    <i class="fas fa-play play-button autoplay-video my-20 md:mt-0" data-open="trailer"></i>
                </div>
                <div class="w-full md:w-8/12 lg:w-7/12 mx-auto sm:pl-8 md:pl-14 lg:pl-0 text-center md:text-left px-4 sm:px-0">
                    <img class="h-36 md:h-40 lg:h-44 mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/logo.png" alt="logo">
                    <div class="md:max-w-md">
                        <p class="mb-4" style="color:#D0E2E7;">
                            Want a free piano? Simply enter your email address before <span class="text-white font-extrabold">October 10</span> to secure your chance to win.
                            <br>
                            <strong class="text-pianote uppercase">ONLY <span class="tzcd-full">A LIMITED TIME</span> LEFT</strong>
                        </p>
{{--                        @include('pianote.lead-gen._sign-up-form', [--}}
{{--                            "formId" => 'Pianote - Engagement - Trigger - Giveaway - Web Form',--}}
{{--                            "formName" => 'Giveaway Form',--}}
{{--                            'buttonText' => 'I WANT TO WIN!',--}}
{{--                            'stacked' => true,--}}
{{--                            'disclaimerColor' => '#B3B3B9'--}}
{{--                        ])--}}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 md:px-6 py-12 md:py-20">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <div class="md:flex md:items-center mb-6 md:mb-20">
                <div class="md:w-7/12 md:pr-7">
                    <h4 class="font-extrabold mb-4 md:mb-8 leading-normal" style="color:#2A2F34;">
                        Immersive sound. <br>
                        Incredible performance. <br>
                        Authentic feel.
                    </h4>
                    <img class="lazyload md:hidden rounded-xl mb-6" data-src="https://pianote.s3.amazonaws.com/giveaways/intro-m.jpg" alt="intro image">
                    <p>
                        The Roland FP-10 is the perfect piano for at-home use. Whether you’re practicing alone, or giving a concert in the living room. <br><br>
                        When inspiration strikes, take a seat at the latest model in Roland’s renowned FP piano series; the entry-level FP-10. <br><br>
                        This digital piano is always ready to play, with a reassuringly authentic feel from the 88-note PHA-4 Standard keyboard, joined by Roland’s evocative SuperNATURAL piano tones through onboard speakers or headphones. <br><br>
                        With its portable, space-saving design, the FP-10 is the ideal instrument for home use. The Roland FP-10 retails for $599.99. But it can be yours for FREE.
                    </p>
                </div>
                <div class="w-5/12 justify-center pl-8">
                    <img class="rounded-xl lazyload hidden md:inline-block" data-src="https://cdn.musora.com/image/fetch/w_450,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/intro.jpg" alt="intro image">
                </div>
            </div>

            <picture>
                <source media="(min-width:768px)" srcset="https://pianote.s3.amazonaws.com/giveaways/gallery_feature.jpg">
                <img class="rounded-xl mb-6 lazyload" data-src="https://pianote.s3.amazonaws.com/giveaways/gallery-feature-m.jpg" alt="gallery feature">
            </picture>

            <img class="rounded-xl mb-10 shadow-md lazyload" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/gallery.jpg" alt="gallery">

            <div class="md:hidden">
                <img class="rounded-xl shadow-md mb-4" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/gallery-01-m.jpg" alt="gallery 1">
                <img class="rounded-xl shadow-md mb-4" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/gallery-02-m.jpg" alt="gallery 2">
                <img class="rounded-xl shadow-md mb-4" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/gallery-03-m.jpg" alt="gallery 3">
                <img class="rounded-xl shadow-md mb-8" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/gallery-04-m.jpg" alt="gallery 4">
            </div>

            <div class="rounded-xl py-6 md:py-10 shadow-md px-8" style="background: #FFF6F6;">
                <div class="max-w-lg mx-auto md:flex md:items-center text-center md:text-left">
                    <img class="h-12 lg:ml-7 md:mr-6 lazyload mb-3 md:mb-0" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/roland_logo.svg" alt="roland logo">
                    <p class="font-bold md:leading-tight">
                        This free Roland FP-10 digital piano has been generously donated by our partners at Roland.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-4 md:px-6" style="background:#FFF7F7;">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center">
            <div class="md:order-1 md:w-5/12 md:pl-12 text-center md:text-left mb-6 md:mb-0">
                <img class="lazyload h-96" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/ui.png" alt="ui image">
            </div>
            <div class="md:w-7/12 lg:pr-6">
                <h4 class="font-extrabold leading-snug mb-4" style="color:#2A2F34;">
                    You’ve won a piano. <br>
                    Now learn how to play it…
                </h4>
                <p class="leading-normal" style="color:#2A2F34;">
                    A piano is not a piece of furniture. <br><br>
                    It’s designed to be played, enjoyed, treasured, and used for life. That’s why, as well as getting a free piano, you’ll also get a FREE YEAR of piano lessons from Pianote! <br><br>
                    Step-by-step lessons from REAL teachers to guarantee your progress. Play your favorite songs, get support and feedback on your journey, and connect with the best online community of piano players around. <br><br>
                    It’s all included with your prize. <br><br>
                    But that’s not all…
                </p>
                <h4 class="font-extrabold my-4" style="color:#2A2F34;">More than one chance to win!</h4>
                <p class="leading-normal" style="color:#2A2F34;">
                    Because even if you don't win the main prize (but you probably will, right?), you might snag one of 5 annual Pianote memberships as our runner-up prizes.
                </p>
            </div>
        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #FFF7F7 calc(50% + 1px));"></div>
    <section class="pb-20 px-4 md:px-6" style="background: #010C15;">
        <div class="max-w-md md:max-w-4xl mx-auto text-center">
            <img class="h-28 relative z-10 mb-12 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/caution_icon.svg" alt="caution icon">
            <h3 class="text-white font-extrabold leading-normal mb-6">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="md:grid md:grid-cols-2 md:gap-4 text-left mb-10 md:mb-16">
                <div class="flex mb-4 md:mb-0" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No purchase necessary and there are no age restrictions.
                </div>
                <div class="flex mb-4 md:mb-0" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No sneaky shipping fees. We’ll take care of it.
                </div>
                <div class="flex mb-4 md:mb-0" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    Main prize winner must live in USA or Canada.
                </div>
                <div class="flex" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    One email entry per person, but… you’ll get instructions via email on how to get 10 more bonus entries!
                </div>
            </div>
            <div class="inline-block italic text-pianote py-4 px-6" style="background:#111F29;">
                The winner will be announced during a LIVE event on October 10th!
            </div>
        </div>
    </section>

    <section class="flex items-center text-center text-white" style="background:linear-gradient(180deg, #F61A30 0%, #590C13 100%);">
        <img class="lazyload w-2/12 hidden md:inline" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/piano_qa.png" alt="piano icon" />
        <div class="container mx-auto max-w-3xl px-6 sm:px-4 py-8 md:py-10 lg:py-12">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to give<br class="inline sm:hidden"> my email address?</strong></h3>
            <p>
                We want the winner to be someone who really wants and will use this free piano. After all, that’s what it’s for. So getting an email address lets us know you’re a real person! <br><br>
                On top of that, we want to start a relationship with you. It’s our way of saying, “Hey, we create awesome piano lessons, and we’d love to show you.” Don’t worry. We won’t send you spam or share your email address with anybody else. You’ll get free ongoing piano lessons and some special offers. And if you don’t like our emails, you can unsubscribe anytime.
            </p>
        </div>
        <img class="lazyload w-2/12 hidden md:inline" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/email_qa.png" alt="email icon" />
    </section>

    <section class="text-center text-white py-8 md:py-16 lg:py-28 px-5 md:px-7 bg-center bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/footer.jpg">
        <div class="mx-auto max-w-md md:max-w-2xl">
            <img class="h-32 sm:h-36 md:h-44 lg:h-52 lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://pianote.s3.amazonaws.com/giveaways/logo.png" alt="title image">
            <h6 class="my-4 sm:my-6 uppercase text-pianote"><strong>ONLY <span class="tzcd-full">A LIMITED TIME</span> LEFT</strong></h6>
{{--            @include("pianote.lead-gen._sign-up-form", [--}}
{{--                    "formId" => 'Pianote - Engagement - Trigger - Giveaway - Web Form',--}}
{{--                    "formName" => 'Giveaway Form',--}}
{{--                "buttonText" => "I WANT TO WIN!",--}}
{{--                "oneLineLg" => true,--}}
{{--                'disclaimerColor' => '#B3B3B9'--}}
{{--            ])--}}
            </div>
    </section>

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "754475403",
    ])
    @include('pianote.sales.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/parcel/pianote/modal.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/modal-autoplay-alt.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.tzcd-full').countdown('2022/10/10')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/10/10')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
        });
    </script>
@endsection

