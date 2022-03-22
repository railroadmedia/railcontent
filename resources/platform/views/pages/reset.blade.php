@extends('members.layout', [
    "bodyClass" => "bg-white",
    "hideNav" => true,
    "hideFooter" => true
])

@section('meta')
    <title>Login | Singeo</title>
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
    <section id="logoContainer" class="pa-2 text-center">
        <img class="logo"
             src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
    </section>

    <p class="pb-3 text-center font-italic">Your start-to-finish guide to confident singing.</p>

    <section class="flex flex-column bg-grey-1 pa-3 mb-3 corners-10">

        <form method="post" action="{{ url()->route('usora.password.reset') }}" class="flex flex-column">
            @if($useCsrfToken ?? true)
                {{ csrf_field() }}
            @endif

            @if(!empty($errors->all()))
                <ul class="flex flex-column mb-3 tiny text-error list-style-none">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <p class="tiny mb-2 text-center">Reset password for <strong>{{ $email }}</strong></p>

            <div class="flex flex-column mb-2">
                @include('bladesora::members.inputs.text-input', [
                   "brand" => 'singeo',
                   "type" => "password",
                   "inputId" => "newPassword",
                   "inputName" => "password",
                   "inputLabel" => "New Password",
                   "inputValue" => "",
                   "inputErrors" => []
               ])
            </div>

            <div class="flex flex-column mb-2">
                @include('bladesora::members.inputs.text-input', [
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
                <span class="text-white bg-singeo">Sign In</span>
            </button>
        </form>
    </section>
@endsection
