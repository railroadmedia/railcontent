<div class="lessons-pack-card flex flex-row ph-1 pt-3">
    <div class="flex flex-column align-v-center large-thumbnail guitareo">
        <div class="thumb-wrap corners-10">
            <a href="{{ $lessonsUrl }}">
                <div class="thumb-img bg-center corners-10 square">
                    <img
                        src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
                        data-ix-src="{{ $itemThumbnail }}"
                        data-ix-fade
                        class="bg-grey-2"
                        alt="{{ $itemTitle }} Thumbnail"
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
                class="btn bg-{{ $themeColor }} text-white collapse-250 go-to-button mt-1"
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
                    class="btn bg-black text-black inverted short collapse-200 mt-1"
                >
                    <i class="fas fa-arrow-circle-right mr-1"></i> See Lessons
                </a>
            @endif
        </div>
    </div>
</div>
