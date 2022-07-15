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

    <!-- PACKS SECTION-->
    <div class="container mv-3">
        <div class="flex flex-row mb-3 ph-1">
            <div class="flex flex-column grow">
                <div class="flex flex-row align-v-center pv-2">
                    <i class="fas fa-guitar-electric tw-text-guitareo tw-text-2xl mr-1"></i>

                    <a href="{{ url()->route('platform.packs') }}"
                       aria-label="See All Lesson Packs Lessons"
                       class="text-black no-decoration heading capitalize grow">
                        Lesson Packs
                    </a>
                </div>
            </div>
        </div>

        @include('partials.content._guitar-quest-pack', [
            'itemThumbnail' => 'https://cdn.musora.com/image/fetch/w_2500,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background.jpg',
            'logoImage' => $guitarQuestPack->fetch('data.logo_image_url'),
            'nextItemUrl' => $guitarQuestPack->fetch('next_lesson_url'),
            'lessonsUrl' => $guitarQuestPack->fetch('url'),
            'itemProgress' => $guitarQuestPack->fetch('progress_state'),
        ])
    </div>

    <div class="container mb-3">
        <div class="flex flex-row flex-wrap bg-white corners-10">
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
    </div>

    <div class="container">
        <div class="flex flex-column bg-white corners-10 mv-3 ph-1">
            <!-- COURSES SECTION-->
            <div class="flex flex-row mb-3">
                <div class="flex flex-column grow">
                    <div class="flex flex-row align-v-center pv-2">
                        <i class="fas icon-courses tw-text-guitareo tw-text-2xl mr-1"></i>

                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'course']) }}"
                           aria-label="See All Courses Lessons"
                           class="text-black no-decoration heading capitalize grow">
                            Courses
                        </a>

                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'course']) }}"
                            aria-label="See All Courses Lessons"
                            class="tw-text-guitareo tiny no-decoration nowrap raised-hover pa-1 dense font-bold uppercase corners-10">
                            See All
                        </a>
                    </div>

                    <div class="flex flex-row six-cards-row">
                        <transition appear name="fade">
                            <content-catalogue
                                brand="guitareo"
                                theme-color="guitareo"
                                :use-theme-color="true"
                                content-endpoint="/laravel/public/railcontent/content"
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
                    <div class="flex flex-row align-v-center pv-2">
                        <svg width="28" height="28" class="mr-1" aria-hidden="true" focusable="false">
                            <use xlink:href="#quick-tips-guitareo"></use>
                        </svg>

                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'quick-tips']) }}"
                           aria-label="See All Courses Lessons"
                           class="text-black no-decoration heading capitalize grow">
                            Quick Tips
                        </a>

                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => 'quick-tips']) }}"
                            aria-label="See All Courses Lessons"
                            class="tw-text-guitareo tiny no-decoration nowrap raised-hover pa-1 dense font-bold uppercase corners-10">
                            See All
                        </a>
                    </div>

                    <div class="flex flex-row six-cards-row">
                        <transition appear name="fade">
                            <content-catalogue
                                brand="guitareo"
                                theme-color="guitareo"
                                :use-theme-color="true"
                                content-endpoint="/laravel/public/railcontent/content"
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
    </div>

    <!-- TOPICS SECTION-->
    <div class="container">
        <div class="flex flex-column bg-white corners-10 mv-3">
            <div class="flex flex-row">
                <div class="flex flex-column grow">
                    <div class="flex flex-row align-v-center pv-2 ph-1">
                        <svg width="28" height="28" class="mr-1" aria-hidden="true" focusable="false">
                            <use xlink:href="#quick-tips-guitareo"></use>
                        </svg>

                        <span class="text-black no-decoration heading capitalize grow">Topics</span>
                    </div>

                    <div class="flex flex-row flex-wrap">
                        @foreach($topics as $topic)
                            <div class="lessons-topics-card flex flex-row">
                                <a
                                    href="{{ $topic['url'] }}"
                                    class="flex flex-column align-h-center ma-1 pv-3 font-no-underline tw-border-3 tw-border-solid tw-border-gray-100 tw-rounded-lg tw-transition-all hover:tw-bg-gray-100"
                                ><h3 class="title font-bold text-black">{{ $topic['topic'] }}</h3></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($legacyPacks))
    <!-- LEGACY PACKS SECTION-->
    <div class="container mv-3">
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

        <div class="flex flex-row flex-wrap bg-white corners-10">
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
    </div>
    @endif
@endsection
