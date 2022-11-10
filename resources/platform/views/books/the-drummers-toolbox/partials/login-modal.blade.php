<div id="loginModal" class="modal">
    <div class="flex flex-column bg-white corners-3 pa-3">
        <h2 class="subheading mb-3">Login To Drumeo</h2>

        <div class="flex flex-row">
            <div class="flex flex-column mb-1">
                <p class="tiny text-black mb-1">
                    To access some of the resources on this page you must be logged in to Drumeo.
                    @if($isDigital)
                        As an owner, you’re entitled to a FREE {{ $trialLength ?? 30 }}-Day Trial Membership.
                        <a href="{{ $trialUrl }}" class="font-bold text-black pointer">
                            Click here to learn more.
                        </a>
                    @else
                        If you do not have your Drumeo account set up yet,
                        <span class="font-bold bb-black-1 pointer"
                              data-open-modal="redeemModal">click here to redeem</span>
                        your free One Month Drumeo Access Pass that came with your copy of the book.
                    @endif
                </p>

                <p class="tiny text-black mb-1">
                    Or login with an existing account below.
                </p>

                <form
                    method="POST"
                    action="{{ url()->route('user_management_system.login.cookie') }}?redirect_to={{$redirectUrl }}"
                >
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <div class="flex flex-column mb-1">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => "drumeo",
                            "type" => "text",
                            "inputId" => "loginEmail",
                            "inputName" => "email",
                            "inputLabel" => "Email Address...",
                            "inputValue" => old('email'),
                            "inputErrors" => $errors->get('log'),
                        ])
                    </div>

                    <div class="flex flex-column mb-1">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => "drumeo",
                            "type" => "password",
                            "inputId" => "loginPassword",
                            "inputName" => "password",
                            "inputLabel" => "Password...",
                            "inputValue" => old('password'),
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
