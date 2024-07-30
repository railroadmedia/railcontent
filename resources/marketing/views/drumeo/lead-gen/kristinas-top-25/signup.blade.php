@extends('drumeo._partials.global-layout')

@section('global-head')
    <meta name="robots" content="noindex">
    <title>25 Top Drum Songs With Kristina Rybalchenko | Drumeo</title>
    <meta property="og:title" content="25 Top Drum Songs With Kristina Rybalchenko | Drumeo">
    <meta name="description" content="Learn to play 25 of Kristina’s favorite drum covers.">
    <meta property="og:description" content="Learn to play 25 of Kristina’s favorite drum covers.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/kristinas-top-25/">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
@stop

@section('body-data')
    x-data ='{
    soundslice : false,
    }'
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="text-white text-center lg:text-left px-6 lg:px-8 py-10 sm:py-12 lg:py-24 bg-cover bg-center" style="background: #000f5c url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/header-bg.jpg');">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap justify-center items-start lg:items-center">
                <div class="w-full sm:w-7/12 xl:w-1/2">
                    <img
                        class="h-28 sm:h-32 lg:h-40 mb-3"
                        src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/logo.svg"
                        alt="logo"
                        fetchpriority="high"
                    />
                    <img
                        class="rounded-xl sm:hidden mb-5 transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=660,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/header-image-m.png"
                        alt="header hero image mobile"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <p class="leading-tight">
                        <strong>Learn to play 25 of Kristina’s <br class="lg:hidden">favorite drum covers. <span class="text-[#ff72ef]">FOR FREE.</span></strong>
                    </p>
                    <p class="hidden lg:inline-block leading-tight mt-3 mb-6">
                        <i class="fas fa-check text-[#ff72ef]" aria-hidden="true"></i> Accurate Sheet Music
                        <i class="ml-2 fas fa-check text-[#ff72ef]" aria-hidden="true"></i> Play-Along Tools
                        <i class="ml-2 fas fa-check text-[#ff72ef]" aria-hidden="true"></i> Drum-less Versions</p>
                    <div class="flex inline-block lg:hidden leading-tight mt-2 sm:mt-3 mb-4 sm:mb-6">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-[#ff72ef]" aria-hidden="true"></i><br> Accurate<br>  Sheet Music</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-[#ff72ef]" aria-hidden="true"></i><br> Play-Along <br> Tools</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-[#ff72ef]" aria-hidden="true"></i><br> Drum-less <br> Versions</p>
                    </div>
                    <div class="mx-auto sm:mx-0 text-center" style="max-width:470px">
                        @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                                "formName" => 'Kristinas Top 25',
                                "formId" => "Drumeo - Engagement - Trigger - Kristinas Top 25 - Web Form",
                                "buttonText" => "Get It Now ",
                                "stacked" => true
                            ])
                    </div>
                </div>
                <div class="w-full sm:w-5/12 xl:w-1/2 sm:pl-5 xl:px-12 hidden sm:block">
                    <img
                        class="transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=830,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/header-image.png"
                        alt="header hero image"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                </div>
            </div>
        </div>
    </header>

    <section class="text-center relative py-10 md:py-14 lg:py-20 px-4">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-4 md:mb-5">
                <strong>Kristina’s favorite bangers</strong>
            </h2>
            <h6 class="leading-normal mb-6 md:mb-12 lg:mb-16 sm:px-4">
                These are 25 songs Kristina loves to play on the drums – whether it’s viral cover videos or just for her <br class="hidden lg:inline">
                own inspiration. Scroll down to start learning all 25 with note-for-note sheet music and playback tools.
            </h6>
            @include('drumeo.lead-gen.kristinas-top-25._songs',[
                "signup" => true,
            ])
        </div>
    </section>

{{--    <div class="relative h-5 sm:h-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #000318 calc(50% + 1px));"></div>--}}
{{--    <section class="text-center text-white px-5 sm:px-6 py-8 sm:py-12 lg:py-20" style="background-color:#0c1524;">--}}
{{--        <div class="container max-w-4xl mx-auto">--}}
{{--            <h2><strong>Learn the easy way</strong></h2>--}}
{{--            <p class="leading-tight mt-2 sm:mt-3">--}}
{{--                Drumeo’s playalong tools help you hear all the instruments, visualize<br class="hidden sm:inline">--}}
{{--                every note, and loop a section until you have it nailed. </p>--}}

