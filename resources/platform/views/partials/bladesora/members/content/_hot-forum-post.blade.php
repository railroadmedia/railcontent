<div class="tw-flex tw-flex-nowrap sm:tw-flex-wrap tw-transition-colors tw-flex-col tw-min-w-[340px] sm:tw-min-w-0 sm:tw-w-[340px] lg:tw-w-auto tw-rounded-md pa-2 hover:tw-shadow-lg dark:hover:tw-bg-[#081825] tw-border tw-border-transparent dark:hover:tw-border-[#223F57]">
    <a href="{{ $url }}" class="tw-flex tw-flex-row tw-no-underline tw-flex-1">
        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white hot-forum-avatar-col"
        >
            {{-- Avatar Thumbnail --}}
            <div class="user-avatar tw-rounded-full bg-grey-2 dark:tw-bg-[#081825] tw-mb-1.5
                        {{ in_array($author_access_level, ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                        {{ $brand }}
                        {{ $author_access_level }}
               "
            >
                <div class="tw-no-underline tw-block tw-h-full tw-w-full">
                    <img class="tw-rounded-full"
                         src="{{ $avatar }}"
                         alt="{{ $author }} Avatar"
                         loading="lazy"
                         class="tw-rounded-full"
                    />
                </div>
            </div>


            {{-- Rank Data --}}
            <p class="tw-text-sm tw-uppercase tw-text-center dense font-compressed tw-leading-[1.2]">
                {{ $rank }}
            </p>
            <p
               class="tw-text-sm tw-text-center font-compressed"
               style="margin-top:-3px;"
            >
                {{ parse_xp_value($xp) }} XP
            </p>
        </div>
        <div class="tw-flex tw-flex-col tw-pl-3">
            <h5 class="dark:tw-text-white tw-text-[#00101D] tw-text-sm tw-font-bold tw-mb-1">
                {!! $title !!}
            </h5>
            <h6 class="tw-text-xs tw-text-gray-400 dark:tw-text-[#9EC0DC] tw-text-[#3F3F46] tw-uppercase dark:tw-text-white tw-text-[#00101D] tw-mb-1">
                Posted
                <strong>{{ $date }}</strong>
                by
                <strong>{{ $author }}</strong>
            </h6>
            <p class="tw-text-xs dark:tw-text-white tw-text-[#00101D] tw-flex-1 tw-relative tw-pb-6" style="overflow-wrap: anywhere;">
                {!! substr(str_replace('&nbsp;', '', $post), 0, 100) !!}...
                <span class="tw-inline xl:tw-block tw-font-bold dark:tw-text-white tw-text-[#00101D] tw-underline lg:tw-absolute lg:tw-left-0 lg:tw-bottom-0">See Post &raquo;</span>
            </p>
        </div>
    </a>
</div>
