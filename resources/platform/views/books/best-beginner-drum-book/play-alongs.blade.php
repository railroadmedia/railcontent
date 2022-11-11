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
    <header id="bestBookHeader" class="container fluid bb-grey-1-1 pv-5 shadow">
        <div class="container">
            <div class="flex flex-row align-v-center flex-wrap">
                <div class="flex flex-column ph xs-12 sm-8 mb-2">
                    <h1 class="heading mb-1 text-white">
                        <a href="javascript:history.back()"
                           class="no-decoration">
                            <i class="fas fa-arrow-circle-left text-light"></i>
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

    <div class="container mv-3">
        <div class="flex flex-column">
            <div class="flex flex-row nmh-1">
                <play-alongs
                    ref="playAlongsVueInstance"
                    content-endpoint="/railcontent/content"
                    theme-color="drumeo"
                    brand="drumeo"
                    :pre-loaded-content="{{ $listLessons }}"
                    user-id="{{ auth()->id() }}"
                    :show-filters="false"
                    :show-pagination="false"
                    :use-url-params="false"
                    :show-user-actions="false"
                    :track-progress="false"
                ></play-alongs>

            </div>
        </div>
    </div>
@endsection

