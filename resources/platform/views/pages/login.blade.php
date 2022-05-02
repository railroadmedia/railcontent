@extends('partials.login-layout')

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
    <div class="tw-flex tw-w-full tw-min-h-screen tw-flex-col tw-justify-center tw-items-center tw-bg-[#000C17] tw-text-white tw-bg-cover"
         style="background-image: url('https://musora-web-platform.s3.amazonaws.com/musora/musora_login.jpg');"
         v-cloak>

        <section id="logoContainer" class="tw-flex-col tw-flex tw-items-center tw-text-center">
            <img class="logo tw-max-w-[280px] tw-mb-6"
                src="https://musora-ui.s3.amazonaws.com/logos/musora-white.svg" alt="Musora Logo">
            <p class="tw-font-bold tw-text-center tw-text-white tw-text-lg tw-mb-6">Home of <span class="tw-text-drumeo">Drumeo</span>, <span class="tw-text-pianote">Pianote</span>, <br> <span class="tw-text-guitareo">Guitareo</span>, and <span class="tw-text-singeo">Singeo</span></p>
        </section>

        <login-form
            brand="drumeo"
            loginurl="{{ url()->route('user_management_system.login.cookie', (!empty($redirect) ? ['redirect' => $redirect] : [])) }}"
            reseturl="//todo"
            joinurl="{{url('/#orderNow')}}"
            :errors="{{json_encode($errors->all())}}"
            hassessionstatus="{{session()->has('status')}}"
            sessionstatus="{{ session()->get('status') }}"
            :usecsrftoken="!!({{$useCsrfToken ?? true}})"
        >
            <template v-slot:csrf>{{ csrf_field() }}</template>
        </login-form>

        <p class="tiny tw-text-center {{ $joinPitch ?? '' }}">
            <strong>Not a member yet?</strong>
            <a href="{{ $joinUrl }}">Join the community here!</a>
        </p>
    </div>
@endsection
