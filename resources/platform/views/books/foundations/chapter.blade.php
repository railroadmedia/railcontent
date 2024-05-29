<?php
    $layout = 'books.layout';
    if(!empty($user)){
        $layout = 'partials.layout';
    } 
    if(empty($hasAccess)) {
        $ctas = [
            [
                'type' => 'PageHeaderPrimaryCta',
                'props' => [
                    'text' => 'Login to Musora',
                    'url' => '/login',
                    'faIconClass' => 'fa-external-link',
                    'isPrimary' => true,
                ]
            ]
        ];
    }
?>

@extends($layout)

@section('meta')
    <title>Pianote Foundations | Musora</title>
@endsection

@section('content')

    {{-- <div class="flex flex-row align-center pv-3">
        <a
            @if($chapterNumber > 1)
            href="{{ url()->route('platform.books.resources.chapter',[$chapterNumber - 1, 'brand' => 'pianote']) }}"
            @endif
            class="btn short collapse-square rounded mr-2 bg-white text-white inverted
            {{ $chapterNumber > 1 ? '' : 'disabled' }}"
        >
            <i class="fas fa-arrow-left"></i>
        </a>
        <p class="body text-white uppercase dense font-bold">
            Level {{ $chapterNumber }}
        </p>
        <a
            @if($chapterNumber < 10)
            href="{{ url()->route('platform.books.resources.chapter', [$chapterNumber + 1,  'brand' => 'pianote']) }}"
            @endif
            class="btn short collapse-square rounded ml-2 bg-white text-white inverted
            {{ $chapterNumber < 10 ? '' : 'disabled' }}"
        >
            <i class="fas fa-arrow-right"></i>
        </a>
    </div> --}}
    
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Pianote Foundations",
                    "url" => "/pianote/method/foundations-2019/215952",
                ],
                [
                    "title" => "Resources",
                    "url" => "/pianote/resources"
                ],
                [
                    "title" => "Level " . $chapterNumber
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="foundations"
            title="{{ $thisChapter['title'] }}"
            description="{{ $thisChapter['description'] }}"
            @if( !empty($ctas) )
                :ctas="{{ json_encode($ctas) }}"
            @endif
        ></page-header>
    </div>

    @include('books.partials.login-modal', ['redirectUrl' => url()->route('platform.books.resources',[
        'brand'=>'pianote'
    ])])

    @include('books.partials.ask-question-modal', [
        "level" => 'Level ' . $chapterNumber . ': ' . $thisChapter['title']
    ])

    <div class="modal" id="youtubeLessonModal">
        <div class="flex flex-column bg-black corners-3">
            <div class="widescreen">
                <iframe
                    id="youtubeLessonIframe"
                    frameborder="0"
                    modestbranding="1"
                    playsinline="1"
                    rel="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white tw-py-4">
        <div class="flex flex-column mb-3">
            <div class="flex flex-row pv-3">
                <h1 class="heading dark:tw-text-white">Free Video Lessons</h1>
            </div>
            <div class="flex flex-row">
                <div class="flex flex-column grow bb-grey-1-1 tw-border-[#445F74] mb-3">
                    @foreach($thisChapter['related_lessons'] as $relatedLesson)
                        @include('books.partials.related-content', [$relatedLesson, 'brand'=>'pianote'])
                    @endforeach
                </div>
            </div>

            <div class="flex flex-row pv-3">
                <h1 class="heading dark:tw-text-white">Pianote Foundation Lessons</h1>
            </div>
            <div class="flex flex-row">
                <div class="flex flex-column grow">
                    @foreach($foundationsLessons as $lesson)
                        @include('books.partials.foundations-lesson', [
                            "thumbnail" => $lesson->fetch('data.thumbnail_url'),
                            "title" => $lesson->fetch('fields.title'),
                            "members_url" => $lesson->fetch('url'),
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if(!empty($thisChapter['backing_tracks']))
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-8">
            <div class="flex flex-row pv-3 tw-justify-center">
                <h1 class="heading dark:tw-text-white">Backing Tracks</h1>
            </div>

            <div class="flex flex-row">
                <a
                    href="{{ $thisChapter['backing_tracks'] }}"
                    class="tw-btn-primary tw-bg-pianote hover:tw-bg-pianote-600"
                    download
                    target="_blank"
                >
                    <i class="fas fa-download mr-1"></i>
                    Download Backing Track
                </a>
            </div>
        </div>
    @endif
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/books.js') }}"></script>
@endsection
