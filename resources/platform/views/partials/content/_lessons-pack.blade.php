<div class="lessons-pack-card flex flex-row ph-1 pt-3">
    <div class="flex flex-column align-v-center large-thumbnail guitareo">
        <div class="thumb-wrap corners-10">
            <a href="{{ $lessonsUrl }}">
                <div class="thumb-img bg-center corners-10 square bg-grey-2 dark:tw-bg-[#081825]">
                    <img
                        src="{{ $itemThumbnail }}"
                        alt="{{ $itemTitle }} Thumbnail"
                        class="tw-transition-opacity tw-opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('tw-opacity-0')"
                    >

                    @if(!empty($logoImage))
                        <div class="logo-image pa-1 corners-bottom-3">
                            <img
                                src="{{ $logoImage }}"
                                alt="{{ $itemTitle }} Logo">
                        </div>
                    @endif
                </div>
            </a>
        </div>
        <div class="flex flex-column align-h-center mt-1">
            <a
                href="{{ $nextItemUrl }}"
                class="tw-btn-primary tw-bg-{{ $brand }}"
            >

                @if($itemProgress === 'started')
                    <i class="fas fa-play mr-1"></i>
                    Next Lesson
                @elseif($itemProgress === 'completed')
                    <i class="fas fa-check-circle mr-1"></i>
                    Completed
                @else
                    <i class="fas fa-play mr-1"></i>
                    First Lesson
                @endif
            </a>

            @if(!empty($lessonsUrl))
                <a
                    href="{{ $lessonsUrl }}"
                    class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white"
                >
                    <i class="fas fa-arrow-circle-right mr-1"></i> See Lessons
                </a>
            @endif
        </div>
    </div>
</div>
