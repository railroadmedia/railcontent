<div class="tw-full fluid collapsed-h pv-5 relative bg-black">
    {{-- Background Image --}}
    <div class="header-background-container absolute-fill bg-top">
        <img src="{{ $backgroundImage }}" 
             class="tw-h-full tw-w-full  tw-object-top tw-object-cover tw-transition-opacity tw-opacity-0"
             loading="lazy"
             onload="this.classList.remove('tw-opacity-0')"
        >
    </div>
    {{-- Background Gradient --}}
    <div class="absolute-fill bg-top hide-lg-down tw-left-0 tw-w-full" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="relative">
        <div class="tw-relative tw-flex tw-items-center tw-container tw-mx-auto tw-px-4 md:tw-px-8">
            {{ $content }}

            @if(empty($hideUser))
                <div class="tw-flex-col tw-items-center tw-hidden sm:tw-flex">
                    <div class="header-avatar user-avatar rounded tw-bg-black tw-pb-0 tw-w-32
                                {{ in_array($currentUser['access_level'], ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                                {{ $brand }}
                                {{ $currentUser['access_level'] }}"
                    >
                        <a href="{{ $profileUrl }}" class="no-decoration">
                            <img
                                alt="user avatar"
                                class="rounded inset-border tw-transition-opacity tw-opacity-0"
                                src="{{ $currentUser['avatar'] }}"
                                loading="lazy"
                                onload="this.classList.remove('tw-opacity-0')"
                            >
                        </a>
                    </div>

                    @if($currentUser['access_level'] !== 'pack')
                        <p class="body dense text-white font-bold text-center uppercase mt-1 text-white">
                            @if($currentUser['access_level'] === 'team')
                                {{ $brand }} Team
                            @elseif ($currentUser['access_level'] === 'coach')
                                COACH
                            @else
                                Level {{ $currentUser['level_number'] }}
                            @endif
                        </p>

                        @if($currentUser['access_level'] !== 'team')
                            <p class="body dense text-white font-compressed text-center">
                                {{ $currentUser['xp'] }} XP
                            </p>
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
