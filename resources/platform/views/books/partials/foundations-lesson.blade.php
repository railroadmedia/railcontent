<a
    @if($hasAccess)
    href="{{ $members_url }}"
    @endif
    class="content-table-row flex flex-row flex-wrap pa-1 hover-bg-grey-7 bt-grey-1-1 dark:hover:tw-bg-[#002039] dark:tw-border-[#445F74] no-decoration"
>
    <div class="flex flex-column xs-12 sm-7">
        <div class="flex flex-row">
            <div class="flex flex-column thumbnail-col">
                <div class="thumb-wrap corners-3 overflow">
                    <div class="thumb-img widescreen bg-center">
                        <img
                            src="{{ $thumbnail }}"
                            data-ix-src="{{ $thumbnail }}"
                            data-ix-fade
                            alt="{{ $title }} Thumbnail"
                        >
                    </div>
                </div>
            </div>

            <div class="flex flex-column grow">
                <div class="flex flex-row">
                    <div class="flex flex-column align-v-center grow pl-1">
                        <h6 class="body font-bold text-black text-truncate-2-lines">{{ $title }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-column xs-12 md-5 mt-2 m-sm-down">
        <div class="flex flex-row align-v-center align-h-right nmh-1">
            <div class="flex flex-column xs-12 sm-4 ph-1">
                @if($hasAccess)
                    <button class="btn short">
                        <span class="text-pianote flat bg-pianote">
                            <i class="icon-pianote mr-1"></i>
                            Watch on Pianote
                        </span>
                    </button>
                @else
                    <button class="btn short" data-open-modal="loginModal">
                        <span class="text-grey-2 bg-grey-2 flat">
                            <i class="fas fa-sign-in mr-1"></i>
                            Login To Pianote
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</a>
