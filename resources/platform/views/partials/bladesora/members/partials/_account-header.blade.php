@php
    /**
     * @var \Modules\UserManagementSystem\Models\User $user
     */
@endphp

<div
    id="pageHeader"
    class="fluid tw-py-8 tw-relative tw-bg-cover tw-bg-top tw-bg-no-repeat tw-bg-black"
    dusk="profile-header"
    style="background-image:url({{ cf_img($backgroundImage, ["quality" => 80, "blur" => 40, "width" => 600, "fit" => "crop"]) }});"
    data-ix-bg="{{ $backgroundImage }}"
>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>

    <div class="account-header tw-container tw-flex tw-flex-col tw-items-center lg:tw-items-end xl:tw-items-center lg:tw-flex-row tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-relative tw-z-10 ">

        {{-- Avatar Image --}}
        <div class="header-avatar tw-flex tw-flex-col tw-mb-4 lg:tw-mb-0">
            <div class="user-avatar
                {{ in_array($user->access_level, ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                {{ $brand }}
                {{ $user->access_level }}"
            >
                <div class="no-decoration tw-bg-cover tw-bg-top tw-inline-block tw-rounded-full tw-h-[165px] tw-w-[165px]"
                   style="background-image: url(https://musora.imgix.net/https%3A%2F%2Fs3.amazonaws.com%2Fpianote%2Fdefaults%2Favatar.png?ixlib=js-2.3.2&amp;fit=crop&amp;crop=faces%2Cedges&amp;auto=format&amp;w=171&amp;h=171&amp;dpr=1&amp;s=1bfa63f0a133082f4c2edb5f7f252f25)"
                >
                    @if($userAvatar)
                        <img class="tw-inline-block tw-rounded-full tw-h-full"
                            src="{{ cf_img($userAvatar, ["quality" => 50, "blur" => 2, "width" => 165, "height" => 165, "fit" => "crop"]) }}"
                            data-ix-src="{{ $userAvatar }}"
                        >
                    @endif
                </div>
            </div>
        </div>

        <div class="tw-flex tw-flex-col xl:tw-flex-row tw-w-full tw-justify-end xl:tw-items-center tw-pl-6">
            {{-- Account Header --}}
            <div class="tw-flex tw-w-full tw-items-center">
                <div class="tw-flex tw-flex-col tw-w-full tw-items-center lg:tw-items-start tw-mb-4 xl:tw-mb-0">
                    <h2 class="tw-font-bold tw-text-[36px] tw-leading-none lg:tw-leading-none tw-text-white lg:tw-text-3xl tw-mb-1">
                        @if(!empty($countryCode))
                            <span class="flag flag-{{ strtolower($countryCode) }}"></span>
                        @endif
                        {{ $userName }}
                    </h2>
                    <p class="tw-text-white tw-uppercase tw-font-bebas-neue tw-text-[28px]">
                        {{ $appName }} Member Since {{ \Carbon\Carbon::parse($memberSince)->format('Y') }}
                    </p>
                </div>
            </div>

            {{-- Calls To Action --}}
            @if($user->access_level !== 'pack' && ($isCurrentUsersProfile ?? true))
                <div class="tw-flex tw-items-center tw-justify-center lg:tw-justify-start xl:tw-justify-end tw-w-full tw-flex-wrap xl:tw-flex-nowrap">

                    <!-- Referral Button -->
                    <a href="/referral/invite-a-friend"
                        class="tw-btn-primary tw-w-auto tw-inline-flex tw-bg-{{$brand}} tw-mb-2 tw-max-w-[267px] tw-mx-2 "
                    >
                        <i aria-hidden="true" class="fas fa-gift md:tw-mr-2"></i>
                        <span class="tw-leading-none tw-mt-0.5">invite a friend</span>
                    </a>
                    {{-- Complete Your Account --}}
                    @if(true) {{-- Check if User Has Finished Account --}}
                        <a href="/referral/invite-a-friend" 
                            class="tw-btn-secondary tw-border-2 tw-text-white tw-w-auto tw-inline-flex tw-max-w-[267px] tw-mx-2"
                        >
                            Complete Your Account
                        </a>
                    @endif
                </div>
            @endif
        </div>

    </div>
</div>
