@extends('partials.layout')

@section('meta')
    <title>Login | Musora</title>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let loginForm = document.getElementById('loginForm'),
                resetForm = document.getElementById('resetForm'),
                loginToggle = document.getElementById('loginToggle'),
                resetToggle = document.getElementById('resetToggle');

            loginToggle.addEventListener('click', function () {
                loginForm.classList.remove('hide');
                resetForm.classList.add('hide');
            });

            resetToggle.addEventListener('click', function () {
                loginForm.classList.add('hide');
                resetForm.classList.remove('hide');
            });
        });
    </script>
@endsection

@section('content')
    <div v-cloak>

        <section id="logoContainer" class="pa-2 tw-text-center">
            <img class="logo"
                src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
        </section>

        <p class="tw-pb-3 tw-text-center tw-italic">The Ultimate Online Singeo Lessons Experience&#8482;</p>

        @include('partials.bladesora.members.login-form', [
            "brand" => "{{ $brand }}",
            "loginUrl" => url()->route('usora.authenticate.with-credentials', (!empty($redirect) ? ['redirect' => $redirect] : [])),
            "resetUrl" => url()->route('usora.password.send-reset-email'),
            "joinUrl" => url('/#orderNow'),
            "joinPitch" => "tw-text-black",
            "labelClasses" => "text-grey-3 tiny",
            "checked" => true,
        ])
        
    </div>
@endsection
