@section('scripts')
    @if(isset($queuedScripts))
        {{ $queuedScripts }}
    @endif
@endsection

@php
$colors = [
    'drumeo' => [
        'solidBg' => '#00101d',
        'bgRgbStart' => 'rgba(0, 16, 29, 0)',
        'bgRgbEnd' => '',
        'subtitle' => '#7E9AB1',
    ],
    'guitareo' => [
        'solidBg' => '#101817',
        'bgRgbStart' => 'rgba(0, 16, 29, 0)',
        'bgRgbEnd' => '',
        'subtitle' => '#717179',
    ],
    'singeo' => [
        'solidBg' => '#18131C',
        'bgRgbStart' => 'rgba(0, 16, 29, 0)',
        'bgRgbEnd' => '',
        'subtitle' => '#717179',
    ],
    'pianote' => [
        'solidBg' => '#201617',
        'bgRgbStart' => 'rgba(0, 16, 29, 0)',
        'bgRgbEnd' => '',
        'subtitle' => '#717179',
    ],
];
$brandColors = $colors[$brand];
@endphp

<section class="tw-grid xs:tw-grid-cols-1 sm:tw-grid-cols-1 md:tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-0">
    <div class="lg:tw-hidden tw-bg-top tw-bg-cover tw-text-white tw-min-h-[25vh]"
        style="
            background-color: {{ $colors["$brand"]['solidBg'] }};
            background-image: url(https://musora.com/cdn-cgi/image/quality=100/{{ $backgroundImage }});">
        <div style="width: 100%; height: 100%; background: linear-gradient(180deg,{{ $colors["$brand"]['bgRgbStart'] }} 50%,{{ $colors["$brand"]['solidBg'] }});"></div>
    </div>
    <div class="tw-text-white" style="background-color: {{ $brandColors['solidBg'] }}">
        <div class="tw--mt-24 md:tw-mt-0 tw-text-center lg:tw-text-left md:tw-py-12 lg:tw-py-16 tw-py-12 md:tw-px-14 tw-px-6">
            @if (isset($topSubtitle))
                <h2 class="tw-uppercase  tw-mb-2 tw-font-bold tw-text-lg" style="color: {{ $brandColors['subtitle'] }}; font-size: 14px; line-height: 24px;">
                    {{ $topSubtitle }}
                </h2>
            @endif
            <h1 class="tw-mb-3 tw-uppercase tw-font-normal tw-text-[40px] tw-leading-none">
                {{ $title }} 
            </h1>
            @if (isset($bottomSubtitle))
                <h2 class="tw-uppercase tw-mb-2 tw-font-bold tw-text-lg" style="color: {{ $brandColors['subtitle'] }}; font-size: 14px; line-height: 24px;">
                    {{ $bottomSubtitle }}
                </h2>
            @endif
            <h3 class="tw-mb-6 tw-font-normal tw-text-base">
                {{ $shortBio }}
            </h3>
            @if(implode(' ',$fullName) !== 'Students Of Guitareo')
                <div class="tw-flex tw-flex-col lg:tw-flex-row tw-items-center xl:tw-items-start tw-flex-wrap xl:tw-flex-nowrap">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
    <div class="tw-hidden lg:tw-flex tw-bg-top tw-bg-cover tw-text-white"
         style="
            background-color: {{ $colors["$brand"]['solidBg'] }};
            background-image: url(https://musora.com/cdn-cgi/image/quality=100/{{ !empty($backgroundImage) ? $backgroundImage : 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg' }});">
        <div style="width: 100%; height: 100%; background: linear-gradient(268deg,{{ $colors["$brand"]['bgRgbStart'] }} 50%,{{ $colors["$brand"]['solidBg'] }});"></div>
    </div>
</section>

@if ($vimeoVideo != null)
    <!-- Video Modal -->
    <div id="coach-trailer-modal" class="modal vimeo-embedded-player">
        <div class="flex flex-column corners-3">
            <div class="tw-w-full tw-relative" style="padding-bottom: 56.25%;">
                <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close"
                    src="https://player.vimeo.com/video/{{$vimeoVideo}}?title=0&byline=0&portrait=0"
                    frameborder="0"
                    allow="autoplay; fullscreen;"
                    >
                </iframe>
            </div>
        </div>
    </div>
@endif
