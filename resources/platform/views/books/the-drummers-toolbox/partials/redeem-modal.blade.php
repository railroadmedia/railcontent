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

                <form action="{{ $formSubmitUrl }}" method="POST" novalidate>
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <input type="hidden" name="credentials_type" value="new">
                    <input type="hidden" name="redirect" value="/drummers-toolbox">

                    <input type="hidden" name="book-title" value="The Drummer's Toolbox">
                    <input type="hidden" name="context" value="drummers-toolbox">

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

                <form action="{{ $formSubmitUrl }}" method="POST" novalidate>
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <input type="hidden" name="credentials_type" value="existing">
                    <input type="hidden" name="redirect" value="/drummers-toolbox">

                    <input type="hidden" name="book-title" value="The Drummer's Toolbox">

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

                    @if(!auth()->check())

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

                    @endif

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