{{--            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto">--}}
{{--                <div style="padding-bottom: 62.4%; background-image: url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png);" class="mt-4 sm:mt-6 lg:mt-8 lg:mb-6 bg-cover bg-center lazyloaded" x-on:click="soundslice = true;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png"></div>--}}
{{--            </div>--}}
{{--            <div class="text-center w-full sm:w-auto mt-6 lg:mt-0 mx-auto mb-5">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">--}}
{{--                        <div class="flex sm:inline-block">--}}
{{--                            <div class="w-14 sm:w-full flex-shrink-0">--}}
{{--                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/5000-songs-icon.svg" class="h-6 sm:h-10">--}}
{{--                            </div>--}}
{{--                            <div class="text-left sm:text-center">--}}
{{--                                <p class="mb-1 sm:my-2"><strong>{{ Prices::$drumeoSongs }}+ popular songs.</strong></p>--}}
{{--                                <p class="text-sm">Get note-for-note song breakdowns for every style, era, and skill level.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">--}}
{{--                        <div class="flex sm:inline-block">--}}
{{--                            <div class="w-14 sm:w-full flex-shrink-0">--}}
{{--                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/tempo-icon.svg" class="h-6 sm:h-10">--}}
{{--                            </div>--}}
{{--                            <div class="text-left sm:text-center">--}}
{{--                                <p class="mb-1 sm:my-2"><strong>Find the perfect tempo.</strong></p>--}}
{{--                                <p class="text-sm">Slow down or speed up any section of a song to hear every note.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">--}}
{{--                        <div class="flex sm:inline-block">--}}
{{--                            <div class="w-14 sm:w-full flex-shrink-0">--}}
{{--                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/loop-icon.svg" class="h-6 sm:h-10">--}}
{{--                            </div>--}}
{{--                            <div class="text-left sm:text-center">--}}
{{--                                <p class="mb-1 sm:my-2"><strong>Loop the trouble spots.</strong></p>--}}
{{--                                <p class="text-sm">No more pausing and rewinding that tricky fill. Loop it over and over again!</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">--}}
{{--                        <div class="flex sm:inline-block">--}}
{{--                            <div class="w-14 sm:w-full flex-shrink-0">--}}
{{--                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/no-drums-icon.svg" class="h-6 sm:h-10">--}}
{{--                            </div>--}}
{{--                            <div class="text-left sm:text-center">--}}
{{--                                <p class="mb-1 sm:my-2"><strong>Remove the drums.</strong></p>--}}
{{--                                <p class="text-sm">Magically remove the original drums to make each song uniquely yours.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">--}}
{{--                        <div class="flex sm:inline-block">--}}
{{--                            <div class="w-14 sm:w-full flex-shrink-0">--}}
{{--                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/play-it-right-icon.svg" class="h-6 sm:h-10">--}}
{{--                            </div>--}}
{{--                            <div class="text-left sm:text-center">--}}
{{--                                <p class="mb-1 sm:my-2"><strong>Play it right the first time.</strong></p>--}}
{{--                                <p class="text-sm">Get perfect notation and learn to play accurately from the get-go.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">--}}
{{--                        <div class="flex sm:inline-block">--}}
{{--                            <div class="w-14 sm:w-full flex-shrink-0">--}}
{{--                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices-icon.svg" class="h-6 sm:h-10">--}}
{{--                            </div>--}}
{{--                            <div class="text-left sm:text-center">--}}
{{--                                <p class="mb-1 sm:my-2"><strong>Take your songs anywhere.</strong></p>--}}
{{--                                <p class="text-sm">Accessible on any device, or printable,so you can play any song, any time.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "white",
        "textColor" => "black",
    ])

    <div id="final" class="anchor"></div>
    <section class="text-center py-14 md:py-24 text-white bg-cover bg-center" style="background: #000f5c url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/bottom-bg.jpg');">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="h-32 sm:h-36 lg:h-44" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/kristinas-top-25/logo.svg" alt="FWTGF logo" />
                <h5 class="my-5 lg:my-7 leading-normal">
                    <strong>Learn to play 25 of Kristina’s <br class="sm:hidden">favorite drum covers <span class="text-[#ff72ef]">FOR FREE.</span></strong><br>
                    Enter your email to get all<br class="sm:hidden"> the charts sent to you.
                </h5>
                <div class="mx-auto" style="max-width:700px">
                    @include("drumeo.lead-gen.partials.sign-up-form", [
                                "formName" => 'Kristinas Top 25',
                                "formId" => "Drumeo - Engagement - Trigger - Kristinas Top 25 - Web Form2",
                    "recaptchaKey" => $recaptchaKey,
                                "buttonText" => "Get It Now ",
                        ])
                </div>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '23rlc',
        'soundslice' => true,
    ])
    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/form-tracking.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
