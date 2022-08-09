@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | {{ $brand }} | Musora</title>
@endsection

@section('styles')
    @parent
    <link href="{{ asset('assets/marketing/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/marketing/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/marketing/guitar-quest.css') }}" rel="stylesheet">
    {{-- Styelsora --}}
    <link href="{{ asset('/tailwindcss/tailwind.css') }}" rel="stylesheet">
    
    <style type="text/css">
        @media (min-width: 1160px) {
            body {
                padding-top: 56px;
            }
        }
        #gq-progress > .bg-black {
            background-color: transparent;
        }
        .trophy-progress-cutoff.bg-gq-gray.inverted {
            border: 10px solid #000718 !important;
        }
        .card-info > h4, .card-info > p, .card-info > h6, .item-description:after {
            color: #fff !important;
            background: none !important;
        }
        .card-info > p {
            font-size: 14px !important;
        }
        .item-description.font-compressed {
            max-height: 130px !important;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('assets/marketing/svg-polyfil.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/marketing/nav-footer.js') }}"></script>
@endsection

@section('content')
    @include('content.breadcrumbs._lesson-breadcrumbs')

    <main x-data="{
            'levelMap': true,
            'modalOpen': false,
            'levelOneHref': '{{ $packBundles[0]->fetch('url') }}',
            'levelOneStatus': '{{ $packBundles[0]->fetch('progress_state') }}',
            'levelTwoHref': '{{ $packBundles[1]->fetch('url') }}',
            'levelTwoStatus': '{{ $packBundles[1]->fetch('progress_state') }}',
            'levelThreeHref': '{{ $packBundles[2]->fetch('url') }}',
            'levelThreeStatus': '{{ $packBundles[2]->fetch('progress_state') }}',
            'levelFourHref': '{{ $packBundles[3]->fetch('url') }}',
            'levelFourStatus': '{{ $packBundles[3]->fetch('progress_state') }}',
            'levelFiveHref': '{{ $packBundles[4]->fetch('url') }}',
            'levelFiveStatus': '{{ $packBundles[4]->fetch('progress_state') }}',
            'levelSixHref': '{{ $packBundles[5]->fetch('url') }}',
            'levelSixStatus': '{{ $packBundles[5]->fetch('progress_state') }}',
            'levelSevenHref': '{{ $packBundles[6]->fetch('url') }}',
            'levelSevenStatus': '{{ $packBundles[6]->fetch('progress_state') }}',
            'levelEightHref': '{{ $packBundles[7]->fetch('url') }}',
            'levelEightStatus': '{{ $packBundles[7]->fetch('progress_state') }}',
            'levelNineHref': '{{ $packBundles[8]->fetch('url') }}',
            'levelNineStatus': '{{ $packBundles[8]->fetch('progress_state') }}',
        }"
        class="tw-flex tw-flex-col tw-bg-fixed"
        style="background-image: url(https://musora.com/cdn-cgi/image/width=1500,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/star-pattern.svg); background-color: #000718;"
    >

        {{-- header --}}
        <div class="container fluid collapsed pb-2">
            <div class="container">
                <div class="tw-flex tw-flex-col tw-relative tw-items-center">
                    <img id="packLogo"
                         src="https://musora.com/cdn-cgi/image/width=1000,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png"
                         class="tw-mt-12 tw-w-3/5 md:tw-w-2/5 lg:tw-w-1/2 tw-block">

                    @if(empty($state)) {{-- unstarted --}}
                        <h1 class="heading tw-text-white tw-mb-2 tw-mt-2 tw-uppercase tw-font-normal tw-text-center">
                            YOUR GUITAR JOURNEY
                        </h1>
                        <a href="{{ $nextLessonUrl }}">
                            <button class="tw-cursor-pointer bg-goldenrod-gradient tw-text-base tw-transition tw-duration-300 tw-px-12 tw-py-4 tw-inline-block tw-uppercase tw-text-[#00101D] font-roboto-condensed-bold tw-rounded-full tw-mt-6">
                                Start Your Quest!
                            </button>
                        </a>
                    @elseif($state == 'completed') {{-- completed --}}
                        <h1 class="heading tw-text-white tw-mb-2 tw-mt-2 tw-uppercase tw-font-normal tw-text-center">
                            <i class="fas fa-trophy-alt text-goldenrod tw-transform tw--rotate-12"></i> Your Quest is Complete!
                        </h1>
                        <a href="/members/packs/guitar-quest/chapter-1-play-a-show-song-in-an-hour/280600/intro/280601">
                            <button class="tw-cursor-pointer bg-goldenrod-gradient tw-text-base tw-transition tw-duration-300 tw-px-12 tw-py-4 tw-inline-block tw-uppercase tw-text-[#00101D] font-roboto-condensed-bold tw-rounded-full tw-mt-6">
                                Start From The Beginning!
                            </button>
                        </a>
                    @else {{-- started --}}
                        <h1 class="heading tw-text-white tw-mb-2 tw-mt-2 tw-uppercase tw-font-normal tw-text-center">
                            YOUR GUITAR JOURNEY
                        </h1>
                    @endif
                </div>
            </div>
        </div>

        {{-- continue next lesson --}}
        @if(!empty($state) && $state == 'started')
            <div class="container fluid pv-2">
                <div class="container">
                    <div class="flex flex-row flex-wrap align-v-center">
                        <div class="flex flex-column sm-2">
                        </div>
                        <div class="flex flex-column sm-4">
                            <a href="{{ $nextLessonUrl }}">
                                <img style="align-self: center;"
                                     src="https://musora.com/cdn-cgi/image/width=450,quality=90/{{ $nextLesson->fetch('data.thumbnail_url') }}">
                            </a>
                        </div>
                        <div class="flex flex-column ph-2 sm-4 tw-mt-6 md:tw-mt-6">
                            <p class="body text-white color-gq-yellow">LEVEL {{ $nextPackBundle->fetch('position') }} -
                                LESSON {{ $nextLesson->fetch('position') }}</p>

                            <a href="{{ $nextLessonUrl }}">
                                <p class="subheading text-white"
                                   style="font-weight: 800;">{{ $nextLesson->fetch('fields.title') }}</p>
                            </a>
                            <p class="body text-white">{{ strip_tags($nextLesson->fetch('data.description')) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row flex-wrap align-h-center">
                        <a  href="{{ $nextLessonUrl }}"
                            class="tw-cursor-pointer bg-goldenrod-gradient tw-text-base tw-transition tw-duration-300 tw-px-12 tw-py-4 tw-inline-block tw-uppercase tw-text-[#00101D] font-roboto-condensed-bold tw-rounded-full tw-mt-3">
                            Continue Your Quest!
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- Quest Map --}}
        <section class="tw-py-12 tw-relative">
                @include("products.guitar-quest.partials.map._map")
        </section>

        {{-- progress bar --}}
        @if(!empty($state))
            <div class="container collapsed fluid tw-pb-16">

                <h1 class="tw-text-white tw-font-extrabold tw-text-2xl tw-text-center font-primary md:tw--mb-2">
                    YOUR GUITAR QUEST PROGRESS
                </h1>

                <div class="container fluid collapsed tw-w-screen bg-gq-blue" id="gq-progress">
                    @include('members.partials._content-progress', [
                        "contentType" => $pack->fetch('type'),
                        "progress" => $pack->fetch('progress_percent'),
                        "nextLessonUrl" => '',
                        "xpAmount" => $pack->fetch('xp'),
                        "showCompleteButton" => false,
                        "contentId" => $pack->fetch('id'),
                        "brand" => 'guitareo',
                        "isCompleted" => $pack->fetch('completed', false),
                        "isStarted" => $pack->fetch('started', false),
                        "hideActionButton" => true,
                    ])
                </div>
            </div>
        @endif

        <section class="tw-relative tw-pb-16">
            <div class="tw-w-full lg:tw-w-2/3 tw-mx-auto">
                <div class="tw-w-full md:tw-w-3/4 tw-mx-auto tw-flex tw-justify-around">
                    {{-- Lessons Crushed --}}
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <img class="tw-w-24 sm:tw-w-32 md:tw-w-44 tw-block" src="https://musora.com/cdn-cgi/image/width=180,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/coin-lessons-crushed.png">
                        <h4 class="tw-uppercase text-goldenrod font-bison-bold mt-2">Lessons Crushed</h4>
                        <h3 class="tw-text-7xl tw-font-bold tw-text-white font-bison-bold">{{ $totalCompletedLessons }}</h3>
                    </div>
                    {{-- Challenges Completed --}}
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <img class="tw-w-24 sm:tw-w-32 md:tw-w-44 tw-block" src="https://musora.com/cdn-cgi/image/width=180,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/coin-challenges-completed.png">
                        <h4 class="tw-uppercase text-goldenrod font-bison-bold mt-2">Challenges Completed</h4>
                        <h3 class="tw-text-7xl tw-text-white tw-font-bold font-bison-bold">{{ $totalCompletedLevels }}</h3>
                    </div>
                </div>
            </div>
        </section>

        <div class="container mv-3" style="padding-bottom: 150px;">
            <h1 class="heading text-white mb-2 mt-1 tw-uppercase text-center">
                Guitar Quest Chapters
            </h1>

            <div class="flex flex-column">
                <div class="flex flex-row">
                    <content-catalogue
                        brand="guitareo"
                        catalogue-type="grid"
                        theme-color="guitareo"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $childContent }}"
                        user-id="{{ auth()->id() }}"
                        :lock-unowned="true"
                    ></content-catalogue>
                </div>
            </div>
        </div>

        {{-- Guitar Quest Bonus Modals --}}
        @include("partials.modals._gq-bonus-modals")      
    </main>

@endsection