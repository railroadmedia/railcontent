@component('partials.bladesora.members.components.header-banner', [
    'hideUser' => true,
    'backgroundImage' => $learningPath->fetch('data.header_image_url', ''),
])
    @slot('content')
        <div class="flex flex-column pr-1 align-center">
            <div
                    class="flex flex-column mb-5 rounded ba-grey-1-2 hover-border-{{ $brand }} text-white hover-text-{{ $brand }} pointer"
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

            <div class="flex flex-row align-center mb-2">
                <img
                    alt="{{ $learningPath->fetch('title') }} Logo"
                    src="{{ $learningPath->fetch('data.logo_image_url') }}"
                    style="width:200px;height:auto;"
                >
                <h2 class="subheading uppercase text-white">
                    &nbsp;- Level {{ $parentContent->fetch('sort', 0) + 1 }}
                </h2>
            </div>

            <h1 class="display text-white mb-1">
                {{ $parentContent->fetch('fields.title') }}
            </h1>

            <div id="previewModal" class="modal">
                <div class="flex flex-column corners-10">

                    <video-player
                            ref="learningPathPreview"
                            theme-color="{{ $brand }}"
                            poster="{{ $parentContent['video_poster_image_url'] ?? '' }}"
                            :sources="{{ json_encode($parentContent['video_playback_endpoints'] ?? []) }}"
                            hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"
                            captions="{{ $parentContent->fetch('fields.video.data.captions', $parentContent['captions'][0] ?? null) }}"
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

                    <div class="flex flex-row pv align-v-center">
                        <h1 class="subheading text-white grow">
                            {{ $parentContent->fetch('fields.title') }}
                        </h1>

                        <a href="{{ $nextLessonUrl }}"
                           class="btn bg-{{ $brand }} text-white collapse-250 short ml-1">
                            <i class="fas fa-play mr-1"></i>
                            Start Next Lesson
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endslot
@endcomponent
