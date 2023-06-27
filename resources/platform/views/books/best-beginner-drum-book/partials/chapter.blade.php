@if($hasAccess)
    <a href="{{ $contentLink }}" class="content-table-row flex flex-row pv-1 bt-grey-1-1 no-decoration wrap-on-mobile">
@else
    <div class="content-table-row flex flex-row pv-1 bt-grey-1-1 pointer wrap-on-mobile" data-open-modal="loginModal">
@endif
        <div class="flex flex-column thumbnail-col book-thumbnail pa-1">
            <div class="thumb-wrap corners-3 overflow">
                <div class="thumb-img box-4-by-3 bg-center"
                     style="background-image:url({{ $thumbnail }});"></div>

                <span class="thumb-hover flex-center heading">
                    <i class="fas {{ $hasAccess ? 'fa-arrow-circle-right' : 'fa-sign-in' }}"></i>
                </span>
            </div>
        </div>

        <div class="flex flex-column grow">
            <div class="flex flex-row">
                <div class="flex flex-column align-v-center grow pa-1">
                    <p class="tiny text-drumeo uppercase">Chapter {{ $chapterNumber }} - {{ $chapterTitle }}</p>
                    <h6 class="body font-bold text-black dark:tw-text-white">{{ $title }}</h6>
                    <p class="tiny text-black dark:tw-text-white">{{ $description }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-column xs-1 hide-xs-only"></div>

        @if($hasAccess)
            <div class="flex flex-column icon-col align-v-center hide-xs-only">
                <div class="square body">
                    <i class="fas fa-arrow-circle-right flex-center text-light rounded"></i>
                </div>
            </div>
        @else
            <div class="flex flex-column ph login-col align-center">
                <button class="btn btn-tiny"
                        style="white-space:nowrap;"
                        title="Login To Drumeo"
                        data-open-modal="loginModal">

                        <span class="text-grey-2 bg-grey-2 inverted ph-2 short">
                            <i class="fas fa-sign-in mr-1"></i> Login To Drumeo
                        </span>
                </button>
            </div>
        @endif
@if($hasAccess)
    </a>
@else
    </div>
@endif
