<!-- // todo - review & clean -->
<div class="tw-container tw-mx-auto fluid collapsed-h pv-5 relative tw-bg-black">
    <div class="header-background-container absolute-fill tw-bg-top"
            style="background-image: url({{ _imgix(
                    $backgroundImage,
                    ["q" => 80, "blur" => 40, "w" => 640]
                ) }});" data-ix-bg="{{ $backgroundImage }}"
    ></div>
    <div class="header-background-container absolute-fill tw-bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-relative">
        <div class="tw-flex tw-flex-row align-center">
            {{ $content }}

            @if(empty($hideUser))
                <div class="header-avatar tw-flex tw-flex-col hide-xs-only">
                    <div class="user-avatar tw-rounded tw-bg-black
                                {{ in_array($currentUser['access_level'], ['edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                                {{ $brand }}
                                {{ $currentUser['access_level'] }}"
                    >
                        <a href="{{ $profileUrl }}" class="tw-no-underline">
                            <img
                                class="tw-rounded inset-border"
                                src="{{ _imgix(
                                    $currentUser['avatar'],
                                    ["q" => 50, "blur" => 2, "w" => 50, "h" => 50]
                                ) }}"
                                data-ix-src="{{ $currentUser['avatar'] }}"
                            >
                        </a>
                    </div>

                    @if($currentUser['access_level'] !== 'pack')
                        <p class="body dense tw-text-white tw-font-bold tw-text-center tw-uppercase tw-mt-1 tw-text-white">
                            @if($currentUser['access_level'] === 'team')
                                {{ $brand }} Team
                            @else
                                {{ map_experience_rank($currentUser['xp']) }}
                            @endif
                        </p>

                        @if($currentUser['access_level'] !== 'team')
                            <p class="body dense tw-text-white font-compressed tw-text-center">{{ $currentUser['xp'] }} XP</p>
                        @endif
                    @endif
                </div>
            @endif
        </div>

        {{ $interactionSlot ?? '' }}
    </div>
</div>
