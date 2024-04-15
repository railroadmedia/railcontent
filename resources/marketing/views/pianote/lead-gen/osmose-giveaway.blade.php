@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Win an Osmose Expressive-E from Jordan Rudess and Pianote | Pianote</title>
    <meta property="og:title" content="Win an Osmose Expressive-E from Jordan Rudess and Pianote | Pianote">

    <meta name="description"
        content="Want a free piano? Enter your email address and you’ll be in the running to win an Osmose Expressive-E.">
    <meta property="og:description"
        content="Want a free piano? Enter your email address and you’ll be in the running to win an Osmose Expressive-E.">

    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/470x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/logo.webp">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <style>
        header {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/header-bg-m.webp');
        }

        @media (min-width:768px) {
            header {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/header-bg.webp');
            }
        }
            .play-button {
            cursor: pointer;
            outline: none;
            transition: opacity 0.3s;
            color: #fff;
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid #fff;
            border-radius: 200px;
            line-height: 1em;
            font-size: 29px;
            padding: 18px 22px;
        }

        @media (min-width: 768px) {
            .play-button {
                font-size: 35px;
                padding: 22px 27px;
                border-width: 4px;
            }
        }

        @media (min-width: 1024px) {
            .play-button {
                font-size: 39px;
                padding: 25px 30px;
            }
        }

        .play-button:hover {
            opacity: 0.8;
        }
        .play-button.smaller {
            border-width: 2px;
            font-size: 24px;
            padding: 14px 17px;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
        modalVideoLeft : false,
        modalVideoRight : false,
    }"
@endsection

@section('global-body')

@include('pianote.sales.partials._nav')

