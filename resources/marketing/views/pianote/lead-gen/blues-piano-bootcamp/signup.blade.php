@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Chord Hacks | Pianote</title>
    <meta property="og:title" content="Chord Hacks">

    <meta name="description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/chord-hacks">
@endsection

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>
        header .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
    </style>
@endsection

@section('page-body')
    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:linear-gradient(to right, #077dff, #343fff, #5a09ff);">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left pr-0 sm:pr-6">
                    <img class="h-5 sm:h-6 lg:h-7 mb-1 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/logo.svg" alt="logo" fetchpriority="high">
                    <h2 class=""><strong>The essential keys</strong></h2>
                    <h3 class="sm:-mt-1 lg:mt-0"> to playing blues piano</h3>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-2"><strong>Sign up for 4 FREE play-along lessons</strong></h6>

                    <div class="mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top" style="padding-bottom: 75%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image-m.png" alt="header image" fetchpriority="high" />
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check"></i> Learn by doing
                        <i class="ml-2 fas fa-check"></i> No theory required
                        <i class="ml-2 fas fa-check"></i> Free lifetime access</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle"></i><br> No theory <br> required</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle"></i><br> Free lifetime <br>access</p>
                    </div>

                    <div class="mt-6 sm:mt-5 lg:mt-10">
                        @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                        "formName" => 'Chord Hacks',
                            "buttonText" => "start for free",
                            'stacked' => true,
                            'inputBorder' => '1px solid #747474',
                            'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/chord-hacks/thank-you/"
                        ])
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="relative bg-contain bg-top" style="padding-bottom: 102%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image.png" alt="header image" fetchpriority="high" />
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div style="background:#fbfdff;">
        <div class="container max-w-4xl mx-auto -mb-10 -mt-10 z-20 relative">
            <div class="px-5 lg:px-0">
                <div class="flex flex-wrap sm:flex-nowrap text-center shadow-lg rounded-xl relative" style="background:linear-gradient(to bottom, #fff, #F1F7FE);">
                    <div class="z-10 flex flex-wrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-6 lg:px-5 text-left sm:text-center">
                        <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 border-r border-gray-300">
                            <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-indigo-700 text-2xl"></i>
                            <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                                <span class="text-sm">Start anytime!</span></p>
                        </div>
                        <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 border-r border-gray-300">
                            <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-indigo-700 text-2xl"></i>
                            <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                                <span class="text-sm">10 minutes a day.</span></p>
                        </div>
                        <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 border-r border-gray-300">
                            <i class="far fa-fw mr-3 sm:mr-0 fa-piano-keyboard text-indigo-700 text-2xl"></i>
                            <p class="leading-tight mx-0"><strong class="font-black">Skill Level</strong><br>
                                <span class="text-sm">Beginner.</span></p>
                        </div>
                        <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0">
                            <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-indigo-700 text-2xl"></i>
                            <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                                <span class="text-sm">Play your first blues.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <h2 class="text-center"><strong>Learn the Blues by <br class="inline sm:hidden"> PLAYING the Blues.</strong></h2>
            <h6 class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7"><em>This is not your average piano course.</em><br>
                <strong class="text-indigo-700">Try a snippet from your 1st lesson and see for yourself.</strong></h6>
            <div class="flex flex-wrap items-start justify-center text-left">
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">Want to play the Blues? Then you NEED to know the 12-bar Blues pattern.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">To play the Blues, you have to feel the Blues. This lesson will show you how to get into the swing of things.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">Break away from basic chords. You’ll be confidently playing through chord changes with this iconic Boogie Pattern.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">You’ll learn 2 iconic Blues riffs. You can play them over your 12-bar progression, or use them as fills whenever you like.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40" style="background-color:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Kevin Castro</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">Kevin Castro wouldn’t be a professional pianist without the Blues. In fact, it was a Blues improvisation that got him accepted into University.
                        <br><br>
                        Since then, he’s toured with rising stars (JESSIA, Elijah Woods), played at TikTok Headquarters in New York and LA, and even recorded a demo for Jennifer Lopez (which was, sadly, never released).
                        <br><br>
                        But Kevin’s real passion comes from sharing his experience and knowledge with students.
                        <br><br>
                        The Blues changed his life, and he knows it will do the same for you.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('pianote.lead-gen.partials.quick-questions', [
        'textColor' => 'black',
        'bgColor' => '#fff'
    ])
    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:linear-gradient(to right, #077dff, #343fff, #5a09ff);">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center justify-center">
                <div class="text-center w-full sm:w-7/12 lg:w-5/12 mb-7 lg:mb-0">
                    <img class="h-20 md:h-24 lg:h-28 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h2 class="mt-2 sm:mt-4"><strong>4 play-along lessons </strong></h2>
                    <h3 class="mb-4 sm:mb-5">to get you started with the Blues</h3>
                    <div class="w-full mx-auto sm:mx-0">
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check mr-1"></i> FREE lifetime access</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check mr-1"></i> Play-along with a REAL teacher</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check mr-1"></i> No music theory knowledge required</p>
                    </div>
                    <div class="max-w-md md:max-w-auto mx-auto md:mx-0">
                        @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                        "formName" => 'Chord Hacks',
                            "buttonText" => "start for free",
                            'stacked' => true,
                            'inputBorder' => '1px solid #7A8491',
                        "redirectURL" => "/chord-hacks/thank-you/"
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "demoVid",
        "video" => '//player.vimeo.com/video/830711083?h=701c01c83f&autoplay=1',
        "title" => 'demoVid'
    ])
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
