{{-- @php
    $projectId = env('SANITY_CMS_PROJECT_ID');
    $dataset = env('SANITY_CMS_DATASET');
    $token = env('SANITY_API_TOKEN');

    $slug = $slug ?? null;
    $accessibleVideosCount = $accessibleVideosCount ?? 5;

    $lessons = $lessons ?? [];

    if (!empty($slug)) {
        $query = '*[_type == "challenge" && slug.current == "' . $slug . '"]{
            "children": child[]->{
                title,
                "image": thumbnail.asset->url,
                "video": video{
                    "externalId": external_id
                }
            }
        }';

        $url = "https://{$projectId}.api.sanity.io/v1/data/query/{$dataset}?query=" . urlencode($query);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}"
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        $data = json_decode($response, true);
        curl_close($ch);

        if (isset($data['result'][0]['children'])) {
            foreach ($data['result'][0]['children'] as $index => $child) {
                $lessons[] = [
                    'thumb' => $child['image'],
                    'title' => $child['title'],
                    'name' => strtolower(str_replace(' ', '', $child['title'])),
                    'videoId' => $index < $accessibleVideosCount ? $child['video']['externalId'] : null
                ];
            }
        }
    }

    if ($slug == '30-day-drummer') {
        unset($lessons[1], $lessons[2], $lessons[3]);
        $lessons = array_values($lessons);
    }
@endphp --}}

<div class="@if(!empty($lightMode)) text-black @else text-white @endif md:flex" x-data="{ visible: false, showVideoModal: false, videoId: '{{ collect($lessons)->pluck('videoId')->first() }}', currentVideoIndex: 0, unlock: false }">
    <div class="pb-4 md:w-7/12 lg:w-8/12 md:pr-4 flex-shrink-0 text-left">
        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" role="button"
            @click="currentVideoIndex = 0; videoId = '{{ collect($lessons)->pluck('videoId')->first() }}'; showVideoModal = true; loadAndPlayVideo(videoId, currentVideoIndex);">
            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
            <img class="absolute inset-0 overflow-hidden object-cover w-full h-full z-0 opacity-0 transition-opacity"
                loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ collect($lessons)->first()['thumb'] }}"
                alt="Thumbnail for tutorial video" />
        </div>
        <div class="@if(!empty($lightMode)) text-[#3B3B3B] @endif mt-5 lg:mt-8">
            <h4 class="leading-tight"><strong>{!! $title !!}</strong></h4>
            <p class="mt-2">
                <span>
                    {!! $description !!}
                </span>
                <br>
                @if(!empty($specs))
                    <span class="inline-block mt-4 lg:mt-8 leading-loose md:leading-relaxed">
                        {!! $specs !!}
                    </span>
                @endif
            </p>
        </div>
    </div>

    <div x-show="showVideoModal" x-on:keydown.escape.prevent.stop="showVideoModal = false; pauseVideo();"
         class="fixed inset-0 overflow-y-auto" style="display: none; z-index: 2147483002;" role="dialog" aria-modal="true">
        <div x-show="showVideoModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-80"
             style="z-index: 1005;" @click="showVideoModal = false; pauseVideo();"></div>
    
        <div x-show="showVideoModal" x-transition class="relative min-h-screen flex items-center justify-center px-4"
             style="z-index: 1006;" @click="showVideoModal = false; pauseVideo();">
            <i class="fa-light fa-times fa-2x fixed top-16 right-2 cursor-pointer text-5xl z-150 text-white"
               @click="showVideoModal = false; pauseVideo();"></i>
            <div x-on:click.stop class="relative w-full max-w-6xl overflow-hidden rounded-xl">
                <div class="relative w-full" style="padding-top: 56.25%;">
                    <div id="vimeo-player" class="absolute inset-0 w-full h-full"></div>
                </div>
                <a class="w-full sm:w-2/3 md:max-w-[320px] join smaller {{ $theme }} mt-4"
                   x-show="showVideoModal" 
                   @click="
                       @if (empty($unlocked) && empty($simpleModal))
                           unlock = true;
                           showSignUpModal();
                       @else
                           nextLesson();
                       @endif
                   ">Next Lesson <i class="fas fa-chevrons-right"></i>
                </a>
            </div>
        </div>
    </div>

