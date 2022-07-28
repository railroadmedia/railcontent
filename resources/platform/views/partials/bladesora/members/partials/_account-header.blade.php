@php
    /**
     * @var \Modules\UserManagementSystem\Models\User $user
     */
    //dd($user->access_level)
    $hasExperience = user()->onboardingExperience ? true : false;
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
                    @if($userAvatar)
                        <img class="tw-inline-block tw-rounded-full tw-h-full"
                            src="{{ cf_img( $userAvatar, ["quality" => 50, "blur" => 2, "width" => 165, "height" => 165, "fit" => "crop"] ) }}"
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

            @if($isCurrentUsersProfile)
                <div class="tw-flex tw-items-center tw-justify-center lg:tw-justify-start xl:tw-justify-end tw-w-full tw-flex-wrap xl:tw-flex-nowrap">
                    {{-- Complete Your Account / Update Your Account --}}
                    <a href="/onboarding" 
                        class="tw-btn-secondary tw-border-2 tw-text-white tw-w-auto tw-inline-flex tw-max-w-[267px] tw-mx-2"
                    >
                        {{ $showCompleteYourAccountButton ? 'Complete Your Account' : 'Update Your Account' }}
                    </a>
                </div>
            @else
                <div>
                    EXP CODE
                </div>
            @endif
        </div>

    </div>
</div>
