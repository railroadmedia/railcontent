@extends('partials.login-layout')

@section('meta')
    <title>Login | Musora</title>
@endsection

@section('content')
<div class="tw-w-full tw-h-[100vh] tw-bg-[#000C17] tw-z-0">
    <img
        id="loginBgImg"
        src="https://musora-web-platform.s3.amazonaws.com/musora/musora_login.jpg"
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

        <login-form
            brand="drumeo"
            loginurl="{{ url()->route('user_management_system.login.cookie', (!empty($redirect) ? ['redirect' => $redirect] : [])) }}"
            reseturl="{{ url()->route('user_management_system.password.send-reset-email', (!empty($redirect) ? ['redirect' => $redirect] : [])) }}"
            joinurl="{{url('/#orderNow')}}"
            :errors="{{json_encode($errors->all())}}"
            hassessionstatus="{{session()->has('status')}}"
            sessionstatus="{{ session()->get('status') }}"
            :usecsrftoken="!!({{$useCsrfToken ?? true}})"
        >
            <template v-slot:csrf>{{ csrf_field() }}</template>
        </login-form>

        <p class="tiny tw-text-center tw-py-[20px] tw-text-[16px] {{ $joinPitch ?? '' }}">
            <span>Not a member yet?</span>
            <br/>
            <a class="tw-text-white tw-font-extrabold tw-underline" href="{{ url('/#orderNow') }}">Join the community here!</a>
        </p>
    </div>
</div>
@endsection
