@php
    /**
     * @var \Modules\UserManagementSystem\Models\User $user
     */
@endphp

<div
    id="pageHeader"
    class="tw-container fluid tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 tw-relative"
    dusk="profile-header"
    style="background-image:url({{ cf_img($backgroundImage, ["quality" => 80, "blur" => 40, "width" => 600, "fit" => "crop"]) }});"
    data-ix-bg="{{ $backgroundImage }}"
>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-relative">
        <div class="flex flex-row align-center account-header">
            <div class="header-avatar tw-flex tw-flex-col">
                <div class="user-avatar
                        {{ in_array($user->access_level, ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                        {{ $brand }}
                        {{ $user->access_level }}">
                    <a @if(!empty($accountUrl)) href="{{ $accountUrl }}" @endif
                       class="tw-no-underline">
                        <img
                            class="tw-rounded inset-border"
                            src="{{ cf_img($user->profile_picture_url, ["quality" => 50, "blur" => 2, "width" => 50, "height" => 50, "fit" => "crop"]) }}"
                            data-ix-src="{{ $user->profile_picture_url }}"
                        >
                    </a>
                </div>
            </div>
            <div class="tw-flex tw-flex-col user ph-3 mv-3">
                <h1 class="heading text-white tw-flex tw-flex-row tw-items-center">
                    @if(!empty($countryCode))
                        <span class="flag flag-{{ strtolower($countryCode) }}"></span>
                    @endif

                    {{ $userName }}
                </h1>
                <p class="body tw-text-white tw-uppercase font-light">
                    {{ $appName }} Member Since {{ \Carbon\Carbon::parse($memberSince)->format('Y') }}
                </p>
            </div>
            @if($user->access_level !== 'pack')
                <div class="tw-flex tw-flex-col tw-flex-auto xp-stats">
                    <p class="heading dense tw-text-white tw-font-bold font-compressed tw-text-center tw-uppercase tw-mt-1 tw-text-{{ $brand }}" style="margin-bottom:-10px;">
                        @if($user->access_level === 'team')
                            {{ $appName }} Team
                        @else
                            {{ $user->getXpRank() }}
                        @endif
                    </p>

                    @if($user->access_level !== 'team')
                        <p class="heading dense tw-text-white font-regular font-compressed tw-text-center">{{ $user->total_xp }} XP</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
