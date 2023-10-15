@extends('partials.login-layout')

@section('meta')
    <title>Create Your Account | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-h-[100vh] tw-bg-[#000C17] tw-z-0">
        <img
            id="loginBgImg"
            src="https://www.musora.com/musora-cdn/image/width=1200,q_auto:best/https://d3fzm1tzeyr5n3.cloudfront.net/musora/musora_login.jpg"
            class="tw-absolute tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0 tw-w-full tw-h-full tw-z-10"
            loading="lazy"
            onload="document.getElementById('loginBgImg').classList.remove('tw-opacity-0')"
        >
        <div
            class="tw-absolute tw-flex tw-w-full tw-min-h-screen tw-flex-col tw-justify-center tw-items-center tw-text-white tw-z-20">
            <section id="logoContainer" class="tw-flex-col tw-flex tw-items-center tw-text-center">
                <img class="logo tw-max-w-[280px] tw-mb-6"
                     src="https://d38h3dn806jqj1.cloudfront.net/logos/musora-white_new.svg" alt="Musora Logo">
                <p class="tw-font-bold tw-text-center tw-text-white tw-text-lg tw-mb-6">Home of <span
                        class="tw-text-drumeo">Drumeo</span>, <span class="tw-text-pianote">Pianote</span>, <br> <span
                        class="tw-text-guitareo">Guitareo</span>, and <span class="tw-text-singeo">Singeo</span></p>
            </section>

            <div class="tw-flex tw-flex-col tw-w-full tw-px-4 tw-items-center">
                <section id="loginForm"
                         class="tw-flex tw-flex-col tw-bg-[#081825]/[90] tw-rounded-xl tw-w-full tw-max-w-[423px] tw-min-h-[369px] tw-border-[1px] tw-border-[#445F74] tw-px-[32px]">
                    <form method="post" action="{{ url()->route('user_management_system.create-account-submit') }}"
                          class="tw-flex tw-flex-col tw-py-[42px]">

                        <p class="tw-font-bold tw-text-center tw-text-white tw-text-lg tw-mb-2">Your Log In Email Address:</p>
                        <p class="tw-text-center tw-text-white tw-text-md tw-mb-6">{{ $email ?? '' }}</p>

                        <p class="tw-font-bold tw-text-center tw-text-white tw-text-lg tw-mb-2">Create a password for your account.</p>
                        <p class="tw-text-center tw-text-white tw-text-sm tw-mb-6">This is the password you will use to log in <br>to your account in the future.</p>

                        {{ csrf_field() }}

                        <input type="hidden" name="verification_token"
                               value="{{ $verificationToken ?? '' }}">

                        <input type="hidden" name="email"
                               value="{{ $email ?? '' }}">

                        <div class="tw-flex tw-flex-col tw-mb-[20px] tw-relative">
                            <div class="tw-flex tw-w-full tw-flex-col tw-relative loginPassword-wrapper tw-text-[16px]"
                                 brand="drumeo">

                                @foreach($errors->all() as $error)
                                    <ul class="tw-flex tw-flex-col tw-mb-3 tw-text-sm text-error list-style-none"><li>{{ $error }}</li></ul>
                                @endforeach

                                <label for="loginPassword"
                                       class="tw-text-sm tw-px-[13px] tw-pb-[5px] loginPassword-label dark:tw-text-[#9EC0DC]">Password (minimum of 8 characters)</label>
                                <div class="tw-flex tw-relative">
                                    <input data-maska="" data-maska-tokens=""
                                           placeholder="Enter a new account password..."
                                           id="loginPassword"
                                           class="tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none tw-w-full tw-h-[50px] tw-text-[#00101D]"
                                           name="password" type="password"
                                           autocomplete="off"><!---->
                                    <div
                                        class="tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center tw-hidden">
                                        <button type="button"
                                                class="tw-w-[24px] tw-h-[24px] tw-absolute tw-flex tw-items-center tw-justify-center tw-right-3 tw-text-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="2" stroke="currentColor" aria-hidden="true"
                                                 class="tw-w-[24px] tw-h-[24px]">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg><!----></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="tw-mb-[20px] tw-mx-4 tw-btn-secondary tw-text-[#445F74] tw-mt-4"
                                dusk="submit-button"> <!----><span>Create Account</span></button>
                        <button id="hidden-submit" type="submit" hidden="">Submit</button>
                </section><!----></div>
        </div>
    </div>
@endsection
