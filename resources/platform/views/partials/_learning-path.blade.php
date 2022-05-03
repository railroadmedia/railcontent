@component('partials._header-banner', [
    'hideUser' => true,
    'brand' => $brand,
    'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/method/method-header-'.$brand.'.jpg',
])
    @slot('content')
        <div class="flex flex-column pr-1 align-center">

            @if(!empty($learningPathSlug) && $learningPathSlug == $brand.'-method')
{{--                <div--}}
{{--                        class="flex flex-column rounded ba-grey-1-2 hover-border-singeo text-white hover-text-singeo pointer"--}}
{{--                        data-open-modal="previewModal"--}}
{{--                        style="width:80px;"--}}
{{--                >--}}
{{--                    <div class="square heading">--}}
{{--                        <i--}}
{{--                                class="fas fa-play absolute-center"--}}
{{--                                style="margin-left:2px"--}}
{{--                        ></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <img
                        alt="{{ $parentContent->fetch('title') }} Logo"
                        src="https://musora-ui.s3.amazonaws.com/logos/{{ $brand }}-method.svg"
                        class="mv-3"
                        style="width:540px;max-width:100%;"
                >

{{-- todo: re-add if requested --}}
{{--                <a data-open-modal="surveyModal" class="btn bg-{{ $brand }} text-white collapse-200 short">--}}
{{--                    <i class="fas fa-question-circle"></i>&nbsp; WHERE TO BEGIN--}}
{{--                </a>--}}
{{--                <div id="surveyModal" class="modal">--}}
{{--                    <div class="flex flex-column corners-10">--}}
{{--                        <div class="typeform-widget" data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @elseif(!empty($learningPathSlug) && $learningPathSlug == 'foundations-2019')
                <p class="text-white font-bold heading">Singeo Foundations</p>
                <div class="flex flex-row align-left mt-3">
                    <a href="https://www.singeo.com/resources" class="btn collapse-320">
                        <button class="btn collapse-320">
                            <span class="bg-singeo text-white short ph-5">
                                FOUNDATIONS BOOK RESOURCES
                            </span>
                        </button>
                    </a>
                </div>
            @else
                <p class="text-white font-bold heading">{{ $brand }} Method</p>
            @endif

            <div id="previewModal" class="modal">
                <div class="flex flex-column corners-10">

{{--                    <video-player--}}
{{--                        ref="learningPathPreview"--}}
{{--                        theme-color="singeo"--}}
{{--                        poster="{{ $parentContent['video_poster_image_url'] ?? '' }}"--}}
{{--                        :sources="{{ json_encode($parentContent['video_playback_endpoints'] ?? []) }}"--}}
{{--                        hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"--}}
{{--                        captions="{{ $parentContent->fetch('fields.video.data.captions', $parentContent['captions'][0] ?? null) }}"--}}
{{--                        :current-second="0"--}}
{{--                        video-id="{{ $parentContent->fetch('fields.video.fields.vimeo_video_id') }}"--}}
{{--                        content-id="{{ $parentContent->fetch('id') }}"--}}
{{--                        user-id="{{ current_user()->getId() }}"--}}
{{--                        cast-title="{{ $parentContent->fetch('fields.title') }}"--}}
{{--                        :use-intersection-observer="true"--}}
{{--                        @play="handleVideoPlay"--}}
{{--                        @pause="handleVideoPause"--}}
{{--                        :controls="{--}}
{{--                            backward: false,--}}
{{--                            forward: false,--}}
{{--                            progress: true,--}}
{{--                            play: true,--}}
{{--                            time: true,--}}
{{--                            volume: true,--}}
{{--                            settings: false,--}}
{{--                            fullscreen: false,--}}
{{--                        }"--}}
{{--                    >--}}
{{--                    </video-player>--}}
                    <div class="video-wrap">
                        <div class="widescreen">
                            <div class="flex flex-column video-player user-active">
                                <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/494183465" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row pv align-v-center">
                        <h1 class="subheading text-white grow">
                            {{ $parentContent->fetch('fields.title') }}
                        </h1>

                        <a href="{{ $nextLessonUrl }}"
                           class="btn bg-singeo text-white collapse-250 short ml-1">
                            <i class="fas fa-play mr-1"></i>
                            Start Next Lesson
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endslot
@endcomponent
