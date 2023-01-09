<div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-color:#000718;">
    <div class="container mx-auto clearfix" style="max-width:940px">
        <div class="text-center sm:px-3">
            {!! $img !!}
            <div class="video-row relative my-4 sm:my-7">
                @hasSection('prev-thumb')
                    <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -10%;width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('prev-thumb')">
                @endif

                @hasSection ('video')
                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full inset-0" src="@yield('video')" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif

                @hasSection('next-thumb')
                    <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 110%;width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('next-thumb')">
                @endif
            </div>
        </div>
        <div class="title-header-interaction text-center">
            <div class="px-2 md:px-3">
                <h3><strong>@yield('title')</strong></h3>
                @hasSection('lesson-number')
                    <p class="@if($brandColor === 'guitareo')text-guitareo @endif mt-1 sm:mt-2" @if($brandColor === 'yellow') style="color:#F8C849;" @endif>@yield('lesson-number')</p>
                @endif
            </div>
        </div>
        <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons">
            <div class="mb-2 sm:mb-0 w-full sm:w-1/4 float-left px-2 md:px-3">
                @hasSection('previous')
                    <a class="button outline @if($brandColor == 'yellow') yellow @else guitareo @endif block" href="@yield('previous')">
                        <i class="fas fa-chevron-left"></i> Prev
                    </a>
                @else
                    <span class="hidden sm:inline">&nbsp;</span>
                @endif
            </div>

            <div class="mb-2 sm:mb-0 w-full sm:w-2/4 float-left px-2 md:px-3">
                <a class="button outline @if($brandColor == 'yellow') yellow @else guitareo @endif block" href="{{ $allLessons }}">
                    All Lessons
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>
            <div class="w-full sm:w-1/4 float-left px-2 md:px-3 next-lesson-button">
                @hasSection('next')
                    <a class="button outline @if($brandColor == 'yellow') yellow @else guitareo @endif block" href="@yield('next')">
                        @hasSection('next-text')
                            @yield('next-text')
                        @else
                            Next
                        @endif
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="hidden sm:inline">&nbsp;</span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="px-3 py-6 sm:py-10">
    <div class="container mx-auto clearfix" style="max-width:920px">
        <div class="text-left lesson-text">
            @hasSection('description')
                <p>
                    @yield('description')
                </p>
                <hr class="my-3 sm:my-5">
            @endif
            @hasSection('assignments')
                <h4 class="mb-1 sm:mb-3"><strong>Assignments</strong></h4>
                @yield('assignments')
            @endif
            <h4 class="mb-1 sm:mb-3 mt-12"><strong>Assets</strong></h4>
            @hasSection('assets')
                @yield('assets')
            @endif
            @include('guitareo.lead-gen.free-acoustic-guitar-lessons._assignment-resources', [
                "title" => "Course Resources",
                "zipURL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/getting-started-on-the-acoustic-guitar.zip"
            ])
        </div>
    </div>
</div>
