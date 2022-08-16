@extends('books.layout')

@section('meta')
    @parent

    <title>Pianote Foundations</title>
@endsection

@section('content')
    <div
        class="container fluid collapsed-h pv-5 relative bg-black bg-center"
        style="background-image:url({{_imgix(
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/header-background.jpg',
            ["q" => 80, "blur" => 40, "w" => 640]
        )}});"
        data-ix-bg="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/header-background.jpg"
    >
        <div class="header-gradient-overlay absolute-fill pianote"></div>
        <div class="container relative">
            <div class="flex flex-row align-v-center" style="min-height:400px;">
                <div class="flex flex-column xs-12 sm-7 md-6">
                    <h1 class="heading text-white">
                        The Pianote Foundations
                    </h1>

                    <p class="text-white body">
                        Welcome to the resources page for the Pianote Foundations books. Here you’ll find extra worksheets,
                        exercises and video lessons to perfectly accompany the lessons from your book.
                        <br>
                        <br>
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
            </div>
        </div>
    </div>

    @include('books.partials.login-modal')

    @include('books.partials.ask-question-modal')

    <div class="container">
        <div class="flex flex-row flex-wrap nmh-1 pv-1 mt-1">
            <div class="flex flex-column pr-1 xs-12 sm-4 mb-1 m-xs-only">
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

            <div class="flex flex-column pr-1 xs-12 sm-4 mb-1 m-xs-only">
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

            <div class="flex flex-column pr-1 xs-12 sm-4 mb-1 m-xs-only">
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

        <div class="flex flex-row flex-wrap align-center nmh-1 mb-1">
            @foreach($chapterThumbs as $index => $chapter)
                <div class="flex flex-column chapter-thumb pa-1">
                    <a
                        href="{{ url()->route('books.resources.chapter', [($index + 1)]) }}"
                        class="book-cover bg-black corners-5 overflow"
                    >
                        <div class="thumb-hover absolute-fill heading">
                            <i class="fas fa-arrow-right absolute-center"></i>
                        </div>

                        <img
                            src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
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