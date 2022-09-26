@extends('partials.login-layout')

@section('meta')
    <title>Reset Password | Musora</title>
@endsection

@section('content')
<div class="tw-w-full tw-h-[100vh] tw-bg-[#000C17] tw-z-0">
    <img
        id="loginBgImg"
        src="https://musora.com/cdn-cgi/image/width=1200,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/musora_login.jpg"
        class="tw-absolute tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0 tw-w-full tw-h-full tw-z-10"
        loading="lazy"
        onload="document.getElementById('loginBgImg').classList.remove('tw-opacity-0')"
    >
    <div class="tw-absolute tw-flex tw-w-full tw-min-h-screen tw-flex-col tw-justify-center tw-items-center tw-text-white tw-z-20">
        <section id="logoContainer" class="tw-flex-col tw-flex tw-items-center tw-text-center">
            <img class="logo tw-max-w-[280px] tw-mb-6"
                src="https://musora-ui.s3.amazonaws.com/logos/musora-white.svg" alt="Musora Logo">
            <p class="tw-font-bold tw-text-center tw-text-white tw-text-lg tw-mb-6">Home of <span class="tw-text-drumeo">Drumeo</span>, <span class="tw-text-pianote">Pianote</span>, <br> <span class="tw-text-guitareo">Guitareo</span>, and <span class="tw-text-singeo">Singeo</span></p>
        </section>

        <reset-pass-form
            :errors="{{json_encode($errors->all())}}"
            :usecsrftoken="!!({{$useCsrfToken ?? true}})"
            :email="{{ json_encode($email) }}"
            :resettoken="{{ json_encode($token) }}"
            :reseturl="{{ json_encode(url()->route('user_management_system.password.reset-password-with-token')) }}"
        >
            <template #csrf>{{ csrf_field() }}</template>
        </reset-pass-form>
    </div>
</div>
@endsection
