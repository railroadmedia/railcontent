<section id="loginForm" class="tw-flex tw-flex-col bg-grey-1 pa-3 tw-mb-3 corners-10">

    <form method="post" action="{{ $loginUrl }}" class="tw-flex tw-flex-col">
        @if($useCsrfToken ?? true)
            {{ csrf_field() }}
        @endif

        @if(!empty($errors->all()))
            <ul class="tw-flex tw-flex-col tw-mb-3 tiny text-error list-style-none">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if(session()->has('status'))
            <ul class="tw-flex tw-flex-col tw-mb-2 tiny text-success list-style-none">
                <li>{{ session()->get('status') }}</li>
            </ul>
        @endif

        <div class="tw-flex tw-flex-col tw-mb-2">
            @include('partials.bladesora.members.inputs.text-input', [
               "brand" => $brand,
               "type" => "email",
               "inputId" => "loginEmail",
               "inputName" => "email",
               "inputLabel" => "Email Address",
               "inputValue" => "",
               "inputErrors" => []
           ])
        </div>

        <div class="tw-flex tw-flex-col tw-mb-2">
            @include('partials.bladesora.members.inputs.text-input', [
                "brand" => $brand,
                "type" => "password",
                "inputId" => "loginPassword",
                "inputName" => "password",
                "inputLabel" => "Password",
                "inputValue" => "",
                "inputErrors" => []
            ])
        </div>

{{--        <div class="tw-flex tw-flex-col mb-2">--}}
{{--            @include('partials.bladesora.members.inputs.checkbox-input', [--}}
{{--                "brand" => $brand,--}}
{{--                "inputId" => "remember",--}}
{{--                "inputName" => "remember",--}}
{{--                "inputLabel" => "Remember me on this device.",--}}
{{--                "checked" => true--}}
{{--            ])--}}
{{--        </div>--}}

        <button type="submit" class="btn tw-mb-3" dusk="submit-button">
            <span class="tw-text-white tw-bg-{{ $brand }}">Sign In</span>
        </button>
    </form>

    <a id="resetToggle" class="tiny text-center text-grey-3 noselect">Forgot your password?</a>
</section>

<section id="resetForm" class="tw-flex tw-flex-col bg-grey-1 pa-3 tw-mb-3 corners-10 hide">

    <p class="tiny tw-mb-2 text-grey-3">Please enter your email address and we will send you instructions to reset your
        password.</p>

    <form method="post" action="{{ $resetUrl }}" class="tw-flex tw-flex-col">
        @if($useCsrfToken ?? true)
            {{ csrf_field() }}
        @endif

        <div class="form-group tw-mb-2">
            <input id="resetEmail" type="email" name="email">
            <label for="resetEmail" class="{{ $brand ?? '' }}">Email Address</label>
        </div>

        <button type="submit" class="btn tw-mb-3">
            <span class="tw-text-white tw-bg-{{ $brand }}">Get New Password</span>
        </button>
    </form>

    <a id="loginToggle" class="tiny tw-text-center text-grey-3 noselect">Back to Login</a>
</section>

<p class="tiny tw-text-center {{ $joinPitch ?? '' }}">
    <strong>Not a member yet?</strong>
    <a href="{{ $joinUrl }}">Join the community here!</a>
</p>