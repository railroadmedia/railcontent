@extends('partials.layout')

@section('meta')
    @parent

    <title>Pianote Foundations | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', ['backgroundImage' => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/header-background.jpg'])
        @slot('content')
            <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <span class="tw-text-32 tw-font-bold">The Pianote Foundations</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    Welcome to the resources page for the Pianote Foundations books. Here you’ll find extra worksheets,
                    exercises and video lessons to perfectly accompany the lessons from your book.
                </p>
                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    Simply click on the relevant book to expand it and find the resources that are perfect for your
                    practice.
                </p>

                @if(empty($hasAccess))
                    <button
                        class="btn collapse-250 mt-2"
                        data-open-modal="loginModal"
                    >
                        <span class="bg-pianote text-white">
                            <i class="fas fa-external-link mr-1"></i>
                            Login to Pianote
                        </span>
                    </button>
                @endif
            </div>
        @endslot
    @endcomponent

    @include('books.partials.login-modal')

    @include('books.partials.ask-question-modal')

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <div class="tw-flex tw-flex-row tw-flex-wrap md:tw-flex-nowrap tw-w-full pv-1 mt-1">
            <div class="tw-flex tw-flex-col tw-w-full md:tw-mr-2 tw-mb-2">
                <a
                    class="btn bg-pianote text-white"
                    href="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/All-Songs.pdf"
                    target="_blank"
                    download
                >
                    <i class="fas fa-download mr-1"></i>
                    Download All Sheet Music
                </a>
            </div>

            <div class="tw-flex tw-flex-col tw-w-full md:tw-mr-2 tw-mb-2">
                <a
                    class="btn bg-pianote text-white"
                    href="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/foundations-worksheets.pdf"
                    target="_blank"
                    download
                >
                    <i class="fas fa-download mr-1"></i>
                    Download All Worksheets
                </a>
            </div>

            <div class="tw-flex tw-flex-col tw-w-full md:tw-mr-2 tw-mb-2">
                <a
                    class="btn bg-pianote text-white"
                    href="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/foundations-answer-key.pdf"
                    target="_blank"
                    download
                >
                    <i class="fas fa-download mr-1"></i>
                    Download Answer Key
                </a>
            </div>
        </div>

        <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-5 tw-mb-8">
            @foreach($chapterThumbs as $index => $chapter)
                <div class="flex flex-column chapter-thumb pa-1">
                    <a
                        href="{{ url()->route('platform.books.resources.chapter', [($index + 1)]) }}"
                        class="book-cover bg-black corners-5 overflow"
                    >
                        <div class="thumb-hover absolute-fill heading">
                            <i class="fas fa-arrow-right absolute-center"></i>
                        </div>

                        <img
                            src="{{ $chapter }}"
                            data-ix-src="{{ $chapter }}"
                            data-ix-fade
                            alt="Foundations Chapter {{ $index }} Thumbnail"
                            class="corners-5"
                        >
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('layout-scripts')
    <script src="{{ mix('platform/js/books.js') }}"></script>
@endsection