@if (empty($unlocked)) 
<div id="sign-up-modal" class="fixed inset-0 overflow-y-auto" style="display: none; z-index: 2147483002;" role="dialog" aria-modal="true">
        <div class="relative min-h-screen flex items-center justify-center px-4  @if(!empty($simpleModal))bg-black bg-opacity-80 @else bg-[#404040E5] bg-opacity-90 @endif"
            style="z-index: 1006;">
            {{-- <i class="fa-light fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl z-150 modal-close"></i> --}}

            <div class="relative overflow-y-visible px-4 md:px-5 lg:px-7 py-5 md:py-7 mx-auto text-center">
                @if(!empty($simpleModal))
                    <div
                        class="text-white relative overflow-y-visible px-4 md:px-5 lg:px-7 py-5 md:py-7 mx-auto text-center">
                        <h1 class="text-{{ $theme }}"><i class="fas fa-lock"></i></h1>
                        <h3 class="leading-tight my-6">
                            <strong>Start your free trial to<br class="hidden sm:inline"> continue watching</strong>
                        </h3>
                        <a class="join {{ $theme }} smaller modal-close" href="{{$link}}">{!!$cta!!} <i class="fas fa-chevrons-right"></i></a>
                    </div>
                @else
                    <div class="fixed inset-0 z-50 overflow-y-auto"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <div class="fixed inset-0"></div>
                        <div class="relative min-h-screen flex items-center justify-center p-4">
                            <div class="relative bg-white rounded-xl max-w-2xl w-full p-6 md:p-10 lg:p-16">
                                @php
                                    $forms = [
                                        '30-day-drummer' => [
                                            'header' => '<img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/marketing/drumeo/products/30-day-drummer/30DayDrummerSeason3-Logo-10.png" alt="30 Day Drummer" class="mx-auto mb-4 w-32">
                                                        <h4 class="leading-none"><strong>Enter Your Email to Unlock </br>30-Day Drummer</strong></h4>
                                                        <p class="mt-2 lg:mt-3 text-xs">Get access to the first week of 30-Day Drummer now. No payment info is required.</p>',
                                            'formName' => '30D Drummer Sample',
                                            'formId' => 'Musora - Engagement - Trigger - 30D Drummer Sample - WebForm',
                                            'buttonColor' => 'bg-drumeo',
                                        ],
                                        'new-piano-players-start-here' => [
                                            'header' => '<img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/new-piano-players/new-piano-players-logo.png" alt="Logo" class="mx-auto mb-4 h-16">
                                                        <h4 class="leading-none"><strong>Enter Your Email to Unlock </br> New Piano Players Start Here</strong></h4>
                                                        <p class="mt-2 lg:mt-3 text-xs">Get access to the first week of New Piano Players Start Here now. No payment info is required.</p>',
                                            'formName' => 'New Piano Players Sample',
                                            'formId' => 'Musora - Engagement - Trigger - New Piano Players Sample - WebForm',
                                            'buttonColor' => 'bg-pianote',
                                        ],
                                        '30-days-to-better-strumming' => [
                                            'header' => '<img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-black.png" alt="Logo" class="mx-auto mb-4 h-16">
                                                        <h4 class="leading-none"><strong>Enter Your Email to Unlock </br>30 Days To Better Strumming</strong></h4>
                                                        <p class="mt-2 lg:mt-3 text-xs">Get access to the first week of 30 Days To Better Strumming now. No payment info is required.</p>',
                                            'formName' => 'Better Strumming Sample',
                                            'formId' => 'Musora - Engagement - Trigger - Better Strumming Sample - WebForm',
                                            'buttonColor' => 'bg-guitareo',
                                        ],
                                        'everyday-improv' => [
                                        'header' => '<img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/singeo/products/everyday-improv/enrollment/logo.webp" alt="Logo" class="mx-auto mb-4 h-16">
                                                    <h4 class="leading-none"><strong>Enter Your Email to Unlock </br> 30 Days To Everyday Improv</strong></h4>
                                                    <p class="mt-2 lg:mt-3 text-xs">Get access to the first week of Everyday Improv now. No payment info is required.</p>',
                                        'formName' => 'Everyday Improv Sample',
                                        'formId' => 'Musora - Engagement - Trigger - Everyday Improv Sample - WebForm',
                                        'buttonColor' => 'bg-singeo',
                                    ],
                                    ];
                                @endphp
                               
                                    @if(!empty($slug) && isset($forms[$slug]))
                                        @if(!empty($forms[$slug]['header']))
                                            {!! $forms[$slug]['header'] !!}
                                        @endif
                                     <div class="w-full md:w-10/12 lg:w-9/12 pt-4 lg:pt-6 mx-auto">
                                        @include('_partials.components.forms.sign-up-form', [
                                            "recaptchaKey" => config('recaptcha.key'),
                                            "formName" => $forms[$slug]['formName'],
                                            "formId" => $forms[$slug]['formId'],
                                            "buttonText" => "Get Access Now",
                                            "nameInput" => "First Name",
                                            "inputText" => "Email Address",
                                            'header' => $forms[$slug]['header'],
                                            'formClass' => 'max-w-md',
                                            'redirectURL' => '/',
                                            'noSocial' => true,
                                            "stacked" => true,
                                            'minimalForm' => true,
                                            'buttonColor' => $forms[$slug]['buttonColor'],
                                        ])
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@else 
    <div id="sign-up-modal" class="fixed inset-0 overflow-y-auto" style="display: none; z-index: 2147483002;" role="dialog" aria-modal="true">
        <div class="relative min-h-screen flex items-center justify-center px-4 bg-black bg-opacity-80"
            style="z-index: 1006;">
            <i class="fa-light fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl z-150 modal-close"></i>
            <div class="relative overflow-y-visible px-4 md:px-5 lg:px-7 py-5 md:py-7 mx-auto text-center">
                    <div
                        class="text-white relative overflow-y-visible px-4 md:px-5 lg:px-7 py-5 md:py-7 mx-auto text-center">
                        <h1 class="text-{{ $theme }}"><i class="fas fa-lock"></i></h1>
                        <h3 class="leading-tight my-6">
                            <strong>Unlock The Full Course to<br class="hidden sm:inline"> Continue Watching</strong>
                        </h3>
                        <a class="join {{ $theme }} smaller modal-close" href="{{$link}}">{!!$cta!!} <i class="fas fa-chevrons-right"></i></a>
                    </div>
            </div>
        </div>
    </div>
