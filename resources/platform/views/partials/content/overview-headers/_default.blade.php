@component('partials.bladesora.members.components.header-banner', [
    "hideUser" => true,
    'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
])
    @slot('content')
        <div class="flex flex-column">
            <div class="flex flex-row">
                <div class="header-avatar flex flex-column hide-xs-only pr-1">
                    <div class="square">
                        <img
                                class="rounded inset-border"
                                src="{{ $parentContent->fetch('fields.instructor.data.head_shot_picture_url') ?? '' }}"
                        >
                    </div>
                </div>
                <div class="flex flex-column pr-1">
                    <h2 class="title uppercase text-{{ $brand }}">
                        {{ $parentContent->fetch('type') }}
                    </h2>

                    <h1 class="heading text-white mb-1">
                        {{ $parentContent->fetch('fields.title') }}
                    </h1>

                    <div class="body text-white">
                        {!! $parentContent->fetch('data.description') !!}
                    </div>
                </div>
            </div>
        </div>
    @endslot
@endcomponent