<!-- Forum Header Banner -->
<div class="tw-container tw-mx-auto fluid collapsed-h pv-5 tw-relative tw-bg-black">
    <div class="header-background-container absolute-fill bg-top"
         style="background-image: url({{ cf_img(
                $backgroundImage,
                ["quality" => 80, "blur" => 40, "width" => 640]
            ) }});" data-ix-bg="{{ $backgroundImage }}"
    ></div>
    <div class="header-background-container absolute-fill bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-relative">
        <div class="tw-flex tw-flex-row tw-items-center">
            {{ $content }}

            @if(empty($hideUser))
                <div class="tw-flex-col tw-items-center tw-hidden sm:tw-flex">
                    <div class="header-avatar user-avatar rounded tw-bg-black tw-pb-0 tw-w-32
                                {{ in_array($currentUser['access_level'], ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                                {{ $brand }}
                                {{ $currentUser['access_level'] }}"
                    >
                        <a href="{{ $profileUrl }}" class="tw-no-underline">
                            <img
                                class="tw-rounded inset-border"
                                src="{{ cf_img(
                                    $currentUser['avatar'],
                                    ["quality" => 50, "blur" => 2, "width" => 50, "height" => 50]
                                ) }}"
                                data-ix-src="{{ $currentUser['avatar'] }}"
                            >
                        </a>
                    </div>

                    @if($currentUser['access_level'] !== 'pack')
                        <p class="body dense tw-font-bold tw-text-center tw-uppercase tw-mb-1 tw-text-white tw-leading-none tw-text-lg">
                            @if($currentUser['access_level'] === 'team')
                                {{ $brand }} Team
                            @else
                                {{ user()->getXpRank() }}
                            @endif
                        </p>

                        @if($currentUser['access_level'] !== 'team')
                            <p class="body dense font-compressed tw-text-white tw-text-center tw-text-lg tw-leading-none">{{ $currentUser['xp'] }} XP</p>
                        @endif
                        @isset($userActions)
                            {{ $userActions }}
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
