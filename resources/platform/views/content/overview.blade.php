@extends('partials.layout')

@section('meta')
    <title>{{ $parentContent->fetch('fields.title') }} | Musora</title>
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

{{-- Learning Path JS --}}
@section('layout-scripts')
    @if($parentContent->fetch('type') === 'learning-path' || $parentContent['type'] === 'learning-path-level')
        <script src="{{ mix('platform/js/learning-path-preview.js') }}"></script>
        {{-- Typeform Embed --}}
        <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
    @endif
@endsection

{{-- Content --}}
@section('content')

    @include('content.breadcrumbs._overview-breadcrumbs')

    @if($parentContent->fetch('type') === 'learning-path')
        @include('partials._learning-path', ['learningPathSlug' => $parentContent->fetch('slug')])
    @else        
        {{-- Overview Headers --}}
        @if($parentContent->fetch('type') === 'pack-bundle')
            @include('partials.content.overview-headers._pack-bundle')
        @elseif($parentContent->fetch('type') === 'learning-path-level')
            @include('partials.content.overview-headers._learning-path-level')
        @elseif($parentContent->fetch('type') === 'learning-path-course')
            @include('partials.content.overview-headers._learning-path-course')
        @else
            @include('partials.content.overview-headers._default')
        @endif

        {{-- Level SubHeader --}}
        @include('partials.bladesora.members.content.content-info-subheader', [
            "brand" => $brand,
            "infoData" => $infoData,
            "contentId" => $parentContent->fetch('id'),
            "contentType" => $parentContent->fetch('type'),
            "resetProgress" => $parentContent->fetch('progress_state', false) !== false,
            "instructorInfo" => false,
            "addToList" => !in_array($parentContent->fetch('type'), ['learning-path', 'pack-bundle']),
            "downloadableResources" => $parentContent['resources'] ?? [],
            "isAdded" => $parentContent->fetch('is_added_to_primary_playlist')
        ])
    @endif

    {{-- New Method Path? --}}
    @if( !empty($classicalMethodPack) && $classicalMethodPack['published_on'] < \Carbon\Carbon::now() ) {{-- Check for Branch Path Content --}}
        <div class="tw-text-white tw-flex tw-bg-[#232323] dark:tw-bg-[#000C17]">
            <div class="container mv-3 tw-flex tw-items-center tw-flex-col lg:tw-flex-row">
                <div class="lg:tw-mr-12 tw-flex-col tw-flex tw-items-center lg:tw-items-start">
                    {{-- Label --}}
                    <div class="tw-font-roboto-condensed tw-font-bold tw-leading-none tw-w-fit tw-mb-2 tw-text-sm tw-uppercase tw-text-white tw-bg-{{ $brand }} tw-p-1 tw-rounded"
                        style="width: fit-content;"
                    >
                        New Method Path
                    </div>
                    {{-- Content --}}
                    <h3 class="tw-mb-2 tw-font-bold tw-text-2xl">
                        Classical Piano Method Available Now!
                    </h3>
                    <p class="tw-text-base tw-text-center lg:tw-text-left">
                        If you would like to explore the world of Classical Piano, the Classical Method is an excellent introduction to a range of classical styles, techniques, and theories.
                    </p>
                </div>
                <div class="tw-flex-shrink-0">
                    {{-- Scroll to Section --}}
                    <a href="#branch-paths" class="tw-uppercase tw-text-white tw-font-bold tw-text-sm tw-no-underline tw-font-roboto-condensed tw-block tw-mt-4">
                        Start Learning Now
                        <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.0834 5.83764L6.00008 9.92097L1.91675 5.83764M10.0834 1.17098L6.00008 5.25431L1.91675 1.17097" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Content Progress --}}
    <div class="tw-w-full fluid tw-bg-{{ $brand }}" >
        @include('partials.bladesora.members.content.content-progress', [
            "themeColor" => $brand,
            "brand" => $brand,
            "contentType" => $parentContent->fetch('type'),
            "labelText" => $progressLabelText ?? null,
            "progress" => $parentContent->fetch('progress_percent'),
            "nextLessonUrl" => $nextLessonUrl,
            "backButton" => $backButton,
            "compact" => $parentContent->fetch('type') === 'pack-bundle' && $pack->fetch('bundle_count') <= 1,
            "xpAmount" =>  $parentContent->fetch('total_xp') ?? null,
            "isCompleted" => $parentContent->fetch('completed', false),
            "isStarted" => $parentContent->fetch('started', false),
        ])
    </div>

    @if(!empty($nextLessonJson))
        @include('partials._current-learning-path-lesson', [
            "currentLearningPathLesson" => $nextLessonJson,
        ])
    @endif

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-4">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-w-full tw-flex-row">

                <transition appear name="fade">
                    <content-catalogue
                        brand="{{ $brand }}"
                        @if(!empty($pack) && $pack['slug'] == '500-songs-in-5-days')
                        catalogue-type="grid"
                        @else
                        catalogue-type="list"
                        @endif
                        theme-color="{{ $brand }}"
                        user-id="{{ user()->id }}"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $childContent }}"
                        :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"
                        {{-- :is-admin="{{ json_encode(user()->isAdmin()) }}" --}}
                        @if($displayItemAsOverview ?? false)
                            :display-items-as-overview="true"
                            :lock-unowned="true"
                        @endif
                        @if($parentContent['type'] !== 'learning-path')
                            :show-numbers="true"
                            :force-wide-thumbs="false"
                        @endif
                        {{-- New learning Paths? --}}
                        @if(!empty($classicalMethodPackJson)) {{-- Check for Branch Path Content --}}
                            :branch-path-index="4" {{-- Where does the branched content begin? (0 based) --}}
                            :branch-path-content="{{ $classicalMethodPackJson }}"
                        @endif
                    >
                        @for($i = 0; $i < 10; $i++)
                            @include('partials.bladesora.members.skeletons.list-item', [
                                "overview" => $parentContent['type'] === 'learning-path' || $parentContent['type'] === 'learning-path-level',
                                "showNumbers" => $parentContent['type'] !== 'learning-path',
                                "thumbnailType" => $parentContent['type'] === 'learning-path' ? 'square' : 'widescreen'
                            ])
                        @endfor
                    </content-catalogue>
                </transition>
            </div>

            @if($xpBonus > 0 && (empty($pack) || $pack['slug'] !== '500-songs-in-5-days'))
                @include('partials.bladesora.members.partials._completion-bonus', [
                    "xpBonus" => $xpBonus,
                    "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                    "themeColor" => $brand
                ])
            @endif

            {{-- Pianote Foundations --}}
            @if($parentContent['slug'] == 'pianote-method')
                <a href="/pianote/method/foundations-2019/215952"
                class="flex flex-row no-decoration hover-bg-grey-7 dark:hover:tw-bg-[#002039] tw-relative text-grey-3 hover-text-black content-overview pv-2">

                    <div class="flex flex-column">
                        <p class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-mt-[5px]">Pianote Foundations</p>
                    </div>

                    <div class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-flex tw-flex-col tw-justify-center tw-text-center hide-sm-down tw-mr-2">
                        10 Levels
                    </div>

                    <div class="flex flex-column icon-col align-v-center hide-xs-only">
                        <div class="body">
                            <i class="fas flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D] rounded fa-play-circle"></i>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </div>

    {{-- for guitareo 500 songs special page --}}
    @if(!empty($songsPdfs))
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3">
            <div class="flex flex-column">
                <div class="flex flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]">
                    <content-catalogue
                            catalogue-type="downloads"
                            theme-color="guitareo"
                            brand="guitareo"
                            :use-theme-color="true"
                            sort-override="slug"
                            :included-types="['song-pdf']"
                            :filterable-values="['artist', 'style']"
                            :pre-loaded-content="{{ $songsPdfs }}"
                            user-id="{{ auth()->id() }}"
                            :infinite-scroll="true"
                    ></content-catalogue>
                </div>
            </div>
        </div>
    @endif

@endsection