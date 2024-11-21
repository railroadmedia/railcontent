<?php
$layout = 'books.layout';
if(!empty($user)){
    $layout = 'partials.layout';
} ?>

@extends($layout)

@section('meta')
    <title>The Best Beginner Drum Book - Play Alongs | Musora</title>
@endsection

@section('content')
    <header id="bestBookHeader" class="fluid pv-5 shadow">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white">
            <div class="flex flex-row align-v-center flex-wrap">
                <div class="flex flex-column ph xs-12 sm-8 mb-2">
                    <h1 class="heading mb-1 text-white tw-flex tw-items-center">
                        <a href="/drumeo/bestbook"
                           class="no-decoration tw-flex tw-items-center tw-mr-1">
                            <i class="fas fa-arrow-circle-left text-light tw-text-2xl"></i>
                        </a>
                        Play-Alongs
                    </h1>
                    <p class="body mb-2 text-white">
                        Here you’ll find ten play-along tracks that go with each style of music you’ve learned in
                        The Best Beginner Drum Book. You can turn the drums or metronome on and off and even loop
                        individual parts of the song to make practicing easier.
                    </p>
                </div>

                <div class="flex flex-column xs-12 sm-4 hide-xs-only">
                    <img id="bestBookImage"
                         src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/best-beginner-drum-book.svg.gz"
                         alt="Best Beginner Drum Book">
                </div>
            </div>
        </div>
    </header>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white tw-my-3">
        <div class="flex flex-column">
            <div class="flex flex-row">
                <play-alongs
                    ref="playAlongsVueInstance"
                    content-endpoint="/railcontent/content"
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    :pre-loaded-content="{{ $listLessons }}"
                    :session-token="{{ json_encode(railtracker_session_token()) }}"
                    :total-results="{{ json_encode(json_decode($listLessons)->meta->totalResults) }}"
                ></play-alongs>

            </div>
        </div>
    </div>
@endsection

