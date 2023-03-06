@extends('partials.layout')

@section('meta')
    <title>Guitareo Lessons | Musora</title>
@endsection

{{-- Page Specific Styles --}}
@section('styles')
    <style>
        .pack-header::after {
            content: '';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            z-index:1;
            background:rgba(0,0,0,.4);
        }
        .pack-header > * {
            z-index:2;
            position:relative;
        }
    </style>
@endsection

{{-- Content --}}
@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <!-- PACKS SECTION-->
        <div class="flex flex-row tw-mt-8 tw-mb-3">
            <div class="flex flex-column grow">
                <div class="flex flex-row align-v-center">
                    <a href="{{ url()->route('platform.packs') }}"
                        aria-label="See All Lesson Packs Lessons"
                        class="tw-font-bold dark:tw-text-white tw-text-2xl lg:tw-text-3xl">
                        Lesson Packs
                    </a>
                </div>
            </div>
        </div>

        @include('partials.content._guitar-quest-pack', [
            'itemThumbnail' => 'https://www.musora.com/musora-cdn/image/width=2500,q_60,quality=85/https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background.jpg',
            'logoImage' => $guitarQuestPack->fetch('data.logo_image_url'),
            'nextItemUrl' => $guitarQuestPack->fetch('next_lesson_url'),
            'lessonsUrl' => $guitarQuestPack->fetch('url'),
            'itemProgress' => $guitarQuestPack->fetch('progress_state'),
        ])

        <div class="flex flex-row flex-wrap">
            @foreach($packs as $pack)
                @include('partials.content._lessons-pack', [
                    'themeColor' => 'guitareo',
                    'itemThumbnail' => $pack->fetch('data.thumbnail_url'),
                    'itemTitle' => $pack->fetch('fields.title'),
                    'lessonsUrl' => $pack->fetch('url'),
                    'logoImage' => $pack->fetch('data.logo_image_url'),
                    'nextItemUrl' => $pack->fetch('next_lesson_url'),
                    'lessonsUrl' => $pack->fetch('url'),
                    'itemProgress' => $pack->fetch('progress_state'),
                ])
            @endforeach
        </div>

        <div class="flex flex-column mv-3 ph-1">
            <!-- COURSES SECTION-->
            <div class="flex flex-row mb-3">
                <div class="flex flex-column grow">
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'course']) }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Courses</h2>
                        </a>
                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'course']) }}" aria-label="See All New Lessons" class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            See All
                        </a>
                    </div>

                    <div class="flex flex-row six-cards-row">
                        <transition appear name="fade">
                            <content-catalogue
                                brand="guitareo"
                                theme-color="guitareo"
                                :use-theme-color="true"
                                content-endpoint="/railcontent/content"
                                catalogue-type="grid"
                                limit="10"
                                :lock-unowned="true"
                                :five-wide="true"
                                :force-wide-thumbs="true"
                                :show-my-list-action="false"
                                :pre-loaded-content="{{ $newCourses }}"
                            >
                                <div class="flex flex-row nmh-1">
                                    @for($i = 0; $i < 6; $i++)
                                        @include('partials.bladesora.members.skeletons.card-item', [
                                            "cardClass" => 'six-wide',
                                        ])
                                    @endfor
                                </div>
                            </content-catalogue>
                        </transition>
                    </div>
                </div>
            </div>

            <!-- QUICK TIPS SECTION-->
            <div class="flex flex-row mb-3">
                <div class="flex flex-column grow">
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'quick-tips']) }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Quick Tips</h2>
                        </a>
                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'quick-tips']) }}" aria-label="See All New Lessons" class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            See All
                        </a>
                    </div>

                    <div class="flex flex-row six-cards-row">
                        <transition appear name="fade">
                            <content-catalogue
                                brand="guitareo"
                                theme-color="guitareo"
                                :use-theme-color="true"
                                content-endpoint="/railcontent/content"
                                catalogue-type="grid"
                                limit="10"
                                :lock-unowned="true"
                                :five-wide="true"
                                :force-wide-thumbs="true"
                                :show-my-list-action="false"
                                :pre-loaded-content="{{ $newQuickTips }}"
                            >
                                <div class="flex flex-row nmh-1">
                                    @for($i = 0; $i < 6; $i++)
                                        @include('partials.bladesora.members.skeletons.card-item', [
                                            "cardClass" => 'six-wide',
                                        ])
                                    @endfor
                                </div>
                            </content-catalogue>
                        </transition>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOPICS SECTION-->
        <div class="flex flex-column mv-3">
            <div class="flex flex-row">
                <div class="flex flex-column grow">
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        <h2 class="tw-text-[#00101D] dark:tw-text-white tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Topics</h2>
                    </div>

                    <div class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-x-4 tw-gap-y-2">
                        @foreach($topics as $topic)
                            <div class="flex flex-row">
                                <a href="{{ $topic['url'] }}"
                                   class="tw-flex tw-w-full tw-flex-col tw-items-center tw-justify-center tw-min-h-[103px] tw-p-4 font-no-underline tw-border-2 tw-border-solid tw-border-gray-200 hover:tw-bg-gray-100 dark:hover:tw-bg-[#445F74]/20 dark:tw-border-[#7E9AB1] dark:tw-bg-[#445F74]/10 tw-rounded-lg tw-transition-all"
                                >
                                    <h3 class="tw-text-2xl font-bold tw-text-[#00101D] dark:tw-text-white tw-text-center">{{ $topic['topic'] }}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($legacyPacks))
            <!-- LEGACY PACKS SECTION-->
            <div class="flex flex-row mb-3 ph-1">
                <div class="flex flex-column grow">
                    <div class="flex flex-row align-v-center pv-2">
                        <i class="fas fa-guitar-electric tw-text-guitareo tw-text-2xl mr-1"></i>

                        <a href="{{ url()->route('members.packs') }}"
                        aria-label="See All Lesson Packs Lessons"
                        class="text-black no-decoration heading capitalize grow">
                            Legacy Packs
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-row flex-wrap">
                @foreach($legacyPacks as $pack)
                    @include('members.partials._lessons-pack', [
                        'themeColor' => 'guitareo',
                        'itemThumbnail' => $pack->fetch('data.thumbnail_url'),
                        'itemTitle' => $pack->fetch('fields.title'),
                        'lessonsUrl' => $pack->fetch('url'),
                        'logoImage' => $pack->fetch('data.logo_image_url'),
                        'nextItemUrl' => $pack->fetch('next_lesson_url'),
                        'lessonsUrl' => $pack->fetch('url'),
                        'itemProgress' => $pack->fetch('progress_state'),
                    ])
                @endforeach
            </div>
        @endif
    </div>
@endsection
