<?php
$layout = 'books.layout';
if(!empty($user)){
    $layout = 'partials.layout';
} ?>

@extends($layout)

@section('meta')
    <meta name="author" content="Brandon Toews">
    <meta name="description" content="{{ $chapterData['description'] }}">

    <meta property="og:description" content="{{ $chapterData['description'] }}">
    <meta property="og:title" content="The Drummer's Toolbox - {{ $chapterData['title'] }}">
@endsection

@section('content')
    <header id="bestBookHeader" class="fluid pb-5 pt-2 shadow">
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">  
            <div class="flex flex-row">
                <a
                    href="{{ url()->route(
                        $isDigital ? 'books.digital.drummers-toolbox' : 'books.drummers-toolbox'
                    ) }}"
                    aria-label="Back to All"
                    class="tw-text-white no-decoration tiny uppercase pa-1"
                >
                    <i class="fas fa-arrow-left mr-1"></i> Back to All
                </a>
            </div>

            <div class="flex flex-row">
                <div class="flex flex-column">
                    <div class="flex flex-row align-center pv-3">
                            <a
                            @if($chapterNumber > 1)
                               href="{{ url()->route(
                                    $isDigital
                                        ? 'books.digital.drummers-toolbox.chapter'
                                        : 'books.drummers-toolbox.chapter',
                                    [ "chapterNumber" => $chapterNumber - 1 ]
                                ) }}"
                            @endif
                               class="btn short collapse-square rounded mr-2 bg-white text-white inverted
                                        {{ $chapterNumber > 1 ? '' : 'disabled' }}"
                            >
                                <i class="fas fa-arrow-left"></i>
                            </a>

                        <p class="body text-white uppercase">
                            Chapter {{ $chapterNumber }}
                        </p>

                            <a
                            @if($chapterNumber < 10)
                               href="{{ url()->route(
                                    $isDigital
                                        ? 'books.digital.drummers-toolbox.chapter'
                                        : 'books.drummers-toolbox.chapter',
                                    [ "chapterNumber" => $chapterNumber + 1 ]
                               ) }}"
                            @endif
                               class="btn short collapse-square rounded ml-2 bg-white text-white inverted
                                        {{ $chapterNumber < 10 ? '' : 'disabled' }}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                    </div>

                    <div class="flex flex-row align-center mb-2">
                        <h1 class="large-display uppercase text-center text-white dense">
                            {{ $chapterData['title'] }}
                        </h1>
                    </div>

                    <div class="flex flex-row align-center mb-5">
                        <div class="flex flex-column xs-12 sm-6">
                            <p class="body text-white text-center">
                                {{ $chapterData['description'] }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-row flex-wrap align-center">
                        @if($isDigital)
                            @if(empty($user) || !$user->isAMember() )
                                <a href="{{ url()->route('books.drummers-toolbox.trial') }}"
                                   class="btn collapse-250 mr-1 mb-1 bg-success text-white">
                                    Learn More
                                </a>
                            @endif
                        @else
                            <button class="btn collapse-250 mr-1 mb-1" data-open-modal="redeemModal">
                                <span class="bg-success text-white">
                                    <i class="fas fa-check-circle mr-1"></i> Redeem Drumeo Code
                                </span>
                            </button>
                        @endif

                        @if(empty($user))
                            <button class="btn collapse-200 mb-1" data-open-modal="loginModal">
                                <span class="bg-white inverted text-white no-decoration short">
                                    <i class="fas fa-sign-in mr-1"></i> Login To Drumeo
                                </span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    @include('books.the-drummers-toolbox.partials.login-modal', [
        "redirectUrl" => url()->current(),
        "trialUrl" => url()->route('books.drummers-toolbox.trial'),
        "bookTitle" => "Drummer's Toolbox",
    ])

    @include('books.the-drummers-toolbox.partials.redeem-modal', ['formSubmitUrl' => url()->route('access-codes.form-claim')])

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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <div class="tw-w-full flex flex-column corners-3 shadow mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading">Related Lessons</h1>
            </div>

            <div class="flex flex-row">
                <div class="flex flex-column grow">
                      @foreach($relatedLessons as $relatedLesson)
                        @include('books.partials.related-content', ['relatedLesson' => [
                            "thumbnail" => $relatedLesson['data']->fetch('data.thumbnail_url',''),
                            "title" => $relatedLesson['data']->fetch('fields.title',''),
                            "youtube_id" => $relatedLesson['youtube_id'] ?? null,
                            "members_url" => $relatedLesson['data']->fetch('url',''),
                            "content_id" => $relatedLesson['data']->fetch('id'),
                            "brand" => "drumeo"
                            ]
                        ])
                    @endforeach
                </div>
            </div>
        </div>

        <div class="tw-w-full flex flex-column corners-3 shadow mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading">Play-Alongs</h1>
            </div>
            <?php //dd($playAlongs); ?>
            
            <div class="tw-w-full flex flex-row"> 
                <play-alongs
                    content-endpoint="/railcontent/content"
                    theme-color="drumeo"
                    brand="drumeo"
                    :pre-loaded-content="{{ $playAlongs }}"
                    user-id="{{ auth()->id() }}"
                    :no-sidebar="true"
                    :show-filters="false"
                    :show-pagination="false"
                    :use-url-params="false"
                    :show-user-actions="false"
                    :track-progress="false"
                ></play-alongs>
            </div>
        </div>

        @if(!empty($chapterData['loops']))
        <div class="flex flex-column corners-3 shadow mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading">Loops</h1>
            </div>

            <div class="flex flex-row">
                <legacy-loops
                    :loops="{{ json_encode($chapterData['loops']) }}"></legacy-loops>
            </div>
        </div>
        @endif

        <div class="flex flex-column corners-3 shadow mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading">Recommended Listening Playlists</h1>
            </div>
            <div class="flex flex-row">
                <div class="flex flex-column">
                    @foreach($chapterData['playlists'] as $title => $playlist)
                        @include('books.the-drummers-toolbox.partials.listening-playlist', [
                            "thumbnail" => "https://placehold.it/1920x1080",
                            "title" => $title,
                            "spotify_url" => $playlist['spotify_url'],
                            "youtube_url" => $playlist['youtube_url'],
                            "apple_url" => $playlist['apple_url'],
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if(empty($user) || (!empty($user) && !$user->isAMember() && $user->isPackOnlyOwner()))
        <div class="container fluid bg-grey-2 pt-3 relative">
            <div class="container">
                <div class="flex flex-row align-v-center flex-wrap">
                    <div class="flex flex-column ph xs-12 sm-8 mb-2">
                        <h1 class="heading mb-1">Redeem Your Free Month!</h1>
                        <p class="body mb-2">
                            @if($isDigital)
                                @if(!empty($user))
                                    @if(!$user->isAMember() && $user->isPackOnlyOwner())
                                        <br><br>
                                        To access all of the Drumeo resources, simply create your free Drumeo
                                        account by clicking the “Redeem” button below. You can find your redemption code
                                        at the top of the One Month Access Pass that you received with your copy of the book.
                                    @endif
                                @else
                                    <br><br>
                                    As an owner of The Drummer’s Toolbox, we’re granting you free access to Drumeo
                                    Edge for 30 days so you can access all of the resources on this page. Click the
                                    “Learn More” button below to get started!
                                @endif
                            @else
                                @if(!empty($user))
                                    If you have a Drumeo Access Pass with a redemption code from your copy of
                                    the book, be sure to click the green button.
                                @else
                                    <br><br>
                                    To access all of the Drumeo resources, simply create your free Drumeo
                                    Edge account by clicking the “Redeem” button below. You can find your
                                    redemption code at the top of the One Month Access Pass that you received
                                    with your copy of the book.
                                @endif
                            @endif
                        </p>

                        <div class="flex flex-row flex-wrap align-v-center">
                            @if($isDigital)
                                @if(empty($user) || !$user->isAMember())
                                    <a href="{{ url()->route('books.drummers-toolbox.trial') }}"
                                       class="btn collapse-250 mr-1 mb-1 bg-success text-white">
                                        Learn More
                                    </a>
                                @endif
                            @else
                                <button class="btn collapse-250 mr-1 mb-1" data-open-modal="redeemModal">
                                    <span class="bg-success text-white">
                                        <i class="fas fa-check-circle mr-1"></i> Redeem Drumeo Code
                                    </span>
                                </button>
                            @endif

                            @if(empty($user))
                                <button class="btn collapse-200 mb-1" data-open-modal="loginModal">
                                        <span class="bg-black inverted text-black no-decoration short">
                                            <i class="fas fa-sign-in mr-1"></i> Login To Drumeo
                                        </span>
                                </button>
                            @endif
                        </div>

                        @if(session()->has('message'))
                            <p class="body mb-2" style="color: #00c51c; margin-top: 30px;">
                                <strong>{{ session()->get('message') }}</strong>
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-column xs-12 sm-4 hide-xs-only">
                        <img id="bestBookImage"
                             src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/drummers-toolbox.png"
                             alt="Drummer's Toolbox"
                             class="relative"
                             style="margin-bottom:-30px;z-index:96;">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('inject-components')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var changeFormButtons = document.querySelectorAll('.change-form');
            var redemptionForms = document.querySelectorAll('.redemption-form');
            const youtubeLessonModal = document.getElementById('youtubeLessonModal');
            const youtubeLessonIframe = document.getElementById('youtubeLessonIframe');

            Array.from(changeFormButtons).forEach(button => {
                button.addEventListener('click', toggleForms);
            });

            function toggleForms(event) {
                var thisButton = event.target;
                var formToToggleTo = document.getElementById(thisButton.dataset['form']);

                Array.from(redemptionForms).forEach(form => {
                    form.classList.add('hide');
                });

                Array.from(changeFormButtons).forEach(button => {
                    button.classList.remove('active', 'font-bold');
                });

                thisButton.classList.add('active', 'font-bold');
                formToToggleTo.classList.remove('hide');
            }

            youtubeLessonModal.addEventListener('modalOpen', (event) => {
                const buttonClicked = event.detail.trigger;
                const youtubeId = buttonClicked.dataset['youtubeId'];

                youtubeLessonIframe.src = `https://www.youtube.com/embed/${youtubeId}`;
            });

            window.addEventListener('modalClose', () => {
                youtubeLessonIframe.src = '';
            });
        });
    </script>
@endsection

