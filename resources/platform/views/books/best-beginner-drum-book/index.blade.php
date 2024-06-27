<?php
$layout = 'books.layout';
if (!empty($user)) {
    $layout = 'partials.layout';
} ?>

@extends($layout)

@section('meta')
    <title>The Best Beginner Drum Book | Musora</title>
@endsection

@section('inject-components')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            @if (count($errors))
                setTimeout(() => {
                    window.openModal('redeemModal')
                }, 500);
            @endif
        });
    </script>
@endsection

@section('content')
    <header id="bestBookHeader" class="container fluid pv-5 shadow">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white">
            <div class="flex flex-row align-v-center flex-wrap">
                <div class="flex flex-column ph xs-12 sm-8 mb-2">
                    <h1 class="tw-font-bold tw-text-5xl mb-1 text-white tw-font-bebas-neue">The Best Beginner Drum Book</h1>
                    <p class="body mb-2 text-white">
                        Here are some lessons and resources that were hand-picked from Drumeo because
                        they go great with The Best Beginner Drum Book material.
                        @if ($isDigital)
                            @if (!empty($user))
                                @if (!$user->isAMember() && $user->isPackOnlyOwner())
                                    <br><br>
                                    As a Best Beginner Drum Book owner, you're entitled to a free 7-day Drumeo
                                    Edge Trial Membership so that you can access all of the resources on this page.
                                    Click the Learn More button to get started.
                                @endif

                                @if (!$user->isPackOnlyOwner() && $user->isAnExpiredMember())
                                    <br><br>
                                    To access all of the resources on this page
                                    <a href="{{ url()->route('platform.profile.settings.payments', ['brand' => 'drumeo', 'userId' => $user->id]) }}"
                                        class="font-italic">
                                        renew your Drumeo Membership.
                                    </a>
                                @endif
                            @else
                                <br><br>
                                As a Best Beginner Drum Book owner you're entitled to a free 7-day Drumeo Trial
                                Membership so that you can access all of the resources on this page. Click the Learn
                                More button to check it out.
                            @endif
                        @else
                            @if (!empty($user))
                                <br><br>
                                If you have a Drumeo redemption code from your copy of the book, be sure to
                                click the green button.
                            @else
                                <br><br>
                                To access all of the resources, create your free Drumeo account by clicking the
                                Redeem button below and use the One Month Access Pass you received with your purchase.
                            @endif
                        @endif
                    </p>

                    <div class="flex flex-row flex-wrap align-v-center">
                        @if ($isDigital)
                            @if (empty($user) || !$user->isAMember())
                                <a href="/bestbook-trial" class="btn collapse-250 mr-1 mb-1 bg-success text-white">
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

                        @if (empty($user))
                            <button class="btn collapse-200 mb-1" data-open-modal="loginModal">
                                <span class="bg-white inverted text-white no-decoration short">
                                    <i class="fas fa-sign-in mr-1"></i> Login To Drumeo
                                </span>
                            </button>
                        @endif
                    </div>

                    @if (session()->has('success'))
                        <p class="body mb-2" style="color: #00c51c; margin-top: 30px;">
                            <strong>Your Drumeo Membership has been claimed successfully!</strong>
                        </p>
                    @endif
                </div>

                <div class="flex flex-column xs-12 sm-4 hide-xs-only">
                    <img id="bestBookImage"
                        src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/best-beginner-drum-book.svg.gz"
                        alt="Best Beginner Drum Book">
                </div>
            </div>
        </div>
    </header>

    @include('books.best-beginner-drum-book.partials.login-modal', [
        'redirectUrl' => $redirectUrl,
        'trialUrl' => '',
    ])

    @include('books.best-beginner-drum-book.partials.redeem-modal', [
        'formSubmitUrl' => URL::route('access-codes.form-claim'),
    ])

    <div class="container mv-3">
        <div class="flex flex-column shadow content-table">
            @foreach ($chapters as $index => $chapter)
                @include('books.best-beginner-drum-book.partials.chapter', [
                    'chapterNumber' => $index + 1,
                    'chapterTitle' => $chapter['chapterTitle'],
                    'thumbnail' => $chapter['thumbnail'],
                    'title' => $chapter['title'],
                    'description' => $chapter['description'],
                    'contentLink' => $chapter['contentLink'],
                    'hasAccess' => in_array($index, [4, 6, 7]) ? true : $hasAccess,
                ])
            @endforeach
            <div class="flex flex-row flex-wrap bt-grey-1-1 pa-1">
                <div class="flex flex-column xs-12 sm-4 pa-1">
                    <a href="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/drumeo-practice-routine-generator.pdf"
                        class="bg-drumeo corners-3 text-white pa no-decoration" target="_blank" download>
                        <p class="body font-bold uppercase dense">Practice Routine Generator</p>
                        <p class="tiny font-italic uppercase dense">PDF Download</p>
                    </a>
                </div>
                <div class="flex flex-column xs-12 sm-4 pa-1">
                    <a href="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/drumeo-notation-legend.pdf"
                        class="bg-drumeo corners-3 text-white pa no-decoration" target="_blank" download>
                        <p class="body font-bold uppercase dense">Drumeo Notation Legend</p>
                        <p class="tiny font-italic uppercase dense">PDF Download</p>
                    </a>
                </div>
                <div class="flex flex-column xs-12 sm-4 pa-1">
                    <a href="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/drumeo-cheat-sheet.pdf"
                        class="bg-drumeo corners-3 text-white pa no-decoration" target="_blank" download>
                        <p class="body font-bold uppercase dense">Drumeo Cheat Sheet</p>
                        <p class="tiny font-italic uppercase dense">PDF Download</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
