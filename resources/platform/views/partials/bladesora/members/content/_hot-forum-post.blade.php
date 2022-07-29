<div class="tw-flex tw-flex-col tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-rounded pa-2 hover:tw-shadow-lg">
    <a href="{{ $url }}" class="tw-flex tw-flex-row tw-no-underline">
        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white hot-forum-avatar-col">
            <img
                src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
                data-ix-src="{{ $avatar }}"
                data-ix-fade
                class="tw-bg-gray-300 tw-rounded-full tw-mb-1"
                alt="{{ $author }} Avatar"
            >
            <p class="tw-text-sm tw-uppercase tw-text-center dense font-compressed">
                {{ $rank }}
            </p>
            <p
               class="tw-text-sm tw-text-center font-compressed"
               style="margin-top:-3px;"
            >
                {{ parse_xp_value($xp) }} XP
            </p>
        </div>
        <div class="tw-flex tw-flex-col tw-flex-grow tw-pl-3">
            <h5 class="dark:tw-text-white tw-text-[#00101D] tw-text-sm tw-font-bold tw-mb-1">
                {!! $title !!}
            </h5>
            <h6 class="tw-text-xs tw-text-gray-400 dark:tw-text-[#9EC0DC] tw-text-[#3F3F46] tw-uppercase dark:tw-text-white tw-text-[#00101D] tw-mb-1">
                Posted
                <strong class="tw-text-{{ $brand }}">{{ $date }}</strong>
                by
                <strong class="tw-text-{{ $brand }}">{{ $author }}</strong>
            </h6>
            <p class="tw-text-xs dark:tw-text-white tw-text-[#00101D] tw-break-words">
                {!! str_replace('&nbsp;', '', $post) !!}...
                <span class="tw-font-bold dark:tw-text-white tw-text-[#00101D] tw-ml-1 tw-underline">See Post &raquo;</span>
            </p>
        </div>
    </a>
</div>