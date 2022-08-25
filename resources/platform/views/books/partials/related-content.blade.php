<div class="content-table-row flex flex-row flex-wrap pa-1 bt-grey-1-1 dark:tw-border-[#445F74]">
    <div class="flex flex-column xs-12 md-5 sm-7">
        <div class="flex flex-row">
            <div class="flex flex-column grow">
                <div class="flex flex-row">
                    <div class="flex flex-column align-v-center grow">
                        <h6 class="tw-font-bold tw-text-black dark:tw-text-white text-truncate-2-lines">{{ $relatedLesson['title'] }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-column xs-12 md-7 mt-2 m-sm-down">
        <div
            class="flex flex-row align-v-center nmh-1"
        >
            <div class="flex flex-column ph-1">
                @if(!empty($relatedLesson['external_link']))
                    <a
                            href="{{ $relatedLesson['external_link'] }}"
                            class="btn short text-pianote flat bg-pianote"
                            target="_blank"
                    >
                        <i class="fas fa-external-link mr-1"></i>
                        <span class="hide-xs-only">Free&nbsp;</span>Lesson
                    </a>
                @endif
            </div>

            <div class="flex flex-column ph-1">
                @if(!empty($relatedLesson['youtube_id']))
                    <button
                        class="btn short open-youtube-lesson"
                        data-open-modal="youtubeLessonModal"
                        data-youtube-id="{{ $relatedLesson['youtube_id'] }}"
                    >
                        <span class="flat bg-black" style="border-color:#ff0000;color:#ff0000;">
                            <i class="fab fa-youtube mr-1"></i>
                            <span class="hide-xs-only">Watch on&nbsp;</span>Youtube
                        </span>
                    </button>
                @endif
            </div>

            <div class="flex flex-column ph-1">
                @if(!empty($relatedLesson['content_id']))
                    @if($hasAccess)
                        <a
                            href="{{ url()->route('platform.content.jump-to-content-id', [$relatedLesson['content_id']]) }}"
                            class="btn short text-pianote flat bg-pianote"
                            target="_blank"
                        >
                            <i class="icon-pianote mr-1"></i>
                            <span class="hide-xs-only">Watch on&nbsp;</span>Pianote
                        </a>
                    @else
                        <button class="btn short" data-open-modal="loginModal">
                            <span class="text-grey-2 bg-grey-2 flat">
                                <i class="fas fa-sign-in mr-1"></i>
                                Login <span class="hide-xs-only">&nbsp;To Pianote</span>
                            </span>
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
