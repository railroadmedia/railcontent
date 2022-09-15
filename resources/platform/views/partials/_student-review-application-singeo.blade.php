<div class="tw-flex tw-flex-col lg:tw-flex-row tw-flex-wrap tw-mt-2">
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn-primary tw-bg-singeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="howApplyModal">
            <span class="tw-text-white">
                <i class="fas fa-question-circle tw-text-base"></i>
                Tips For Applying
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn-primary tw-bg-singeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="applicationModal">
            <span class="tw-text-white">
                Apply Now »
            </span>
        </button>
    </div>
</div>

{{-- How To Apply Modal --}}
<div id="howApplyModal" class="modal">
    <div class="flex flex-column corners-10">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" 
                            src="//player.vimeo.com/video/712150351" 
                            frameborder="0" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Review Application Modal --}}
@include('partials._review-modal')