@endif 
    <div class="lg:w-1/3 text-left">
        <div class="relative rounded-xl overflow-hidden border @if(!empty($lightMode)) border-gray-100 text-black @else border-gray-600 text-white @endif" style="height: 509px;">
            <div class="overflow-y-auto h-full lessons-list">
                @foreach (collect($lessons) as $index => $lesson)
                    @php
                        $isAccessible = !empty($lesson['free']) && ($index < $accessibleVideosCount);                    
                    @endphp
                    <div class="w-full flex items-center px-3 py-4 lg:px-2 cursor-pointer hover:opacity-80 transition-opacity"
                         style="background: {{ $index % 2 == 0 ? $aside_dark : $aside_light }};"
                         @click="
                             if ({{ isset($lesson['videoId']) && $isAccessible ? 'true' : 'false' }}) {
                                 currentVideoIndex = {{ $index + 1 }};
                                 videoId = '{{ $lesson['videoId'] }}';
                                 showVideoModal = true;
                                 loadAndPlayVideo(videoId, currentVideoIndex);
                             } else {
                                 unlock = true;
                                 showSignUpModal();
                             }
                         ">
                        <div class="relative rounded-lg mr-4 lg:mr-1.5 flex-shrink-0">
                            @if(!empty($simpleModal))
                                <img src="{{ $lesson['thumb'] }}" alt="{{ $lesson['title'] }}" class="h-20 w-auto object-cover rounded-lg">
                            @else 
                                <img src="{{ $lesson['thumb'] }}" alt="{{ $lesson['title'] }}" class="h-20 w-auto object-cover rounded-lg">
                                @if (!isset($lesson['videoId']) || !$isAccessible)
                                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                                        <i class="fa fa-lock text-white text-2xl z-10"></i>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="flex flex-col text-left">
                            <p class="leading-normal font-semibold text-xs">
                                @if ($isAccessible && isset($lesson['videoId']))
                                    <strong class="bg-{{ $theme }} text-white px-1 rounded-md">FREE</strong><br>
                                @endif
                                {{ $lesson['title'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="absolute h-10 bottom-0 left-0 right-0 z-10"
                 style="
                 @if(!empty($lightMode)) background: linear-gradient(to bottom, transparent, #fff); @else background: linear-gradient(to bottom, transparent, #000); @endif
                 "></div>
        </div>
        <a href="{{ $link }}" class="w-full join smaller {{ $theme }} mt-5 text-base lg:text-xl">{!!$cta!!}</a>
    </div>

@push('player-scripts')
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
       
        const videoIds = @json(collect($lessons)->pluck('videoId')->filter()->all());

        let player;
        let currentIndex = 0;
        let preventClose = false;

        function initializePlayer(videoId) {
            const options = {
                id: videoId,
                loop: false,
                width: '100%',
                responsive: true
            };

            if (player) {
                player.loadVideo(videoId).then(() => {
                    playVideo();
                }).catch(error => {
                    console.error('Error loading video:', error);
                });
            } else {
                player = new Vimeo.Player('vimeo-player', options);
                player.on('ended', handleVideoEnd);
                playVideo();
            }
        }

        function playVideo() {
            player.play().catch(error => {
                console.error('Error playing video:', error);
            });
        }

        function handleVideoEnd() {
            currentIndex++;
            if (currentIndex < videoIds.length) {
                initializePlayer(videoIds[currentIndex]);
            } else {
                showSignUpModal();
            }
        }

        function loadAndPlayVideo(videoId, startIndex) {
            currentIndex = startIndex;
            initializePlayer(videoId);
        }

        function pauseVideo() {
            if (player) {
                player.pause().catch(error => {
                    console.error('Error pausing video:', error);
                });
            }
        }

        function nextLesson() {
            currentIndex++;
            if (currentIndex < videoIds.length) {
                videoId = videoIds[currentIndex];
                if (videoId) {
                    initializePlayer(videoId);
                    showVideoModal();
                } else {
                    showSignUpModal();
                }
            } else {
                showSignUpModal();
            }
        }

        function showVideoModal() {
            document.querySelector('[x-show="showVideoModal"]').style.display = 'block';
        }

        function showSignUpModal() {
            pauseVideo();
            document.getElementById('sign-up-modal').style.display = 'block';
            document.querySelector('[x-show="showVideoModal"]').style.display = 'none';
        }

        function resetModal() {
            if (!preventClose) {
                document.getElementById('sign-up-modal').style.display = 'none';
                document.querySelector('[x-show="showVideoModal"]').style.display = 'block';
            }
        }

        document.querySelectorAll('.modal-close').forEach(element => {
            element.addEventListener('click', function() {
                document.getElementById('sign-up-modal').style.display = 'none';
                document.querySelector('[x-show="showVideoModal"]').style.display = 'none';
                pauseVideo();
            });
        });

        window.loadAndPlayVideo = loadAndPlayVideo;
        window.nextLesson = nextLesson;
        window.resetModal = resetModal;
        window.pauseVideo = pauseVideo;
        window.showSignUpModal = showSignUpModal;
        
        if (!{{ !empty($unlocked) ? 'true' : 'false' }} && !{{ !empty($simpleModal) ? 'true' : 'false' }}) {
            showSignUpModal();
        }
    });
</script>
@endpush
