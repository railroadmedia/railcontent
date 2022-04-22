<!-- // todo - review & clean -->
<div class="container fluid collapsed-h pv-5 relative bg-black">
    <div class="header-background-container absolute-fill bg-top"
            style="background-image: url({{ cf_img($backgroundImage, ["quality" => 80, "blur" => 150, "width" => 640]) }});" data-ix-bg="{{ $backgroundImage }}"
    ></div>
    <div class="header-background-container absolute-fill bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="container relative">
        <div class="flex flex-row align-center">
            {{ $content }}

            @if(empty($hideUser))
                <div class="header-avatar flex flex-column hide-xs-only">
                    <div class="user-avatar rounded bg-black
                                {{ in_array(user()->access_level, ['edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                                {{ $brand }}
                                {{ user()->access_level }}"
                    >
                        <a href="{{ url()->route('platform.profile.dashboard', ['brand' => $brand, 'userId' => user()->id]) }}"
                           class="no-decoration">
                            <img
                                class="rounded inset-border"
                                src="{{ cf_img(
                                    user()->profile_picture_url,
                                    ["quality" => 75, "blur" => 20, "width" => 50, "height" => 50]
                                ) }}"
                                data-ix-src="{{ user()->profile_picture_url }}"
                            >
                        </a>
                    </div>

                    @if(user()->access_level !== 'pack')
                        <p class="body dense text-white font-bold text-center uppercase mt-1 text-white">
                            @if(user()->access_level === 'team')
                                {{ $brand }} Team
                            @else
                                {{ user()->xp_rank }}
                            @endif
                        </p>

                        @if(user()->access_level !== 'team')
                            <p class="body dense text-white font-compressed text-center">{{ user()->total_xp }} XP</p>
                        @endif
                    @endif
                </div>
            @endif
        </div>

        {{ $interactionSlot ?? '' }}
    </div>
</div>
