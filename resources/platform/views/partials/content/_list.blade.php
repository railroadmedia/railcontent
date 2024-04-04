<div class="flex flex-row mb-3">
    <div class="flex flex-column grow">
        <div class="flex flex-row align-v-center pv-2">
        <span class="rounded bg-{{ $brand }} text-white icon-bg-circle body mr-1">
            <i class="{{ $sectionIconClasses }}"></i>
        </span>

            <a
                href="{{ $sectionUrl }}"
                aria-label="{{ $sectionUrlLabel }}"
                class="text-black no-decoration heading capitalize grow"
            >
                {{ $sectionLabel }}
            </a>

            <a
                href="{{ $sectionUrl }}"
                aria-label="{{ $sectionUrlLabel }}"
                class="text-{{ $brand }} tw-text-xs no-decoration nowrap raised-hover pa-1 dense font-bold uppercase corners-10">
                See All
            </a>
        </div>

        <div class="flex flex-row six-cards-row">
            <transition appear name="fade">
                <content-catalogue
                    brand="{{ $brand }}"
                    catalogue-type="grid"
                    limit="16"
                    theme-color="{{ $brand }}"
                    :use-theme-color="true"
                    :lock-unowned="true"
                    :force-wide-thumbs="true"
                    :pre-loaded-content="{{ $preLoadedContent }}"
                    content-endpoint="/railcontent/content"
                >
                    <div class="flex flex-row nmh-1">
                        @for($i = 0; $i < 6; $i++)
                            @include('bladesora::members.skeletons.card-item')
                        @endfor
                    </div>
                </content-catalogue>
            </transition>
        </div>
    </div>
</div>
