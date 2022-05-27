@component('partials._header-banner', [
    'hideUser' => true,
    'brand' => $brand,
    'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/method/method-header-'.$brand.'.jpg',
])
    @slot('content')
        <div class="flex flex-column pr-1 align-center">

            @if(!empty($learningPathSlug) && $learningPathSlug == $brand.'-method')
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
                        src="https://musora-ui.s3.amazonaws.com/logos/{{ $brand }}-method.svg"
                        class="mv-3"
                        style="width:540px;max-width:100%;"
                >
                {{-- todo: re-add if requested --}}
                @if($brand !== "guitareo")
                    <a data-open-modal="surveyModal" class="tw-btn-primary tw-bg-{{ $brand }}">
                        WHERE TO BEGIN &nbsp; <i class="fas fa-question-circle tw-text-base"></i> 
                    </a>
                @endif

               {{-- Survey Modal --}}
               <div id="surveyModal" class="modal">
                   <div class="flex flex-column corners-10">
                        @if($brand === "drumeo")
                            <div class="typeform-widget" data-url="https://form.typeform.com/to/rnPhq70s?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
                        @elseif($brand === "pianote")
                            <div class="typeform-widget" data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
                        @elseif($brand === "singeo")
                            <div class="typeform-widget" data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet" style="width: 100%; height: 600px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
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

            <div id="previewModal" class="modal">
                <div class="flex flex-column corners-10">                    
                    <div class="video-wrap">
                        <div class="widescreen">
                            <div class="flex flex-column video-player user-active">
                                @if($brand==="drumeo")
                                    <video playsinline="" preload="metadata" poster="https://i.vimeocdn.com/video/843279057-358419152f59d5352707c1c85a75724753c93c76973108da1181f0038ca10b7d-d_1280x720?r=pad" src="https://player.vimeo.com/progressive_redirect/playback/382231267/rendition/1440p/file.mp4?loc=external&amp;oauth2_token_id=1284792283&amp;signature=55e37c6052112dca72a44fb204f831b81550b8ce2f0bb00eb754cda55689ed61"><!----></video>
                                @elseif($brand==="pianote")
                                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/494183465" frameborder="0" allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
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
