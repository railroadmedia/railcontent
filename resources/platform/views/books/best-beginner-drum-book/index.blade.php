@extends('partials.layout', [
    "pageTitle" => "The Best Beginner Drum Book",
])

@section('styles')
    <style>
        .change-form.active {
            color: #0B76DB;
            padding-bottom:1px;
            border-bottom:1px solid #0B76DB;
        }

        .change-form > * {
            pointer-events: none;
        }

        @if(empty($user))
            #nav .menu {
                background-color:#0b76db!important;
            }
        @endif
    </style>
@endsection

@section('scripts')
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
        });
    </script>
@endsection

@section('content')
    <header id="bestBookHeader" class="container fluid bb-grey-1-1 pv-5 shadow">
        <div class="container">
            <div class="flex flex-row align-v-center flex-wrap">
                <div class="flex flex-column ph xs-12 sm-8 mb-2">
                    <h1 class="heading mb-1 text-white">The Best Beginner Drum Book</h1>
                    <p class="body mb-2 text-white">
                        Here are some lessons and resources that were hand-picked from Drumeo because
                        they go great with The Best Beginner Drum Book material.
                        @if($isDigital)
                            @if(!empty($user))
                                @if(!App\Services\User\UserAccessService::isEdge($user->getId()) && App\Services\User\UserAccessService::isPackOwner($user->getId()))
                                    <br><br>
                                    As a Best Beginner Drum Book owner, you're entitled to a free 7-day Drumeo
                                    Edge Trial Membership so that you can access all of the resources on this page.
                                    Click the Learn More button to get started.
                                @endif

                                @if(!App\Services\User\UserAccessService::isPackOwner($user->getId()) && $user->edgeExpired())
                                    <br><br>
                                    To access all of the resources on this page
                                    <a href="{{ url()->route('members-area.profile.account.primary-payment-method') }}"
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
                            @if(!empty($user))
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
                        @if($isDigital)
                            @if(empty($user) || !App\Services\User\UserAccessService::isEdge($user->getId()))
                                <a href="/bestbook-trial"
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
                         src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/best-beginner-drum-book.svg.gz"
                         alt="Best Beginner Drum Book">
                </div>
            </div>
        </div>
    </header>

    <div id="loginModal" class="modal">
        <div class="flex flex-column bg-white corners-3 pa-3">
            <h2 class="subheading mb-3">Login To Drumeo</h2>

            <div class="flex flex-row">
                <div class="flex flex-column mb-1">
                    <p class="tiny text-black mb-1">
                        To access some of the resources on this page you must be logged in to Drumeo.
                        @if($isDigital)
                            As a Best Beginner Drum Book Owner, you’re entitled to a FREE 7-Day Trial Membership.
                            <a href="/bestbook-trial" class="font-bold text-black pointer">
                                Click here to learn more.
                            </a>
                        @else
                            If you do not have your Drumeo account set up yet,
                            <span class="font-bold bb-black-1 pointer"
                                    data-open-modal="redeemModal">click here to redeem</span>
                            your free One Month Drumeo Access Pass that came with your copy of The Best Beginner
                            Drum Book.
                        @endif
                    </p>

                    <p class="tiny text-black mb-1">
                        Or login with an existing account below.
                    </p>
{{--                    @if($isDigital)--}}
{{--                        $redirect ={{url()->route('user_management_system.login.cookie') }}?redirect_to={{url()->route('books.best-beginner-drum-book-digital') }};--}}
{{--                    @else--}}
{{--                        $redirect ={{url()->route('user_management_system.login.cookie') }}?redirect_to={{url()->route('books.best-beginner-drum-book') }};--}}
{{--                    @endif--}}
{{--                    <login-form--}}
{{--                        brand="drumeo"--}}
{{--                        loginurl="{{ url()->route('user_management_system.login.cookie', (['redirect_to' => url()->route('books.best-beginner-drum-book')])) }}"--}}
{{--                        reseturl="{{ url()->route('user_management_system.password.send-reset-email', (!empty($redirect) ? ['redirect_to' => $redirect] : [])) }}"--}}
{{--                        joinurl="{{url('/#orderNow')}}"--}}
{{--                        :errors="{{json_encode($errors->all())}}"--}}
{{--                        hassessionstatus="{{session()->has('status')}}"--}}
{{--                        sessionstatus="{{ session()->get('status') }}"--}}
{{--                        :usecsrftoken="!!({{$useCsrfToken ?? true}})"--}}
{{--                    >--}}
{{--                        <template v-slot:csrf>{{ csrf_field() }}</template>--}}
{{--                    </login-form>--}}
                    <form method="POST"
                            @if($isDigital)
                                action="{{url()->route('user_management_system.login.cookie') }}?redirect_to={{url()->route('books.best-beginner-drum-book-digital') }}"
                            @else
                                action="{{url()->route('user_management_system.login.cookie') }}?redirect_to={{url()->route('books.best-beginner-drum-book') }}"
                            @endif >

                        {{ csrf_field() }}

                        <input type="hidden" name="context" value="best-book">

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "text",
                                "inputId" => "email",
                                "inputName" => "email",
                                "inputLabel" => "Email Address...",
                                "inputValue" => old('log'),
                                "inputErrors" => $errors->get('log'),
                            ])
                        </div>

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "password",
                                "inputId" => "password",
                                "inputName" => "password",
                                "inputLabel" => "Password...",
                                "inputValue" => old('pwd'),
                                "inputErrors" => $errors->get('pwd'),
                            ])
                        </div>

                        <div class="flex flex-column">
                            <button class="btn big-text" type="submit">
                                <span class="bg-drumeo text-white">
                                    Login
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="redeemModal" class="modal">
        <div class="flex flex-column bg-white corners-3 pa-3">
            <h2 class="subheading mb-3">Redeem Your Drumeo Access Pass</h2>

            <div class="flex flex-row flex-wrap">
                <p class="change-form body uppercase text-grey-2 pointer mr-2 mb-1
                        {{ old('credentials_type') == 'new' || old('credentials_type') != 'existing' ? 'active font-bold' : '' }}"
                   data-form="newAccountForm">Create New Account</p>

                <br class="hide-xs-only">

                <p class="change-form body uppercase text-grey-2 pointer mb-1
                        {{ old('credentials_type') == 'existing' ? 'active font-bold' : '' }}"
                   data-form="existingAccountForm">Add to My Account</p>
            </div>

            <div id="newAccountForm" class="flex flex-row redemption-form {{ old('credentials_type') == 'new' || old('credentials_type') != 'existing' ? '' : 'hide' }}">
                <div class="flex flex-column">
                    <p class="tiny text-grey-5 mb-1">
                        Fill out the form below to start your 30-Day Drumeo Membership.
                    </p>

                    <form action="{{ URL::route('access-codes.form-claim') }}" method="POST" novalidate>
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="credentials_type" value="new">
{{--                        <input type="hidden" name="redirect" value="/bestbook">--}}

                        <input type="hidden" name="book-title" value="Best Beginner Drum Book">
                        <input type="hidden" name="context" value="best-book">

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "text",
                                "inputId" => "accessCodeNew",
                                "inputName" => "access_code",
                                "inputLabel" => "Access Code...",
                                "inputValue" => old('access_code'),
                                "inputErrors" => $errors->get('access_code'),
                            ])
                        </div>

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "email",
                                "inputId" => "emailNew",
                                "inputName" => "email",
                                "inputLabel" => "Email Address...",
                                "inputValue" => old('email'),
                                "inputErrors" => $errors->get('email'),
                            ])
                        </div>

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "password",
                                "inputId" => "passwordNew",
                                "inputName" => "password",
                                "inputLabel" => "Password...",
                                "inputValue" => "",
                                "inputErrors" => $errors->get('password'),
                            ])
                        </div>

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "password",
                                "inputId" => "confirmPasswordNew",
                                "inputName" => "password_confirmation",
                                "inputLabel" => "Confirm Password...",
                                "inputValue" => "",
                                "inputErrors" => $errors->get('password_confirmation'),
                            ])
                        </div>

                        <div class="flex flex-column">
                            <button class="btn big-text" type="submit">
                                <span class="bg-drumeo text-white">
                                    Click To Redeem
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="existingAccountForm" class="flex flex-row redemption-form {{ old('credentials_type') == 'existing' ? '' : 'hide' }}">
                <div class="flex flex-column">
                    <p class="tiny text-grey-5 mb-1">
                        Fill out the form below to add 30 days to your Drumeo Membership.
                    </p>

                    <form action="{{ URL::route('access-codes.form-claim') }}" method="POST" novalidate>
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="credentials_type" value="existing">

                        <input type="hidden" name="book-title" value="Best Beginner Drum Book">
                        <input type="hidden" name="context" value="best-book">

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "text",
                                "inputId" => "accessCodeExisting",
                                "inputName" => "access_code",
                                "inputLabel" => "Access Code...",
                                "inputValue" => old('access_code'),
                                "inputErrors" => $errors->get('access_code'),
                            ])
                        </div>

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "email",
                                "inputId" => "emailExisting",
                                "inputName" => "user_email",
                                "inputLabel" => "Email Address...",
                                "inputValue" => old('user_email'),
                                "inputErrors" => $errors->get('user_email'),
                            ])
                        </div>

                        <div class="flex flex-column mb-1">
                            @include('partials.bladesora.members.inputs.text-input', [
                                "brand" => "drumeo",
                                "type" => "password",
                                "inputId" => "passwordExisting",
                                "inputName" => "user_password",
                                "inputLabel" => "Password...",
                                "inputValue" => '',
                                "inputErrors" => $errors->get('user_password'),
                            ])
                        </div>

                        <div class="flex flex-column">
                            <button class="btn big-text" type="submit">
                                <span class="bg-drumeo text-white">
                                    Click To Redeem
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mv-3">
        <div class="flex flex-column bg-white corners-3 shadow content-table">
            @foreach($chapters as $index => $chapter)
                @include('books.best-beginner-drum-book.partials.chapter', [
                    "chapterNumber" => $index + 1,
                    "chapterTitle" => $chapter['chapterTitle'],
                    "thumbnail" => $chapter['thumbnail'],
                    "title" => $chapter['title'],
                    "description" => $chapter['description'],
                    "contentLink" => $chapter['contentLink'],
                    "hasAccess" => in_array($index, [4, 6, 7]) ? true : $hasAccess
                ])
            @endforeach
            <div class="flex flex-row flex-wrap bt-grey-1-1 pa-1">
{{--                <div class="flex flex-column xs-12 sm-4 pa-1">--}}
{{--                    <a href="{{ cdn('books/best-beginner-drum-book/drumeo-practice-routine-generator.pdf') }}"--}}
{{--                       class="bg-drumeo corners-3 text-white pa no-decoration"--}}
{{--                       target="_blank" download>--}}
{{--                        <p class="body font-bold uppercase dense">Practice Routine Generator</p>--}}
{{--                        <p class="tiny font-italic uppercase dense">PDF Download</p>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="flex flex-column xs-12 sm-4 pa-1">--}}
{{--                    <a href="{{ cdn('books/best-beginner-drum-book/drumeo-notation-legend.pdf') }}"--}}
{{--                       class="bg-drumeo corners-3 text-white pa no-decoration"--}}
{{--                       target="_blank" download>--}}
{{--                        <p class="body font-bold uppercase dense">Drumeo Notation Legend</p>--}}
{{--                        <p class="tiny font-italic uppercase dense">PDF Download</p>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="flex flex-column xs-12 sm-4 pa-1">--}}
{{--                    <a href="{{ cdn('books/best-beginner-drum-book/drumeo-cheat-sheet.pdf') }}"--}}
{{--                       class="bg-drumeo corners-3 text-white pa no-decoration"--}}
{{--                       target="_blank" download>--}}
{{--                        <p class="body font-bold uppercase dense">Drumeo Cheat Sheet</p>--}}
{{--                        <p class="tiny font-italic uppercase dense">PDF Download</p>--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection

