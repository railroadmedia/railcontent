<div class="tw-overflow-hidden tw-text-white tw-px-3 tw-py-5 sm:tw-py-7" style="background-color:#000718;">
    <div class="tw-container tw-mx-auto tw-clearfix" style="max-width:940px">
        <div class="tw-text-center sm:tw-px-3">
            {!! $img !!}
            <div class="video-row tw-relative tw-my-4 sm:tw-my-7">
                @hasSection('prev-thumb')
                    <img class="tw-hidden lg:tw-block tw-absolute tw-top-1/2 tw-opacity-30" style="transform: translate(-100%, -50%); left: -10%;width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('prev-thumb')">
                @endif

                @hasSection ('video')
                    <div class="tw-aspect-16:9 tw-w-full tw-relative">
                        <iframe class="tw-absolute tw-w-full tw-h-full tw-inset-0" src="@yield('video')" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif

                @hasSection('next-thumb')
                    <img class="tw-hidden lg:tw-block tw-absolute tw-top-1/2 tw-opacity-30" style="transform: translateY(-50%);left: 110%;width: 80%;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@yield('next-thumb')">
                @endif
            </div>
        </div>
        <div class="title-header-interaction tw-text-center">
            <div class="tw-px-2 md:tw-px-3">
                <h3><strong>@yield('title')</strong></h3>
                @hasSection('lesson-number')
                    <p class="@if($themeColor === 'guitareo')text-guitareo @endif tw-mt-1 sm:tw-mt-2" @if($themeColor === 'yellow') style="color:#F8C849;" @endif>@yield('lesson-number')</p>
                @endif
            </div>
        </div>
        <div class="tw-text-center tw-mt-3 sm:tw-mt-7 tw-clearfix lesson-buttons">
            <div class="tw-mb-2 sm:tw-mb-0 tw-w-full sm:tw-w-1/4 tw-float-left tw-px-2 md:tw-px-3">
                @hasSection('previous')
                    <a class="button outline @if($themeColor == 'yellow') yellow @else guitareo @endif tw-block" href="@yield('previous')">
                        <i class="fas fa-chevron-left"></i> Prev
                    </a>
                @else
                    <span class="tw-hidden sm:tw-inline">&nbsp;</span>
                @endif
            </div>

            <div class="tw-mb-2 sm:tw-mb-0 tw-w-full sm:tw-w-2/4 tw-float-left tw-px-2 md:tw-px-3">
                <a class="button outline @if($themeColor == 'yellow') yellow @else guitareo @endif tw-block" href="{{ $allLessons }}">
                    All Lessons
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>
            <div class="tw-w-full sm:tw-w-1/4 tw-float-left tw-px-2 md:tw-px-3 next-lesson-button">
                @hasSection('next')
                    <a class="button outline @if($themeColor == 'yellow') yellow @else guitareo @endif tw-block" href="@yield('next')">
                        @hasSection('next-text')
                            @yield('next-text')
                        @else
                            Next
                        @endif
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="tw-hidden sm:tw-inline">&nbsp;</span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="tw-px-3 tw-py-6 sm:tw-py-10">
    <div class="tw-container tw-mx-auto tw-clearfix" style="max-width:920px">
        <div class="tw-text-left lesson-text">
            @hasSection('description')
                <p>
                    @yield('description')
                </p>
                <hr class="tw-my-3 sm:tw-my-5">
            @endif
            @hasSection('assignments')
                <h4 class="tw-mb-1 sm:tw-mb-3"><strong>Assignments</strong></h4>
                @yield('assignments')
            @endif
            <h4 class="tw-mb-1 sm:tw-mb-3 tw-mt-12"><strong>Assets</strong></h4>
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
