<div class="video-interaction acoustic py-5 px-3 md:py-7 md:px-3 lg:px-10" style="background:#191B1C;">
    <div class="container clearfix lg:mx-auto max-w-6xl">
        <div class="title-header-interaction text-white">
            <div class="w-5/6">
                <h1 class="font-bold text-xl leading-tight mx-auto mb-1 md:text-3xl md:mb-3 lg:text-4xl">{{ $title }}</h1>
                <h2 class="leading-tight mx-auto uppercase md:text-lg lg:text-xl">from <strong><a href="/acoustic-guitar-jumpstart/course-index/" style="color:{{ $themeColor }};">{{ $fromText }}</a></strong></h2>
            </div>
        </div>
        <div class="aspect-16:9 w-full relative my-4 mx-auto md:my-6">
            <iframe class="absolute w-full h-full inset-0" src="{{ $video }}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="user-interaction flex justify-between flex-col sm:flex-row">
            <div class="mb-2 sm:mb-0 w-full sm:w-1/6 lesson-navigator previous-lesson">
                @isset($previous)
                    <a href="{{ $previous }}" style="color:{{ $themeColor }}; border-color:{{ $themeColor }};">
                        <i class="fas fa-chevron-left"></i> PREV
                    </a>
                @endisset
            </div>
            <div class="mb-2 sm:mb-0 w-full sm:w-1/2 lesson-navigator">
                <a href="{{ $allLessons }}" style="color:{{ $themeColor }}; border-color:{{ $themeColor }};">
                    <i class="fas fa-chevron-up"></i>&nbsp; All Lessons</span>
                </a>
            </div>
            <div class="w-full sm:w-1/6 lesson-navigator next-lesson">
                @isset($next)
                    <a href="{{ $next }}" style="color:{{ $themeColor }}; border-color:{{ $themeColor }};">
                    NEXT <i class="fas fa-chevron-right"></i>
                </a>
                @endisset
            </div>
        </div>
    </div>
</div>
<div class="resource-sidebar acoustic pt-5 pb-7 md:pt-7 md:pb-15 lg:pt-10 lg:pb-20">
    <div class="container clearfix lg:mx-auto max-w-6xl">
        <div class="text-center mx-auto mb-5 md:mb-0 px-4 md:px-5">
            @isset($resources)
                <div class="text-left w-full">
                    <p class="leading-7 mx-auto" style="font-size:15px;">
                        {!! $resources !!}
                    </p>
                </div>
                <hr class="my-10 @hasSection('assignments') hidden @endif" />
            @endisset

            @hasSection('assignments')
                <h4 class="mb-1 sm:mb-3 text-left"><strong>Assignments</strong></h4>
                @yield('assignments')
            @endif

            @hasSection('assets')
                <h4 class="mb-1 sm:mb-3 mt-12 text-left"><strong>Assets</strong></h4>
                @yield('assets')
                <div class="mb-10"></div>
            @endif

            @isset($PDF)
                <div class="px-3 md:px-4">
                    <a target="_blank" href="{{ $PDF }}" class="download-button big w-full"><i class="fas fa-download"></i> Download PDF</a>
                </div>
                <br><br>
            @endisset

            <div class="text-left">
                <h1>Tell us what you loved about these videos!</h1>
                <p>(We’re always using student feedback for future releases.)</p>
            </div>
            <div id="disqus_thread"></div>
        </div>
    </div>
</div>