<header class="px-5 sm:px-6 py-8 sm:py-12 bg-no-repeat text-white bg-cover bg-center" style="background-color:#00101D;">
    <div class="container mx-auto max-w-4xl">
        <div class="flex flex-wrap sm:flex-nowrap">
            <div class="mx-auto text-center lg:text-left px-4 sm:px-0">
                <div class="sm:px-3">
                    <img class="h-28 lg:h-36"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/470x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/logo.webp"
                        alt="Win an Osmose Expressive-E from Jordan Rudess and Pianote Logo">
                    <img class="h-52 sm:hidden mt-4"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/510x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/header-image.webp"
                        alt="Pianist's hands on the piano keyboard">
                    <p class="mx-0 my-4">
                        <span class="font-extrabold">Win an Osmose Expressive-E</span> <br />
                        Enter your email address and you’ll be in the running to win an Osmose Expressive-E (valued at
                        $1799 USD). One entry per person. Winner announced April 15.
                    </p>
{{--                    @include('pianote._partials.sign-up-form', [--}}
{{--                        'recaptchaKey' => $recaptchaKey,--}}
{{--                        'stacked' => true,--}}
{{--                        'formId' => 'Pianote - Engagement - Trigger - Osmose Giveaway - Web Form',--}}
{{--                        'formName' => 'Osmose Giveaway',--}}
{{--                        'buttonText' => 'I WANT TO WIN!',--}}
{{--                    ])--}}
                    <span class="join sold-out smaller w-full">this offer has now ended</span>
                </div>
                </div>
                <div class="hidden sm:block flex-shrink-0">
                    <img class="h-72 lg:h-96 transition-opacity opacity-1"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/header-image.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')"
                        alt="Pianist's hands on the piano keyboard">
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 md:px-6 py-12 md:py-20" x-data="{
    scrollToSection: function () {
        const element = document.getElementById('wantToWin');
        if (element) {
            element.scrollIntoView({behavior: 'smooth'});
        }
    }}">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <div class="md:flex md:flex-wrap">
                <div class="w-full mb-4 md:mb-8 text-center">
                    <h2 class="font-extrabold leading-tight mb-1" style="color:#2A2F34;">
                        Press. Bend. <br class="inline md:hidden"> Shake. Strum.
                    </h2>
                    <p class="leading-tight"><strong><em>
                                The new way to bring expression <br class="inline md:hidden">
                                to your playing.</em></strong></p>

                </div>
                <div class="md:w-1/2 md:pr-7">
                    <img class="md:hidden rounded-xl mb-6 transition-opacity opacity-1"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/features-collage.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')" alt="Collage of 4 images with piano">
                    <p>
                        You’ve never been able to play piano like this.
                        <br><br>
                        Bring pitch bending, vibrato, and even strumming to your piano playing with the revolutionary Osmose
                        Expressive-E.
                        <br><br>
                        Use intuitive gestures to control the 49-key synthesizer and take your musical journey into
                        uncharted waters.
                        <br><br>
                        We’ve partnered with Dream Theater’s Jordan Rudess to give away a beautiful Osmose Expressive-E to
                        one lucky pianist.
                        <br><br>
                        Could it be you?
                        <br><br>
                    </p>
                </div>


                <div class="w-1/2 justify-center pl-6">
                    <img class="rounded-xl hidden md:inline-block transition-opacity opacity-1"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/features-collage.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')" alt="Collage of 4 images with piano">
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20 px-4 md:px-6" style="background:#01101D;">
        <div class="container m-auto max-w-5xl text-white">
            <h2 class="font-extrabold leading-normal mb-1 text-center">See it in action.</h2>
                <p class="leading-tight text-center"><strong><em> Express your originality.</em></strong></p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 md:py-10 relative">
                        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                            x-on:click="modalVideoLeft = true;" role="button">
                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>
                            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 transition-opacity opacity-1"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/video-thumb-01.jpg"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                alt="header image" fetchpriority="high" />
                        </div>
                        <p class="text-center leading-tight py-2 text-sm md:text-xs"><strong><em>
                                    Expressive E - Discovering Osmose with<br class="lg:hide">
                                     Jordan Rudess (prototype unit)
                                </em></strong></p>

                    </div>
                    <div class="p-4 md:py-10 relative">
                        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                            x-on:click="modalVideoRight = true;" role="button">
                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>
                            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 transition-opacity opacity-1"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/video-thumb-02.jpg"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                alt="header image" fetchpriority="high" />
                        </div>
                        <p class="text-center leading-tight py-2 text-sm md:text-xs"><strong><em>
                                    Osmose by Expressive E with<br class="lg:hide">
                                    Jordan Rudess - NAMM 2023
                                </em></strong></p>
                    </div>
                </div>


        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10"
        style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #01101D calc(50% + 1px)); ">
    </div>
    <section class="pb-20 px-5 md:px-6" style="background:linear-gradient(180deg, #F61A30 0%, #590C13 100%);">
        <div class="max-w-md max-w-3xl lg:max-w-4xl mx-auto text-center">
            <svg class="inline-block h-28 relative z-10 mb-5 sm:mb-12" xmlns="http://www.w3.org/2000/svg" width="150"
                height="150" viewBox="0 0 150 150" fill="none">
                <path
                    d="M41.1853 6.17994C45.1417 2.22302 50.5047 0 56.1023 0H93.9075C99.5051 0 104.868 2.22302 108.824 6.17994L143.816 41.1862C147.773 45.1425 150 50.5055 150 56.103V93.908C150 99.5055 147.773 104.868 143.816 108.825L108.824 143.816C104.868 147.773 99.5051 150 93.9075 150H56.1023C50.5047 150 45.1417 147.773 41.1853 143.816L6.17879 108.825C2.22301 104.868 0 99.5055 0 93.908V56.103C0 50.5055 2.22301 45.1425 6.17879 41.1862L41.1853 6.17994ZM67.9714 44.2633V77.0862C67.9714 81.2477 71.1071 84.1197 75.0049 84.1197C78.9026 84.1197 82.0384 81.2477 82.0384 77.0862V44.2633C82.0384 40.6294 78.9026 37.2298 75.0049 37.2298C71.1071 37.2298 67.9714 40.6294 67.9714 44.2633ZM75.0049 93.4977C69.8177 93.4977 65.6268 97.9522 65.6268 102.876C65.6268 108.327 69.8177 112.254 75.0049 112.254C80.1921 112.254 84.383 108.327 84.383 102.876C84.383 97.9522 80.1921 93.4977 75.0049 93.4977Z"
                    fill="#FFAE00" />
            </svg>
            <h3 class="text-white font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center text-left my-8 md:my-12 text-white text-base font-normal">
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    Enter your email address to enter.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No purchase is necessary and there are no age restrictions.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    One entry per person.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No shipping fees. We’ll take care of it. (VAT may apply.)
                </div>
            </div>
            <p class="inline-block italic py-4 px-6 bg-musora">
                The winner will be announced during a LIVE event on <strong>April 15th</strong>.
            </p>
        </div>
    </section>



    <section class="text-center pb-8 md:pb-12 lg:pb-14 px-5 md:px-7" style="background-color:#F1EFED;" id="wantToWin">
        <div class="container mx-auto max-w-3xl">
            <div class="flex flex-col">
                <div class="py-4 lg:py-6">
                    <img class="h-28 lg:h-32 transition-opacity opacity-1"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/470x0/filters:quality(95)/marketing/pianote/lead-gen/osmose-giveaway/logo.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')"
                        alt="Win an Osmose Expressive-E from Jordan Rudess and Pianote Logo">
                </div>
                <h2 class="pb-4 lg:pb-6"><strong>Win an Osmose Expressive-E</strong></h2>
{{--                <div class="w-full">--}}
{{--                    @include('pianote._partials.sign-up-form', [--}}
{{--                        'recaptchaKey' => $recaptchaKey,--}}
{{--                        'formId' => 'Pianote - Engagement - Trigger - Osmose Giveaway - Web Form2',--}}
{{--                        'formName' => 'Osmose Giveaway',--}}
{{--                        'buttonText' => 'I WANT TO WIN!',--}}
{{--                    ])--}}

{{--                </div>--}}
                <span class="join sold-out smaller w-full">this offer has now ended</span>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal', [
        'name' => 'modalVideoLeft',
        'video' => 'wNjxe49-_Cw',
        'youtube' => true,
    ])

    @include('_partials.components.video-modal', [
        'name' => 'modalVideoRight',
        'video' => 'fsHr1hpKgVo',
        'youtube' => true,
    ])

    @include('pianote.sales.partials._footer', [
        'minimal' => false,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@endsection
