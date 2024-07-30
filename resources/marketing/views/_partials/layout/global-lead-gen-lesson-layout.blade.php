@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $currentLesson->title }} | {{ $leadgen->title }}</title>
    <meta property="og:title" content="{{ $currentLesson->title }} | {{ $leadgen->title }}"/>
    <meta name="description" content="{{ $leadgen->meta_desc }}">
    <meta property="og:description" content="{{ $leadgen->meta_desc }}"/>
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
    <meta property="og:image" content="{{ $leadgen->meta_img }}"/>
    <meta name="robots" content="noindex">
@stop

@section('layout-styles')
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}">
@endsection


@section('layout-header')
    @include($theme.".sales.partials._nav")
@endsection

@section('layout-body')
    <div class="overflow-hidden text-white px-3 py-10 sm:pb-16 sm:pt-24" style="background-color:#000a1e;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <div class="video-row relative mb-4 sm:mb-7">
                    @if(!is_null($prevLesson))
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -5%;width: @hasSection('thumb-width') @yield('thumb-width') @else 80% @endif;" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/@php
                            if(str_contains($prevLesson->thumbnail, 'i.vimeocdn.com')){
                                  $prevLesson->thumbnail = preg_replace('/[?]mw[=][0-9]+[&]mh[=][0-9]+/', '.jpg', $prevLesson->thumbnail);
                                  if(preg_match('/[.]png|[.]jpg|[.]jpeg|[.]svg/', $prevLesson->thumbnail) !== 1){
                                        $prevLesson->thumbnail = $prevLesson->thumbnail.'.jpg';
                                    }
                              }
                              echo $prevLesson->thumbnail;
                        @endphp" alt="pre-thumb">
                    @endif

                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="{{ $currentLesson->video_src }}" frameborder="0" allowfullscreen></iframe>
                    </div>

                    @if(!is_null($nextLesson))
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 105%;width: @hasSection('thumb-width') @yield('thumb-width') @else 80% @endif;" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/@php
                            if(str_contains($nextLesson->thumbnail, 'i.vimeocdn.com')){
                                  $nextLesson->thumbnail = preg_replace('/[?]mw[=][0-9]+[&]mh[=][0-9]+/', '.jpg', $nextLesson->thumbnail);
                                  if(preg_match('/[.]png|[.]jpg|[.]jpeg|[.]svg/', $nextLesson->thumbnail) !== 1){
                                        $nextLesson->thumbnail = $nextLesson->thumbnail.'.jpg';
                                    }
                              }
                              echo $nextLesson->thumbnail;
                        @endphp" alt="next-thumb">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>{{ $currentLesson->title }}</strong></h3>
                    @if(!empty($currentLesson->caption)) <p class="mt-1 sm:mt-2">{{ $currentLesson->caption }}</p> @endif
                    @if(!empty($totalLessonNum) && !empty($currentLessonNum))<p class="text-light-navy mt-1 sm:mt-2">Lesson {{ $currentLessonNum }} of {{ $totalLessonNum }}</p>@endif
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons flex justify-between">
                <div class="mb-2 sm:mb-0 w-1/2 sm:w-1/3 px-2 md:px-3">
                    @if(!is_null($prevLesson))
                        <a class="button block bg-{{ $theme }} hover:brightness-125 cursor-pointer" href="/{{ $prevLesson->slug }}">
                            <i class="fas fa-chevron-left"></i> @hasSection('prev-text') @yield('prev-text') @else Prev @endif
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>

                <div class="complete-lesson mb-2 sm:mb-0 w-full sm:w-1/3 px-2 md:px-3 hidden sm:block next-lesson-button">
                    @if(!empty($leadgen->slug))
                        <a class="button block bg-{{ $theme }} hover:brightness-125 cursor-pointer" href="/{{$leadgen->slug}}">
                            <i class="fas fa-chevron-up"></i> Lesson Index
                        </a>
                    @endif
                </div>
                <div class="w-1/2 sm:w-1/3 px-2 md:px-3 next-lesson-button">
                    @if(!is_null($nextLesson))
                        <a class="button block bg-{{ $theme }} hover:brightness-125 cursor-pointer" href="/{{ $nextLesson->slug }}">
                            @hasSection('next-text') @yield('next-text') @else Next @endif <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!empty($currentLesson->desc))
        <div class="px-3 py-6 sm:py-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <p>
                        <x-markdown>{!! nl2br($currentLesson->desc) !!}</x-markdown>
                    </p>
                </div>
            </div>
        </div>
    @endif
    @php $bodyData = ''; @endphp
    @if(count($currentLesson->assignments) > 0)
        <div class="px-3 pt-6 sm:pt-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <h4 class="mb-1 sm:mb-3"><strong>Assignments</strong></h4>
                    @foreach($currentLesson->assignments as $key => $assignment)
                        @php
                            $bodyData = $bodyData.'soundsliceModal'.($key+1).': false,';
                            $resourceName = '';

                            if(str_contains($assignment->src, 'mp3')){
                                $resourceName = 'mp3URL';
                            }
                            elseif(str_contains($assignment->src, 'svg') || str_contains($assignment->src, 'jpg') || str_contains($assignment->src, 'png') || str_contains($assignment->src, 'jpeg')){
                                $resourceName = 'imgURL';
                            }
                            elseif(str_contains($assignment->src, 'pdf')){
                                $resourceName = 'pdfURL';
                            }
                            elseif(str_contains($assignment->src, 'zip')){
                                $resourceName = 'zipURL';
                            }
                        @endphp
                        @if($leadgen->slug == 'piano-technique-essentials/lessons')
                            @include('_partials.components.leadgen-assignment', [
                                "title" => $assignment->title,
                                'subTitle' => $assignment->subtitle,
                                $resourceName => $assignment->src,
                                'soundslice' => $assignment->soundslice,
                                'num' => $key+1,
                            ])
                        @else
                        @include('_partials.components.leadgen-assignment-resources', [
                            "title" => $assignment->title,
                            'subTitle' => $assignment->subtitle,
                            $resourceName => $assignment->src,
                            'soundslice' => $assignment->soundslice,
                            'num' => $key+1,
                        ])
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(count($currentLesson->assets) > 0 || count($leadgen->assets) > 0)
        <div class="px-3 py-6 sm:py-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <h4 class="mb-1 sm:mb-3"><strong>Resources</strong></h4>
                    @foreach($leadgen->assets as $key => $asset)
                        @php
                            $bodyData = $bodyData.'soundsliceModal'.($key+21).': false,';
                            $resourceName = '';

                            if(str_contains($asset->src, '.mp3')){
                                $resourceName = 'mp3URL';
                            }
                            elseif(str_contains($asset->src, '.svg') || str_contains($asset->src, 'jpg') || str_contains($asset->src, 'png') || str_contains($asset->src, 'jpeg')){
                                $resourceName = 'imgURL';
                            }
                            elseif(str_contains($asset->src, '.pdf')){
                                $resourceName = 'pdfURL';
                            }
                            elseif(str_contains($asset->src, '.zip')){
                                $resourceName = 'zipURL';
                            }
                        @endphp

                        @include('_partials.components.leadgen-assignment-resources', [
                            "title" => $asset->title,
                            $resourceName => $asset->src,
                            "soundslice" => $asset->soundslice,
                            'num' => $key+21,
                        ])
                    @endforeach
                    @foreach($currentLesson->assets as $key => $asset)
                        @php
                            $bodyData = $bodyData.'soundsliceModal'.($key+41).': false,';
                            $resourceName = '';

                            if(str_contains($asset->src, '.mp3')){
                                $resourceName = 'mp3URL';
                            }
                            elseif(str_contains($asset->src, '.svg') || str_contains($asset->src, 'jpg') || str_contains($asset->src, 'png') || str_contains($asset->src, 'jpeg')){
                                $resourceName = 'imgURL';
                            }
                            elseif(str_contains($asset->src, '.pdf')){
                                $resourceName = 'pdfURL';
                            }
                            elseif(str_contains($asset->src, '.zip')){
                                $resourceName = 'zipURL';
                            }
                        @endphp

                        @include('_partials.components.leadgen-assignment-resources', [
                            "title" => $asset->title,
                            $resourceName => $asset->src,
                            "soundslice" => $asset->soundslice,
                            'num' => $key+41
                        ])
                    @endforeach

                    @hasSection ('all-course-resource')
                        @yield('all-course-resource')
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if (!empty($lessons))
        <section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background-color:#010611;">
            <div class="container mx-auto">
                <div class="album-grid flex flex-wrap justify-center mx-auto max-w-2xl lg:max-w-none">
                    @foreach($lessons as $lesson)
                        <a href="{{ $lesson['url'] }}" class="@yield('lesson-tile-width') px-2 md:px-3 mb-5 md:mb-7">
                            <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md">
                                <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="transform: translate(-50%, -50%);"></i>
                                <div class="@hasSection('lesson-tile-aspect') @yield('lesson-tile-aspect') @else aspect-16:9 @endif w-full bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $lesson['image'] }}"></div>
                            </div>
                            <h5 class="mt-3 mb-1"><strong>{{ $lesson['title'] }}</strong></h5>
                            @if(!empty($lesson['artist']))
                                <p class="text-light-navy leading-none">w/ {{ $lesson['artist'] }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($theme === 'pianote' && $leadgen->slug == 'chord-hacks/lessons')
        @include('drumeo.lead-gen.partials.free-trial', [
            'header' => 'You’ve started playing the piano. Now take the next step.',
            'subHeader' => 'TRY PIANOTE FREE FOR 7 DAYS AND GET:',
            'benefits' => ['FREE Chords & Scales book', 'The perfect step-by-step curriculum', 'Beginner-friendly song tutorials', 'Live support from REAL teachers'],
            'img' => 'https://pianote.s3.amazonaws.com/products/30-day-blues-piano/collage-lessons.png',
            'mobileImg' => 'https://pianote.s3.amazonaws.com/products/30-day-blues-piano/collage-lessons-m.png',
            'customLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[piano-chords-and-scales-guide]=1&promo-code=trial-book&redirect=/order&locked=true',
        ])
    @endif

     @if($theme === 'pianote' && $leadgen->slug == 'piano-technique-essentials/lessons')
        @include('drumeo.lead-gen.partials._learn-more', [
            'bg' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/sign-up-bg.webp',
            'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/marketing/pianote/lead-gen/technique-essentials/30DTBT-logo-light.webp',
            'header' => 'What would happen if you learned piano from <br class="hidden md:block"> <strong>the best keyboardist in the world?</strong>',
            'subheader' => 'Improve your piano technique with 30 days of guided lessons from Jordan Rudess.',
            'btnLink' => '/shop/30-days-to-better-technique',
            'btnText' => 'LEARN MORE',
            'logoStyle' => 'h-24 md:h-36',
        ])
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/pre-form-submit-facebook-lead.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/form-tracking.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.assignment-row .fa-angle-down').click(function () {
                $(this).parent().parent().toggleClass('active');
            });
        });
    </script>
@stop

@section('body-data')
    x-data = '{ {{ $bodyData }} }'
@endsection

@section('layout-footer')
    @include($theme.".sales.partials._footer", [
            "minimal" => true
    ])
@endsection
