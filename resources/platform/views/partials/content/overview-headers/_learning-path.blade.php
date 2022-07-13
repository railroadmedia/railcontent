@component('partials.bladesora.members.components.header-banner', [
    'hideUser' => true,
    'backgroundImage' => $parentContent->fetch('data.header_image_url', ''),
    // 'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
])
    @slot('content')
        <div class="flex flex-column pr-1 align-center">
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

            <img
                alt="{{ $parentContent->fetch('title') }} Logo"
                src="{{ $parentContent->fetch('data.logo_image_url') }}"
                class="mv-3"
                style="width:480px;max-width:100%;"
            >

            <a data-open-modal="surveyModal" class="btn bg-{{ $brand }} text-white collapse-200 short">
                <i class="fas fa-question-circle"></i>&nbsp; WHERE TO BEGIN
            </a>

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
            <div id="surveyModal" class="modal">
                <div class="flex flex-column corners-10">
                    <div class="typeform-widget" data-url="https://form.typeform.com/to/rnPhq70s?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
                </div>
            </div>
        </div>
    @endslot
@endcomponent
