<div class="video-interaction acoustic tw-py-5 tw-px-3 md:tw-py-7 md:tw-px-3 lg:tw-px-10" style="background:#191B1C;">
    <div class="tw-container clearfix lg:tw-mx-auto tw-max-w-6xl">
        <div class="title-header-interaction tw-text-white">
            <div class="tw-w-5/6">
                <h1 class="tw-font-bold tw-text-xl tw-leading-tight tw-mx-auto tw-mb-1 md:tw-text-3xl md:tw-mb-3 lg:tw-text-4xl">{{ $title }}</h1>
                <h2 class="tw-leading-tight tw-mx-auto tw-uppercase md:tw-text-lg lg:tw-text-xl">from <strong><a href="/acoustic-guitar-jumpstart/course-index/" style="color:{{ $themeColor }};">{{ $fromText }}</a></strong></h2>
            </div>
        </div>
        <div class="tw-aspect-16:9 tw-w-full tw-relative tw-my-4 tw-mx-auto md:tw-my-6">
            <iframe class="tw-absolute tw-w-full tw-h-full tw-inset-0" src="{{ $video }}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="user-interaction tw-flex tw-justify-between tw-flex-col sm:tw-flex-row">
            <div class="tw-mb-2 sm:tw-mb-0 tw-w-full sm:tw-w-1/6 lesson-navigator previous-lesson">
                @isset($previous)
                    <a href="{{ $previous }}" style="color:{{ $themeColor }}; border-color:{{ $themeColor }};">
                        <i class="fas fa-chevron-left"></i> PREV
                    </a>
                @endisset
            </div>
            <div class="tw-mb-2 sm:tw-mb-0 tw-w-full sm:tw-w-1/2 lesson-navigator">
                <a href="{{ $allLessons }}" style="color:{{ $themeColor }}; border-color:{{ $themeColor }};">
                    <i class="fas fa-chevron-up"></i>&nbsp; All Lessons</span>
                </a>
            </div>
            <div class="tw-w-full sm:tw-w-1/6 lesson-navigator next-lesson">
                @isset($next)
                    <a href="{{ $next }}" style="color:{{ $themeColor }}; border-color:{{ $themeColor }};">
                    NEXT <i class="fas fa-chevron-right"></i>
                </a>
                @endisset
            </div>
        </div>
    </div>
</div>
<div class="resource-sidebar acoustic tw-pt-5 tw-pb-7 md:tw-pt-7 md:tw-pb-15 lg:tw-pt-10 lg:tw-pb-20">
    <div class="tw-container clearfix lg:tw-mx-auto tw-max-w-6xl">
        <div class="tw-text-center tw-mx-auto tw-mb-5 md:tw-mb-0 tw-px-4 md:tw-px-5">
            @isset($resources)
                <div class="tw-text-left tw-w-full">
                    <p class="tw-leading-7 tw-mx-auto" style="font-size:15px;">
                        {!! $resources !!}
                    </p>
                </div>
                <hr class="tw-my-10 @hasSection('assignments') tw-hidden @endif" />
            @endisset

            @hasSection('assignments')
                <h4 class="tw-mb-1 sm:tw-mb-3 tw-text-left"><strong>Assignments</strong></h4>
                @yield('assignments')
            @endif

            @hasSection('assets')
                <h4 class="tw-mb-1 sm:tw-mb-3 tw-mt-12 tw-text-left"><strong>Assets</strong></h4>
                @yield('assets')
                <div class="tw-mb-10"></div>
            @endif
            
            @isset($PDF)
                <div class="tw-px-3 md:tw-px-4">
                    <a target="_blank" href="{{ $PDF }}" class="download-button big tw-w-full"><i class="fas fa-download"></i> Download PDF</a>
                </div>
                <br><br>                        
            @endisset

            <div class="tw-text-left">
                <h1>Tell us what you loved about these videos!</h1>
                <p>(We’re always using student feedback for future releases.)</p>
            </div>
            <div id="disqus_thread"></div>
        </div>
    </div>
</div>