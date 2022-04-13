@extends('partials.layout')

@section('meta')
    <title>Login | Musora</title>
@endsection

@section('styles')
    <style>
        body {
            position: fixed;
            box-sizing: border-box;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #logoContainer {
            margin-top: -125px;
        }

        #loginForm, #resetForm, #logoContainer {
            flex: 0 0 auto;
            max-width: 100%;
            width:400px;
        }
    </style>
@endsection

@section('scripts')

@endsection

@section('content')
    <page-container>
        <div v-cloak>

            <section id="logoContainer" class="pa-2 tw-text-center">
                <img class="logo"
                    src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
            </section>

            <p class="tw-pb-3 tw-text-center tw-italic">Your start-to-finish guide to learning music.</p>

            <section class="tw-flex tw-flex-column bg-grey-1 pa-3 tw-mb-3 corners-10">

                <form method="post" action="{{ url()->route('usora.password.reset') }}" class="tw-flex tw-flex-column">
                    @if($useCsrfToken ?? true)
                        {{ csrf_field() }}
                    @endif

                    @if(!empty($errors->all()))
                        <ul class="tw-flex tw-flex-column mb-3 tiny text-error tw-list-none">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <p class="tiny tw-mb-2 tw-text-center">Reset password for <strong>{{ $email }}</strong></p>

                    <div class="tw-flex tw-flex-column tw-mb-2">
                        @include('partials.bladesora.members.inputs.text-input', [
                        "brand" => 'singeo',
                        "type" => "password",
                        "inputId" => "newPassword",
                        "inputName" => "password",
                        "inputLabel" => "New Password",
                        "inputValue" => "",
                        "inputErrors" => []
                    ])
                    </div>

                    <div class="tw-flex tw-flex-column tw-mb-2">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => 'singeo',
                            "type" => "password",
                            "inputId" => "confirmNewPassword",
                            "inputName" => "password_confirmation",
                            "inputLabel" => "Confirm New Password",
                            "inputValue" => "",
                            "inputErrors" => []
                        ])
                    </div>

                    <button type="submit" class="btn">
                        <span class="tw-text-white tw-bg-singeo">Sign In</span>
                    </button>
                </form>
            </section>

        </div>
    <page-container>
@endsection
