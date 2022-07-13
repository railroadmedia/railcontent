<!-- // todo - review & clean -->
<div class="tw-w-full fluid collapsed-h tw-py-8 md:tw-py-11 relative tw-bg-black">
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top"
            style="background-image: url({{ cf_img($backgroundImage ?? 'https://d2vyvo0tyx8ig5.cloudfront.net/backgrounds/default-3840.jpg', ["quality" => 80, "blur" => 150, "width" => 640]) }});"
    ></div>
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-relative">
        <div class="tw-flex tw-flex-row">
            {{ $content }}

            {{-- @if(empty($hideUser))
                <div class="header-avatar tw-flex tw-flex-col hide-xs-only">
                    <div class="user-avatar tw-rounded tw-bg-black
                                {{ in_array(user()->access_level, ['edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                                {{ $brand }}
                                {{ user()->access_level }}"
                    >
                        <a href="{{ user()->getDashboardUrl() }}" class="tw-no-underline">
                            <img
                                class="tw-rounded inset-border"
                                src="{{ user()->profile_picture_url }}"
                                data-ix-src="{{ user()->profile_picture_url }}"
                            >
                        </a>
                    </div>

                    @if(user()->access_level !== 'pack')
                        <p class="body dense tw-text-white tw-font-bold tw-text-center tw-uppercase tw-mt-1 tw-text-white">
                            @if(user()->access_level === 'team')
                                {{ $brand }} Team
                            @else
                                {{ user()->getXpRank() }}
                            @endif
                        </p>

                        @if(user()->access_level !== 'team')
                            <p class="body dense tw-text-white font-compressed tw-text-center">{{ user()->total_xp }} XP</p>
                        @endif
                    @endif
                </div>
            @endif --}}
        </div>

        {{ $interactionSlot ?? '' }}
    </div>
</div>
