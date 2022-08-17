@extends('partials.layout')

@section('meta')
    <title>Pianote Foundations | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', ['backgroundImage' => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/header-background.jpg'])
        @slot('content')
            <div class="container relative">
                <div class="flex flex-row">
                    <a
                        href="{{ url()->route('books.resources') }}"
                        aria-label="Back to All"
                        class="text-white no-decoration tiny uppercase pa-1"
                    >
                        <i class="fas fa-arrow-left mr-1"></i> Back to All
                    </a>
                </div>

                <div class="flex flex-row align-center pv-3">
                    <a
                        @if($chapterNumber > 1)
                        href="{{ url()->route('books.resources.chapter',[$chapterNumber - 1]) }}"
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
                        href="{{ url()->route('books.resources.chapter', [$chapterNumber + 1]) }}"
                        @endif
                        class="btn short collapse-square rounded ml-2 bg-white text-white inverted
                        {{ $chapterNumber < 10 ? '' : 'disabled' }}"
                    >
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="flex flex-row align-center">
                    <div class="flex flex-column xs-12 sm-7 md-6">
                        <h1 class="large-display text-white text-center mb-1">
                            {{ $thisChapter['title'] }}
                        </h1>
                        <p class="text-white text-center body">
                            {{ $thisChapter['description'] }}
                        </p>
                        @if(empty($hasAccess))
                            <div class="flex flex-row align-center">
                                <button
                                    class="btn collapse-250 mt-2"
                                    data-open-modal="loginModal"
                                >
                                    <span class="bg-pianote text-white">
                                        <i class="fas fa-external-link mr-1"></i>
                                        Login to Pianote
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent

    @include('books.partials.login-modal')

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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white mv-3">
        <div class="flex flex-column mb-3">
            <div class="flex flex-row pv-3">
                <h1 class="heading dark:tw-text-white">Free Video Lessons</h1>
            </div>
            <div class="flex flex-row">
                <div class="flex flex-column grow bb-grey-1-1 mb-3">
                    @foreach($thisChapter['related_lessons'] as $relatedLesson)
                        @include('books.partials.related-content', [$relatedLesson])
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
        <div class="container mb-3">
            <div class="flex flex-row pv-3">
                <h1 class="heading dark:tw-text-white">Backing Tracks</h1>
            </div>

            <div class="flex flex-row">
                <a
                    href="{{ $thisChapter['backing_tracks'] }}"
                    class="btn text-white bg-pianote"
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

@section('layout-scripts')
    <script src="{{ mix('assets/members/js/books.js') }}"></script>
@endsection