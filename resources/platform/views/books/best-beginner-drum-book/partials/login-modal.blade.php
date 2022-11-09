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

                @include('bladesora::members.login-form', [
                    "brand" => "drumeo",
                    "loginUrl" => url()->route('usora.authenticate.with-credentials', ['redirect' => $redirectUrl]),
                    "resetUrl" => url()->route('usora.password.send-reset-email'),
                    "joinUrl" => url('/'),
                    "joinPitch" => "",
                    "labelClasses" => "text-grey-3 tiny",
                    "checked" => true,
                ])
            </div>
        </div>
    </div>
</div>