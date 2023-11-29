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
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
            <div class="flex flex-row align-v-center flex-wrap">
                <div class="flex flex-column ph xs-12 sm-8 mb-2">
                    <h1 class="heading mb-1 text-white tw-flex tw-items-center">
                        <a href="javascript:history.back()"
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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-my-3">
        <div class="flex flex-column">
            <div class="flex flex-row">

                <play-alongs
                    ref="playAlongsVueInstance"
                    content-endpoint="/railcontent/content"
                    theme-color="drumeo"
                    brand="drumeo"
                    :pre-loaded-content="{{ json_encode(json_decode($listLessons)->data) }}"
                    :total-results="{{ json_encode(json_decode($listLessons)->meta->totalResults) }}"
                    user-id="{{ auth()->id() }}"
                    :no-sidebar="true"
                    :use-url-params="false"
                    :show-user-actions="false"
                    :track-progress="false"
                ></play-alongs>

            </div>
        </div>
    </div>
@endsection

