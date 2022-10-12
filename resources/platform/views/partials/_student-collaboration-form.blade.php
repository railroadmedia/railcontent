<div class="tw-flex tw-flex-row tw-flex-wrap tw-mt-4">
    
    <button class="tw-btn-primary tw-bg-{{ $brand }} tw-m-1 tw-w-full md:tw-w-auto"
            data-open-modal="whatIsModal">
            <i class="fas fa-question-circle"></i>&nbsp; What is Student Collaboration?
    </button>


    <button class="tw-btn-primary tw-bg-{{ $brand }} tw-m-1 tw-w-full md:tw-w-auto"
            data-open-modal="howCreateModal">
            <i class="fas fa-question-circle"></i>&nbsp; How to Create Your Video   
    </button>


    <button class="tw-btn-primary tw-bg-{{ $brand }} tw-m-1 tw-w-full md:tw-w-auto"
            data-open-modal="questionModal">
            Submit a Video <span class="tw-text-3xl tw-leading-none tw-ml-1 tw-mt-0.5">»</span>
    </button>
    
</div>

<div id="whatIsModal" class="modal">
    <div class="flex flex-column corners-10">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/448684113" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="howCreateModal" class="modal">
    <div class="flex flex-column corners-10">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/448684140" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="questionModal" class="modal">
    <div class="flex flex-column tw-bg-white">
        <iframe class="w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSdRIO4-j89ItSXadApA5Q-70Nz1ZMIURvfPfrFZB0olOyYdmw/viewform?embedded=true" height="860" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
    </div>
</div>