@component('members.partials._header-banner', [
        'hideUser' => true,
        'backgroundImage' => $displayFoundations
            ? 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg'
            : $featuredContent->fetch(
                'data.header_image_url',
                'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg'
            ),
    ])
    @slot('content')
        @if(!empty($displayFoundations))
            <div class="flex flex-column" style="max-width:540px;">
                <h3 class="text-white text-center subheading uppercase dense mb-1">
                    Introducing The
                </h3>

                <img
                    src="https://musora-ui.s3.amazonaws.com/logos/singeo-method.svg"
                    alt="The Drumeo Method Logo"
                    class="tw-mb-3"
                >

                <p
                    class="subtitle font-regular text-center text-white mb-3"
                    style="max-width:540px;"
                >
                    The {{ $brand }} Method is a step-by-step curriculum designed to take students from a beginner
                    to advanced level. Students will work with a wide range of instructors as they develop their
                    skills in a variety of topics.
                </p>

                <div class="flex flex-row nmh-1">
                    <div class="flex flex-column xs-6 ph-1">
                        <a
                            href="{{ $currentLearningPathLessonUrl }}"
                            class="btn text-white bg-{{ $brand }}"
                        >
                            <i class="fas fa-play mr-1"></i> Start
                        </a>
                    </div>

                    <div class="flex flex-column xs-6 ph-1">
                        <a
                            href="{{ url()->route('members.learning-paths.show', ['singeo-method', config('railcontent.singeo_method_id')]) }}"
                            class="btn text-white bg-white inverted"
                        >
                            <i class="fas fa-arrow-right mr-1"></i> More Info
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-column" style="max-width:540px;">
                <div class="pv-5"></div>
                <div class="pv-5"></div>
                <div class="pv-5 hide-xs-only"></div>
                <div class="pv-5 hide-md-down"></div>

                <h1 class="body dense text-white uppercase font-bold text-center">
                    @if($featuredContent['type'] == 'song')
                        {{ $featuredContent->fetch('fields.artist') }}
                    @else
                        {{ $featuredContent->fetch('fields.instructor.fields.name') }}
                    @endif
                </h1>
                <h1 class="heading text-white text-center">
                    {{ $featuredContent->fetch('fields.title') }}
                </h1>

                <div class="flex flex-row nmh-1 mt-2">
                    <div class="flex flex-column xs-6 ph-1">
                        <a
                            href="{{ $featuredContent->fetch('url') }}"
                            class="btn text-white bg-white inverted short"
                        >
                            <i class="fas fa-play mr-1"></i> Play
                        </a>
                    </div>

                    <div class="flex flex-column xs-6 ph-1">
                        <button
                            class="btn short addToList
                            {{ $featuredContent->fetch('is_added_to_primary_playlist') ? 'added' : '' }}"
                            data-content-id="{{ $featuredContent->fetch('id') }}"
                        >
                            <span class="un-added bg-white inverted text-white">
                                <i class="fas fa-plus mr-1"></i> Add to List
                            </span>

                            <span class="is-added bg-white text-x-dark">
                                <i class="fas fa-plus rotate-45 mr-1"></i> Added
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @endslot
@endcomponent
