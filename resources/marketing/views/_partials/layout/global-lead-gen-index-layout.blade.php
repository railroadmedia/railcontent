@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $leadgen->title }}</title>
    <meta property="og:title" content="{{ $leadgen->title }}"/>
    <meta name="description" content="{{ $leadgen->meta_desc }}">
    <meta property="og:description" content="{{ $leadgen->meta_desc }}"/>
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
    <meta property="og:image" content="{{ $leadgen->meta_img }}"/>
    <meta name="robots" content="noindex">
@stop

@section('layout-styles')
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-course.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/global-styles.css') }}" rel="stylesheet">
@endsection

@section('layout-header')
    @include($theme.".sales.partials._nav")
@endsection

@section('layout-body')
    @if($theme === 'drumeo' && !empty($leadgen->slug) && ($leadgen->slug === 'free-playalongs/songs' || $leadgen->slug === 'metal-playalongs/songs'))
        <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap py-2 sm:py-1 fixed mx-auto bg-black text-white z-[100]">
            <div class="container mx-auto">
                <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                    <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://www.musora.com/musora-cdn/image/width=300,q_60,quality=95/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                    <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$drumeoPlayAlongs }}+ more play-alongs + world-class drum  <br>
                        lessons inside Drumeo. Click for a FREE trial.</p>
                </div>
            </div>
        </a>
    @endif
    <div class="flex-1">
        <div class="bg-[#000c17]">
            <div class="@if(!empty($leadgen->bg_img)) max-w-[1200px] @endif h-[150px] md:h-[350px] relative mx-auto">
                <img class="w-full h-full object-cover object-top" src="@if(!empty($leadgen->bg_img)) {{ $leadgen->bg_img }} @elseif($theme === 'drumeo') https://d3fzm1tzeyr5n3.cloudfront.net/headers/drumeo-header.jpg @elseif($theme === 'pianote') https://d3fzm1tzeyr5n3.cloudfront.net/headers/pianote-header.jpg @elseif($theme === 'guitareo') https://d3fzm1tzeyr5n3.cloudfront.net/headers/guitareo-header.jpg @elseif($theme === 'singeo') https://d3fzm1tzeyr5n3.cloudfront.net/headers/singeo-header.jpg @endif" alt="{{ $theme }} background" />
                @if(!empty($leadgen->bg_img))
                    <div class="absolute inset-0 z-20 hidden md:block" style="background:linear-gradient(90deg, #000c17 0%, #0000 10% 90%, #000c17 100%)"></div>
                @else
                    <div class="absolute inset-0 z-20" style="background: @if($theme === 'drumeo')linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(9,92,170,.7)); @elseif($theme === 'pianote') linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(213,8,29,.7)); @elseif($theme === 'guitareo') linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(0,150,128,.7)); @elseif($theme === 'singeo') linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(102,0,182,.7)); @endif">
                    </div>
                @endif
{{--                <div class="absolute inset-0 z-20" style="background:linear-gradient(#0000 50%,#000c17 85%);"></div>--}}
                <div class="text-center absolute inset-0 flex justify-center @if(!empty($leadgen->bg_img)) items-end @else items-center @endif">
                    @if(!empty($leadgen->logo))
                        <img
                            class="h-16 md:h-24 @if(!empty($leadgen->bg_img)) lg:h-32 mb-4 @else lg:h-40 @endif z-30 relative"
                            src="{{$leadgen->logo}}"
                            alt="leadgen logo"
                        />
                    @else
                        <h1 class="text-white z-30 relative font-bold">
                            {{ $leadgen->title }}
                        </h1>
                    @endif
                </div>
            </div>

        </div>
        <div class="lesson-catalogue max-w-5xl mx-auto py-12 md:py-20">
            <div class="list-wrapper px-2 sm:px-4 @if(!$leadgen->index_tile_view) grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-4 @endif">
                @foreach($lessons as $key => $lesson)
                    @include($leadgen->index_tile_view ? '_partials.components.leadgen-lesson-tile' : '_partials.components.leadgen-lesson-grid',[
                        'lessonURL' => $lesson->slug,
                        'lessonNumber' => $key + 1,
                        'lessonImg' => $lesson->thumbnail,
                        'lessonTitle' => $lesson->title,
                        'duration' => $lesson->duration
                    ])
                @endforeach
            </div>
        </div>
    </div>

    @if($theme === 'drumeo')
        @if($leadgen->slug === 'getting-started/lessons')
            @include('drumeo.lead-gen.partials.free-trial', [
                'gsotd' => true,
                'header' => 'Start playing your favorite songs',
                'subHeader' => 'Try Drumeo’s Songs section <br class="sm:hidden">free for 7 days.',
                'benefits' => ['5000+ Note-for-note songs', 'Lessons with your favorite drummers', 'Live support & clinics'],
                'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/albums.png',
                'mobileImg' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/albums-m.png',
            ])
        @else
            @include('drumeo.lead-gen.partials.free-trial', [
                'header' => 'Test your speed out with real music.',
                'subHeader' => 'Try Drumeo’s Songs section <br class="sm:hidden">free for 7 days.',
                'benefits' => ['5000+ Note-for-note songs', 'Lessons with your favorite drummers', 'Live support & clinics'],
                'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/albums.png',
                'mobileImg' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/albums-m.png',
            ])
        @endif
    @elseif($theme === 'pianote')
        @if($leadgen->slug === 'blues-bootcamp/lessons' || $leadgen->slug === 'getting-started/lessons')
            @include('drumeo.lead-gen.partials.free-trial', [
                'header' => 'You’ve started playing the piano. Now take the next step.',
                'subHeader' => 'TRY PIANOTE FREE FOR 7 DAYS AND GET:',
                'benefits' => ['The perfect step-by-step curriculum', 'Beginner-friendly song tutorials', 'Live support from REAL teachers'],
                'img' => 'https://pianote.s3.amazonaws.com/products/30-day-blues-piano/collage-lessons.png',
                'mobileImg' => 'https://pianote.s3.amazonaws.com/products/30-day-blues-piano/collage-lessons-m.png',
            ])
        @elseif($leadgen->slug === 'chord-hacks/lessons')
            @include('drumeo.lead-gen.partials.free-trial', [
                'header' => 'You’ve started playing the piano. Now take the next step.',
                'subHeader' => 'TRY PIANOTE FREE FOR 7 DAYS AND GET:',
                'benefits' => ['FREE Chords & Scales book', 'The perfect step-by-step curriculum', 'Beginner-friendly song tutorials', 'Live support from REAL teachers'],
                'img' => 'https://pianote.s3.amazonaws.com/products/30-day-blues-piano/collage-lessons.png',
                'mobileImg' => 'https://pianote.s3.amazonaws.com/products/30-day-blues-piano/collage-lessons-m.png',
                'customLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[piano-chords-and-scales-guide]=1&promo-code=trial-book&redirect=/order&locked=true',
            ])
        @endif
    @endif
@endsection

@section('layout-footer')
    @include($theme.".sales.partials._footer", [
            "minimal" => true
    ])
@endsection
