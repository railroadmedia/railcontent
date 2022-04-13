@extends('layout', [
    "bodyClass" => "bg-white login-body",
    "hideNav" => true,
    "hideFooter" => true
])

@section('meta')
    <title>Login | Singeo</title>
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
    <section id="logoContainer" class="pa-2 text-center">
    </section>

    <p class="pb-3 text-center font-italic">The Ultimate Online Singeo Lessons Experience&#8482;</p>

    @include('partials.bladesora.members.login-form', [
        "brand" => "singeo",
        "loginUrl" => url()->route('user_management_system.login.cookie', (!empty($redirect) ? ['redirect' => $redirect] : [])),
        "resetUrl" => 'todo',
        "joinUrl" => url('/#orderNow'),
        "joinPitch" => "text-black",
        "labelClasses" => "text-grey-3 tiny",
        "checked" => true,
    ])
@endsection
