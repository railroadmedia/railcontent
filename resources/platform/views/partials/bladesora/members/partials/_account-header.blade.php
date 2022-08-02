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
    <div class="header-gradient-overlay absolute-fill"></div>

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
                    @if($user->profile_picture_url)
                        <img class="tw-inline-block tw-rounded-full tw-h-full" 
                                src="{{ cf_img($user->profile_picture_url, ["quality" => 50, "blur" => 2, "width" => 165, "height" => 165, "fit" => "crop"]) }}"
                                data-ix-src="{{ $user->profile_picture_url }}"
                        >
                    @endif
                </div>
            </div>
        </div>

        <div class="tw-flex tw-flex-col xl:tw-flex-row tw-w-full tw-justify-end xl:tw-items-center lg:tw-pl-6">
            {{-- Account Header --}}
            <div class="tw-flex tw-w-full tw-items-center">
                <div class="tw-flex tw-flex-col tw-w-full tw-items-center lg:tw-items-start tw-mb-2 xl:tw-mb-0">
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

            @if(!empty($isCurrentUsersProfile))
                <div class="tw-flex tw-items-center tw-justify-center lg:tw-justify-start xl:tw-justify-end tw-w-full tw-flex-wrap xl:tw-flex-nowrap">
                    {{-- Complete Your Account / Update Your Account --}}
                    <a href="/onboarding" 
                        class="tw-btn-secondary tw-border-2 tw-text-white tw-w-auto tw-inline-flex tw-max-w-[267px] tw-mx-2"
                    >
                        {{ $showCompleteYourAccountButton ? 'Complete Your Account' : 'Update Your Account' }}
                    </a>
                </div>
            @else
                <div class="tw-flex tw-flex-col tw-w-full tw-items-center lg:tw-items-start lg:tw-w-fit tw-flex-shrink-0">
                    <div class="tw-flex tw-flex-col tw-items-center lg:tw-items-start">
                        <div class="tw-flex tw-items-center tw-font-bebas-neue tw-text-[24px] tw-text-[#0B76DB]">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.50018 9.00018L8.16685 10.6668L11.5002 7.33352M5.52913 2.91439C6.12708 2.86667 6.69473 2.63154 7.15128 2.24247C8.21669 1.33454 9.78368 1.33454 10.8491 2.24247C11.3056 2.63154 11.8733 2.86667 12.4712 2.91439C13.8666 3.02574 14.9746 4.13377 15.086 5.52913C15.1337 6.12708 15.3688 6.69473 15.7579 7.15128C16.6658 8.21669 16.6658 9.78368 15.7579 10.8491C15.3688 11.3056 15.1337 11.8733 15.086 12.4712C14.9746 13.8666 13.8666 14.9746 12.4712 15.086C11.8733 15.1337 11.3056 15.3688 10.8491 15.7579C9.78368 16.6658 8.21669 16.6658 7.15128 15.7579C6.69473 15.3688 6.12708 15.1337 5.52913 15.086C4.13377 14.9746 3.02574 13.8666 2.91439 12.4712C2.86667 11.8733 2.63154 11.3056 2.24247 10.8491C1.33454 9.78368 1.33454 8.21669 2.24247 7.15128C2.63154 6.69473 2.86667 6.12708 2.91439 5.52913C3.02574 4.13377 4.13377 3.02574 5.52913 2.91439Z" stroke="#0B76DB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            &nbsp;
                            {{ $user->getXpRank() }}            
                        </div>
                        <div class="tw-flex tw-items-center tw-font-bebas-neue tw-text-[24px] tw-text-white">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.16667 1.5V4.83333M1.5 3.16667H4.83333M4 13.1667V16.5M2.33333 14.8333H5.66667M9.83333 1.5L11.7381 7.21429L16.5 9L11.7381 10.7857L9.83333 16.5L7.92857 10.7857L3.16667 9L7.92857 7.21429L9.83333 1.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                            
                            &nbsp;
                            {{ $user->total_xp }}            
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
