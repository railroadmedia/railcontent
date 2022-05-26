<div class="tw-flex tw-flex-col lg:tw-flex-row tw-flex-wrap tw-mt-2">
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn-primary tw-bg-drumeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="whatIsModal">
            <span class="tw-text-white">
                What is Student Review?
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn-primary tw-bg-drumeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="howApplyModal">
            <span class="tw-text-white">
                How to Apply
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn-primary tw-bg-drumeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="applicationModal">
            <span class="tw-text-white">
                Apply Now
            </span>
        </button>
    </div>
</div>

<div id="whatIsModal" class="modal">
    <div class="flex flex-column corners-10">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/450154189" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="howApplyModal" class="modal">
    <div class="twflex tw-flex-col tw-rounded-[10px]">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/450152568" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Review Application Modal --}}
@include('partials._review-modal-drumeo');