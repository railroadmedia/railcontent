@extends('partials.layout')

@section('meta')
    <title>Membership Change | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-flex tw-items-center tw-justify-center md:tw-h-[calc(100vh-128px)]">
        @if($isLifetime)
            <membership-update-page
                :current-tier="{{ json_encode($currentTier) }}"
                :upgrade-cost="{{ json_encode($upgradeCost) }}"
                :is-lifetime-member="{{ json_encode(boolval($isLifetime)) }}"
            ></membership-update-page>
        @else
            <div class="tw-flex tw-flex-col tw-max-w-[764px] tw-justify-center tw-items-center tw-my-8 tw-text-center">
                <h2 class="tw-font-open-sans tw-font-bold tw-text-[24px] tw-leading-[36px] tw-mb-2">
                    We're sorry, but your membership level does not include Songs.
                </h2>
                <p class="tw-text-[16px] tw-leading-[24px]">
                    For more information on Songs and our Musora+ membership, or to upgrade your membership, please <a class="tw-underline tw-text-drumeo" href="https://www.musora.com/{{ $brand }}/support">contact our team</a> and we will be happy to help!
                </p>
            </div>
        @endif
    </div>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
