@component('partials.bladesora.members.components.header-banner', [
    'hideUser' => true,
    'backgroundImage' => $learningPath->fetch('data.header_image_url', ''),
    // 'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
])
    @slot('content')
        <div class="flex flex-column pr-1 align-center">
            <div class="flex flex-row align-center mb-2">
                <img
                    alt="{{ $learningPath->fetch('title') }} Logo"
                    src="https://musora-ui.s3.amazonaws.com/logos/{{ $brand }}-method.svg"
                    style="width:200px;height:auto;"
                >
                <h2 class="tw-text-2xl tw-font-normal uppercase text-white">
                    &nbsp;- Level
                    {{ $secondContent->fetch('level_position') }}.{{ $parentContent->fetch('course_position')  }}
                </h2>
            </div>

            <h1 class="display text-white uppercase mb-1">
                {{ $parentContent->fetch('fields.title') }}
            </h1>

            <h1 class="tw-text-2xl tw-font-normal dense uppercase text-{{$brand}}">
                {{ $parentContent->fetch('fields.instructor.fields.name') }}
            </h1>
        </div>
    @endslot
@endcomponent
