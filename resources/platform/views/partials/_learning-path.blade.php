@component('partials._header-banner', [
    'hideUser' => true,
    'brand' => $brand,
    'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/method/method-header-'.$brand.'.jpg',
])
    @slot('content')
        @section('layout-scripts')
        {{-- Warning: Script tag inside Vue component --}}
        <script>(function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })()</script>
        @stop

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
                    <a data-open-modal="surveyModal" class="tw-btn-primary tw-bg-{{ $brand }}">
                        WHERE TO BEGIN &nbsp; <i class="fas fa-question-circle tw-text-base"></i> 
                    </a>
                @endif

                @php
                 $hardcodedSources = '[{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/240p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=e01c7035b938c5d0ad6a245962d76540080f43c70f974fe88b2fc46d4626c058","width":426,"height":240},{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/360p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=e0e4b1604734a7251f92047867425a5f65f69c343b7fa2a687842b4c64ba2b4b","width":640,"height":360},{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/540p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=8376e49126a65bad4b88508c25525f0cee2e79ec8ca65d371cbe3b26f98d4ec4","width":960,"height":540},{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/720p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=e68fe83449605b177cab0fc05558b8565ba62e772c5aede7770c8dffcb58918a","width":1280,"height":720},{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/1080p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=8719f7b1107fe80db04edf25762405969d1e5538b23b4b906835e10b7e874f10","width":1920,"height":1080},{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/1440p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=55e37c6052112dca72a44fb204f831b81550b8ce2f0bb00eb754cda55689ed61","width":2560,"height":1440},{"file":"https:\/\/player.vimeo.com\/progressive_redirect\/playback\/382231267\/rendition\/2160p\/file.mp4?loc=external&oauth2_token_id=1284792283&signature=b41a25bc4bb12af4c4774c2d79f400338c75ae796d868233dcc39e111e39198d","width":3840,"height":2160}]';   
                @endphp
                
                {{-- Preview Modal --}}
                <div id="previewModal" class="modal">
                    <div class="flex flex-column corners-10">
                        <video-player
                            
                        ref="learningPathPreview"
                        theme-color="drumeo"
                        poster="https://i.vimeocdn.com/video/843279057-358419152f59d5352707c1c85a75724753c93c76973108da1181f0038ca10b7d-d_1280x720?r=pad"
                        :sources="{{json_encode(json_decode($hardcodedSources))}}"
                        hls-manifest-url=""
                        captions=""
                        :current-second="0"
                        video-id="382231267"
                        content-id="241247"
                        user-id="457612"
                        cast-title="The Drumeo Method"
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
                <p class="text-white font-bold heading">Singeo Foundations</p>
                <div class="flex flex-row align-left mt-3">
                    <a href="https://www.singeo.com/resources" class="btn collapse-320">
                        <button class="btn collapse-320">
                            <span class="bg-{{$brand}} text-white short ph-5">
                                FOUNDATIONS BOOK RESOURCES
                            </span>
                        </button>
                    </a>
                </div>
            @else
                <p class="text-white font-bold heading">{{ $brand }} Method</p>
            @endif

        </div>
    @endslot
@endcomponent
