@component('partials._header-banner', [
    'hideUser' => true,
    'brand' => $brand,
    'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/method/method-header-'.$brand.'.jpg',
])
    @slot('content')
        <div class="flex flex-column pr-1 align-center">
            @if(!empty($learningPathSlug) && $learningPathSlug == $brand.'-method')
                @if($brand==="drumeo" || $brand==="pianote")
                    <div
                            class="flex flex-column rounded ba-grey-1-2 hover-border-{{ $brand }} text-white hover-text-{{ $brand }} pointer"
                            data-open-modal="previewModal"
                            style="width:80px;"
                    >
                        <div class="square heading">
                                <i
                                    class="fas fa-play absolute-center"
                                    style="margin-left:2px"
                                ></i>
                        </div>
                    </div>
                @endif

                <img
                        alt="{{ $parentContent->fetch('title') }} Logo"
                        src="https://musora-ui.s3.amazonaws.com/logos/{{ $brand }}-method.svg"
                        class="mv-3"
                        style="width:540px;max-width:100%;"
                >
                {{-- todo: re-add if requested --}}
                @if($brand==="drumeo" || $brand==="pianote")
                    <a data-open-modal="surveyModal" class="tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600">
                        WHERE TO BEGIN &nbsp; <i class="fas fa-question-circle tw-text-base"></i> 
                    </a>
                @endif

                {{-- Preview Modal --}}
                <div id="previewModal" class="modal vimeo-embedded-player">
                    <div class="flex flex-column corners-10">
                        @if($brand !== 'drumeo')
                            @php
                            $vimeoUrl = array(
                                'guitareo' => '//player.vimeo.com/video/494183465',
                                'singeo' => '//player.vimeo.com/video/494183465',
                                'pianote' => '//player.vimeo.com/video/494183465',
                            );   
                            @endphp
                            <div class="video-wrap">
                                <div class="widescreen">
                                    <div class="flex flex-column video-player user-active">
                                        <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="{{ $vimeoUrl[$brand] }}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        @else
                        <video-player 
                            ref="learningPathPreview"
                            theme-color="{{ $brand }}"
                            poster="{{ $parentContent['video_poster_image_url'] ?? '' }}"
                            :sources="{{json_encode($parentContent['video_playback_endpoints'])}}"
                            hls-manifest-url=""
                            captions=""
                            :current-second="0"
                            video-id="{{ $parentContent->fetch('fields.video.fields.vimeo_video_id') }}"
                            content-id="{{ $parentContent->fetch('id') }}"
                            user-id="{{ user()->id }}"
                            cast-title="{{ $parentContent->fetch('fields.title') }}"
                            :use-intersection-observer="true"
                            @play="handleVideoPlay"
                            @pause="handleVideoPause"
                            :controls="{
                                backward: false,
                                forward: false,
                                progress: true,
                                play: true,
                                time: true,
                                volume: true,
                                settings: false,
                                fullscreen: false,
                            }"
                        >
                        </video-player>
                        @endif
                        <div class="tw-flex tw-flex-row pv tw-items-center tw-flex-wrap">
                            <h1 class="subheading text-white grow tw-pb-3">
                                {{ $parentContent->fetch('fields.title') }}
                            </h1>
                            <a href="{{ $nextLessonUrl }}"
                               class="tw-btn-primary tw-bg-{{ $brand }}">
                                <i class="fas fa-play mr-1"></i>
                                Start Next Lesson
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Survey Modal --}}
                <div id="surveyModal" class="modal">
                    <div class="flex flex-column corners-10">
                        @if($brand === "drumeo")
                            <div class="typeform-widget" data-url="https://form.typeform.com/to/rnPhq70s?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> 
                        @elseif($brand === "pianote")
                            <div class="typeform-widget" data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> 
                        @endif
                    </div>
                </div>

            @elseif(!empty($learningPathSlug) && $learningPathSlug == 'foundations-2019')
                <p class="text-white font-bold heading tw-capitalize">{{ $brand }} Foundations</p>
                <div class="flex flex-row align-left mt-3">
                    <a href="/{{ $brand }}/resources" class="tw-btn-primary tw-bg-{{ $brand }}">
                        <button class="btn collapse-320">
                            FOUNDATIONS BOOK RESOURCES
                        </button>
                    </a>
                </div>
            @else
                <p class="text-white font-bold heading">{{ $brand }} Method</p>
            @endif
        </div>
    @endslot
@endcomponent
