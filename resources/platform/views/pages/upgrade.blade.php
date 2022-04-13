@extends('partials.layout')

@section('meta')
    <title>Upgrade Membership | Musora</title>
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            <header id="pageHeader"
                    class="tw-container tw-mx-auto fluid pv-4"
                    style="background-image:url('https://singeo.s3.amazonaws.com/singeo-header-image.jpg');">
                <div class="tw-container tw-mx-auto tw-text-center">
                    <h1 class="heading tw-text-white tw-mb-2">
                        <a href="javascript:history.back()" class="tw-no-underline">
                            <i class="fas fa-arrow-circle-left text-grey-3"></i>
                        </a>
                        Upgrade Your Account
                    </h1>
                    <p class="body tw-text-white">
                        The page you are trying to access requires a Musora Membership.
                    </p>
                    <p class="body tw-text-white tw-mb-2">
                        <a href="/#orderNow"
                        class="tw-font-bold tw-text-white">
                            Upgrade your account
                        </a>
                        or read below to find out what you get with Musora.
                    </p>
                    <div class="tw-flex-center">
                        <a href="/#orderNow"
                        class="btn tw-bg-drumeo tw-text-white collapse-250">
                            Get a Musora Membership
                        </a>
                    </div>
                </div>
            </header>

        </div>
    </page-container>
@endsection

