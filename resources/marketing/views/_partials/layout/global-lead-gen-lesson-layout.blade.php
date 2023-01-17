@extends('_partials.layout.global-template')

@section('global-head')
    <title>{{ $leadgen->title }}</title>
    <meta property="og:title" content="{{ $leadgen->title }}"/>
    <meta name="description" content="{{ $leadgen->meta_desc }}">
    <meta property="og:description" content="{{ $leadgen->meta_desc }}"/>
{{--    <meta property="og:url" content="https://www.drumeo.com/drum-fills/"/>--}}
    <meta property="og:image" content="{{ $leadgen->meta_img }}"/>
    <meta name="robots" content="noindex">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}">

    @yield('styles')
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-color:#000a1e;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <div class="video-row relative mb-4 sm:mb-7">
                    @if(!is_null($prevLesson))
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -5%;width: @hasSection('thumb-width') @yield('thumb-width') @else 80% @endif;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $prevLesson->thumbnail }}" alt="pre-thumb">
                    @endif

                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="{{ $currentLesson->video_src }}" frameborder="0" allowfullscreen></iframe>
                    </div>

                    @if(!is_null($nextLesson))
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 105%;width: @hasSection('thumb-width') @yield('thumb-width') @else 80% @endif;" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $nextLesson->thumbnail }}" alt="next-thumb">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>@yield('title')</strong></h3>
                    @hasSection('lesson-number')
                        <p class="text-light-navy mt-1 sm:mt-2">Lesson @yield('lesson-number') of @yield('total-lesson')</p>
                    @endif
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons flex justify-between">
                <div class="mb-2 sm:mb-0 w-1/2 sm:w-1/3 px-2 md:px-3">
                    @if(!is_null($prevLesson))
                        <a class="button block bg-{{ $theme }} hover:brightness-110 cursor-pointer" href="/{{ $prevLesson->slug }}">
                            <i class="fas fa-chevron-left"></i> @hasSection('prev-text') @yield('prev-text') @else Prev @endif
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>

                <div class="complete-lesson mb-2 sm:mb-0 w-full sm:w-1/3 px-2 md:px-3 hidden sm:block next-lesson-button">
                    @hasSection('lesson-index')
                        <a class="button block bg-{{ $theme }} hover:brightness-110 cursor-pointer" href="@yield('lesson-index')">
                            <i class="fas fa-chevron-up"></i> Lesson Index
                        </a>
                    @endif
                </div>
                <div class="w-1/2 sm:w-1/3 px-2 md:px-3 next-lesson-button">
                    @if(!is_null($nextLesson))
                        <a class="button block bg-{{ $theme }} hover:brightness-110 cursor-pointer" href="/{{ $nextLesson->slug }}">
                            @hasSection('next-text') @yield('next-text') @else Next @endif <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(count($currentLesson->assets) > 0)
        <div class="px-3 py-6 sm:py-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    <h4 class="mb-1 sm:mb-3"><strong>Assets</strong></h4>
                    @foreach($currentLesson->assets as $asset)
                        @php
                            $resourceName = '';

                            if(str_contains($asset->src, 'mp3')){
                                $resourceName = 'mp3URL';
                            }
                            elseif(str_contains($asset->src, 'svg') || str_contains($asset->src, 'jpg') || str_contains($asset->src, 'png') || str_contains($asset->src, 'jpeg')){
                                $resourceName = 'imgURL';
                            }
                            elseif(str_contains($asset->src, 'pdf')){
                                $resourceName = 'pdfURL';
                            }
                        @endphp

                        @include('drumeo.lead-gen.partials._assignment-resources', [
                            "title" => $asset->title,
                            $resourceName => $asset->src,
                            "soundslice" => $asset->soundslice,
                        ])
                    @endforeach

                    @hasSection ('all-course-resource')
                        @yield('all-course-resource')
                    @endif
                </div>
            </div>
        </div>
    @endif

    @hasSection ('lesson-description')
        <div class="px-3 py-6 sm:py-10">
            <div class="container mx-auto clearfix" style="max-width:920px">
                <div class="text-left lesson-text">
                    @yield('lesson-description')
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
                                <div class="@hasSection('lesson-tile-aspect') @yield('lesson-tile-aspect') @else aspect-16:9 @endif w-full bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $lesson['image'] }}"></div>
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

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/pre-form-submit-facebook-lead.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.assignment-row .fa-angle-down').click(function () {
                $(this).parent().parent().toggleClass('active');
            });
        });
    </script>
@stop
