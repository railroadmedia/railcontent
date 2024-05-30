<?php
$layout = 'books.layout';

if(!empty($user)) {
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
    @parent

    <title>Pianote Foundations | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Pianote Foundations",
                    "url" => "/pianote/method/foundations-2019/215952",
                ],
                [
                    "title" => "Resources",
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="foundations"
            title="Pianote Foundations"
            description="Welcome to the resources page for the Pianote Foundations books. Here you’ll find extra worksheets, exercises and video lessons to perfectly accompany the lessons from your book. Simply click on the relevant book to expand it and find the resources that are perfect for your practice."
            @if( !empty($ctas) )
                :ctas="{{ json_encode($ctas) }}"
            @endif
        ></page-header>
    </div>

    @include('books.partials.ask-question-modal')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white">
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

        <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 4xl:tw-grid-cols-6 tw-mb-8">
            @foreach($chapterThumbs as $index => $chapter)
                <div class="flex flex-column chapter-thumb pa-1">
                    <a
                        href="{{ url()->route('platform.books.resources.chapter', [($index + 1), 'brand' => 'pianote']) }}"
                        class="book-cover bg-grey-2 dark:tw-bg-[#081825] tw-rounded-xl tw-overflow-hidden tw-group"
                    >

                        <img
                            src="{{ $chapter }}"
                            alt="Foundations Chapter {{ $index }} Thumbnail"
                            class="corners-5 tw-transition-opacity tw-opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        >

                        <div class="tw-bg-black/40 absolute-fill heading tw-transition tw-text-white tw-opacity-0 group-hover:tw-opacity-100">
                            <i class="fas fa-arrow-right absolute-center"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/books.js') }}"></script>
@endsection
