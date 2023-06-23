<?php
$layout = 'books.layout';
if(!empty($user)){
    $layout = 'partials.layout';
} ?>

@extends($layout)

@section('meta')
    <title>The Drummer's Toolbox | Musora</title>
    <meta name="author" content="Brandon Toews">
    <meta name="description" content="Here you will find all the digital resources that pair with the material in
        The Drummer’s Toolbox. These including pre-built Recommended Listening playlists, drumless play-along
        tracks, and tons of Drumeo resources.">

{{--    <meta property="og:image" content="{{ cdn('books/drummers-toolbox/share-image.png') }}">--}}
    <meta property="og:description" content="Here you will find all the digital resources that pair with the material
        in The Drummer’s Toolbox. These including pre-built Recommended Listening playlists, drumless play-along
        tracks, and tons of Drumeo resources.">
    <meta property="og:title" content="The Drummer's Toolbox">
@endsection

@section('inject-components')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var changeFormButtons = document.querySelectorAll('.change-form');
            var redemptionForms = document.querySelectorAll('.redemption-form');

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

            @if(count($errors))
                window.openModal('redeemModal')
            @endif
        });
    </script>
@endsection

@section('content')
    <header id="bestBookHeader" class="fluid pv-5 shadow">
        <div class="tw-w-full tw-container tw-mx-auto tw-pt-4 md:tw-pt-0 tw-px-4 md:tw-px-8">
            <div class="flex flex-row align-v-center flex-wrap">
                <div class="flex flex-column ph xs-12 sm-8 mb-2">
                    <h1 class="tw-font-bold tw-text-5xl mb-1 text-white tw-font-bebas-neue">The Drummer's Toolbox</h1>
                    <p class="body mb-2 text-white">
                        Here you will find all the digital resources that pair with the material in The Drummer’s
                        Toolbox. These include pre-built Recommended Listening playlists, drumless play-along
                        tracks, and tons of Drumeo resources.

                        @if($isDigital)
                            @if(!empty($user))
                                @if(!$isEdge && $isPackOwner)
                                    <br><br>
                                    As an owner of The Drummer’s Toolbox, we’re granting you free access to Drumeo
                                    Edge for 30 days so you can access all of the resources on this page. Click the
                                    “Learn More” button below to get started!
                                @endif
                            @else
                                <br><br>
                                As an owner of The Drummer’s Toolbox, we’re granting you free access to Drumeo
                                Edge for 30 days so you can access all of the resources on this page. Click the
                                “Learn More” button below to get started!
                            @endif
                        @else
                            @if(!empty($user))
                                <br><br>
                                If you have a Drumeo Access Pass with a redemption code from your copy of the
                                book, be sure to click the green button.
                            @else
                                <br><br>
                                To access all of the resources, create your free Drumeo account by clicking the
                                Redeem button below and use the One Month Access Pass you received with your purchase.
                            @endif
                        @endif
                    </p>

                    <div class="flex flex-row flex-wrap align-v-center">
                        @if($isDigital)
                            @if(empty($user) || !$isEdge)
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

                    @if(session()->has('success'))
                        <p class="body mb-2" style="color: #00c51c; margin-top: 30px;">
                            <strong>Your Drumeo Membership has been claimed successfully!</strong>
                        </p>
                    @endif
                </div>

                <div class="flex flex-column xs-12 sm-4 hide-xs-only">
                    <img id="bestBookImage"
                         src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/drummers-toolbox.png"
                         alt="Drummer's Toolbox">
                </div>
            </div>
        </div>
    </header>

    @include('books.the-drummers-toolbox.partials.login-modal', ['redirectUrl' => url()->current(), "trialUrl" => url()->route('books.drummers-toolbox.trial')])

    @include('books.the-drummers-toolbox.partials.redeem-modal', ['formSubmitUrl' => url()->route('access-codes.form-claim')])

    <section class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 4xl:tw-grid-cols-6 tw-mb-8">
            @foreach($chapters as $index => $chapter)
                    <div class="flex flex-column chapter-thumb pa-1">
                    <a
                        href="{{ url()->route(
                            $isDigital ? 'books.digital.drummers-toolbox.chapter' : 'books.drummers-toolbox.chapter',
                            [ "chapterNumber" => $chapter['chapter'] ]
                        ) }}"
                        class="square corners-3 bg-center"
                        style="background-image:url({{ $chapter['thumbnail'] }});"
                    >
                        <div class="absolute-center flex-center">
                            <h5 class="body font-bold dense text-white text-center font-compressed uppercase">
                                Chapter {{ $chapter['chapter'] }}
                            </h5>
                            <h4 class="subheading text-white text-center font-compressed uppercase">
                                {{ $chapter['title'] }}
                            </h4>
                        </div>
                        <span class="card-gradient"></span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection

