<div class="content-table-row flex flex-row flex-wrap pv-1 bt-grey-1-1">
    <div class="flex flex-column xs-12 sm-7">
        <div class="flex flex-row">
            <div class="flex flex-column thumbnail-col">
                <div class="thumb-wrap corners-3 overflow">
                    <div class="thumb-img widescreen bg-center"
                         style="background-image:url({{ $thumbnail }});"></div>
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
        <div
            class="flex flex-row align-v-center"
            style="margin-left:-0.625rem;margin-right:-0.625rem;"
        >
            <div class="flex flex-column xs-6 ph-1">
                @if(!empty($youtube_id))
                    <button
                        class="btn short open-youtube-lesson"
                        data-open-modal="youtubeLessonModal"
                        data-youtube-id="{{ $youtube_id }}"
                    >
                        <span class="inverted bg-black" style="border-color:#ff0000;color:#ff0000;">
                            <i class="fab fa-youtube mr-1"></i>
                            <span class="hide-xs-only">Watch on&nbsp;</span>Youtube
                        </span>
                    </button>
                @endif
            </div>
            <div class="flex flex-column xs-6 ph-1">
                @if($hasAccess)
                    <a
                        href="{{ $members_url }}" class="btn short text-drumeo inverted bg-drumeo"
                        target="_blank">
                        <i class="icon-drumeo-method mr-1"></i>
                        <span class="hide-xs-only">Watch on&nbsp;</span>Drumeo
                    </a>
                @else
                    <button class="btn short" data-open-modal="loginModal">
                        <span class="text-grey-2 bg-grey-2 inverted">
                            <i class="fas fa-sign-in mr-1"></i>
                            Login <span class="hide-xs-only">&nbsp;To Drumeo</span>
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>