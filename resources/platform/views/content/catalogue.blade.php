@php
    $showInProgress = false;
    if($hasStartedLessons && $lessonType !== 'routine'){
        $showInProgress = true;
    }

    $headerData = [
        'type' => null,
        'title' => null,
        'description' => null,
        'iconName' => null,
        'heroImg' => null,
        'progress' => null,
        'contentId' => null,
        'infoData' => null,
        'ctas' => null
    ];

    $infoDataStrArr = [];
    if ($catalogueMeta['name'] == 'Courses') {
        $headerData['type'] = 'courses';
        $headerData['title'] = 'Courses';
        $headerData['iconName'] = 'academic-cap';
        if ($brand === 'drumeo') {
            $headerData['description'] = "Tackle your next drumming goal with bite-sized courses from many of the world's best drummers.";
        } elseif ($brand === 'pianote') {
            $headerData['description'] = "Tackle your next piano goal with bite-sized courses from many of the world's best pianists.";
        } elseif ($brand === 'guitareo') {
            $headerData['description'] = "Tackle your next guitar goal with bite-sized courses from many of the world's best guitarists.";
        } elseif ($brand === 'singeo') {
            $headerData['description'] = "Tackle your next singing goal with bite-sized courses from many of the world's best vocalists.";
        }
    }
    else if ($catalogueMeta['name'] == 'Play Alongs') {
        $headerData['type'] = 'play-along';
        $headerData['title'] = 'Play Alongs';
        $headerData['iconName'] = 'eigth-notes';
        $headerData['description'] = 'Add your drumming to high-quality drumless play-along tracks - with handy playback tools to help you create the perfect performance.';
    }
    else if ($catalogueMeta['name'] == 'Songs') {
        $headerData['type'] = 'song';
        $headerData['title'] = 'Songs';
        $headerData['iconName'] = 'headphones';
    }
    else if ($catalogueMeta['name'] == 'Routines') {
        $headerData['type'] = 'routine';
        $headerData['title'] = 'Routines';
        $headerData['iconName'] = 'routines';
    }
    else if ($catalogueMeta['name'] == 'Quick Tips') {
        $headerData['type'] = 'quick-tips';
        $headerData['title'] = 'Quick Tips';
        $headerData['iconName'] = 'light-bulb';
        $headerData['description'] = "Only have 10 minutes? These short lessons are designed to inspire you with quick tips and exercises, even if you don't have lots of time to practice.";
    }
    else if ($catalogueMeta['name'] == 'Bootcamps') {
        $headerData['type'] = 'bootcamp';
        $headerData['title'] = 'Bootcamps';
        $headerData['iconName'] = 'keys';
    }
    else if ($catalogueMeta['name'] == 'The Pianote Podcast') {
        $headerData['type'] = 'podcast';
        $headerData['title'] = 'The Pianote Podcast';
        $headerData['iconName'] = 'podcast';
    }
    else if ($catalogueMeta['name'] == 'Student Focus') {
        $headerData['type'] = 'student-focus';
        $headerData['title'] = 'Student Focus';
        $headerData['iconName'] = 'person-plus';
        $headerData['description'] = "Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.";
        if ($brand === 'drumeo') {
            $headerData['ctas'] = [
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'What is Student Review?',
                        'faIconClass' => 'fa-question-circle',
                        'iframeSrc' => '//player.vimeo.com/video/450154189',
                    ]
                ],
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'How to Apply',
                        'faIconClass' => 'fa-play-circle',
                        'iframeSrc' => '//player.vimeo.com/video/450152568',
                    ]
                ],
                [
                    'type' => 'GoogleFormCta',
                    'props' => [
                        'text' => 'Apply Now',
                        'faIconClass' => 'fa-chevrons-right',
                        'iframeSrc' => 'https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true',
                    ]
                ]
            ];
        }
    }
    else if ($catalogueMeta['name'] == 'Drumeo Monthly Collaborations') {
        $headerData['type'] = 'student-collaborations';
        $headerData['title'] = 'Drumeo Monthly Collaborations';
        $headerData['iconName'] = 'academic-cap-filled';
        $headerData['description'] = "Collaborate with the community with Drumeo Monthly Collaborations! Each month a new Play-Along is chosen and members are tasked to submit their videos playing along to the song. At the end of each month, every video is joined together to create a single performance!";
        if ($brand === 'drumeo') {
            $headerData['ctas'] = [
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'What is Student Collaboration?',
                        'faIconClass' => 'fa-question-circle',
                        'iframeSrc' => '//player.vimeo.com/video/448684113',
                    ]
                ],
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'How to Create Your Video?',
                        'faIconClass' => 'fa-question-circle',
                        'iframeSrc' => '//player.vimeo.com/video/448684140',
                    ]
                ],
                [
                    'type' => 'GoogleFormCta',
                    'props' => [
                        'text' => 'Submit A Video',
                        'faIconClass' => 'fa-chevrons-right',
                        'iframeSrc' => 'https://docs.google.com/forms/d/e/1FAIpQLSdRIO4-j89ItSXadApA5Q-70Nz1ZMIURvfPfrFZB0olOyYdmw/viewform?embedded=true',
                    ]
                ]
            ];
        }
    }
    else if ($catalogueMeta['name'] == 'Student Reviews') {
        $headerData['type'] = 'student-review';
        $headerData['title'] = 'Student Reviews';
        $headerData['iconName'] = 'person-plus';
        $headerData['description'] = "Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.";
        if ($brand === 'pianote') {
            $headerData['ctas'] = [
                [
                    'type' => 'GoogleFormCta',
                    'props' => [
                        'text' => 'Apply Now',
                        'faIconClass' => 'fa-chevrons-right',
                        'iframeSrc' => 'https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true',
                    ]
                ]
            ];
        } elseif ($brand === 'guitareo') {
            $headerData['ctas'] = [
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'What is Student Review?',
                        'faIconClass' => 'fa-question-circle',
                        'iframeSrc' => '//player.vimeo.com/video/642883586',
                    ]
                ],
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'How to Apply',
                        'faIconClass' => 'fa-play-circle',
                        'iframeSrc' => '//player.vimeo.com/video/642900215',
                    ]
                ],
                [
                    'type' => 'GoogleFormCta',
                    'props' => [
                        'text' => 'Apply Now',
                        'faIconClass' => 'fa-chevrons-right',
                        'iframeSrc' => 'https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?embedded=true',
                    ]
                ]
            ];
        } elseif ($brand === 'singeo') {
            $headerData['ctas'] = [
                [
                    'type' => 'VideoModalCta',
                    'props' => [
                        'text' => 'Tips For Applying',
                        'faIconClass' => 'fa-play-circle',
                        'iframeSrc' => '//player.vimeo.com/video/712150351',
                    ]
                ],
                [
                    'type' => 'GoogleFormCta',
                    'props' => [
                        'text' => 'Apply Now',
                        'faIconClass' => 'fa-chevrons-right',
                        'iframeSrc' => 'https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?embedded=true',
                    ]
                ]
            ];
        }
    }
    else if ($catalogueMeta['name'] == 'Q&A') {
        $headerData['type'] = 'qanda';
        $headerData['title'] = 'Q&A';
        $headerData['iconName'] = 'question-mark-circle';
        $headerData['description'] = 'Submit your questions using the button, in the Q&A thread in the forums, or live in the community chat.';
        $headerData['ctas'][] = [
            'type' => 'PageHeaderCta',
            'props' => [
                'text' => 'Ask A Question',
                'url' => '/pianote/resources',
                'showAllAlways' => true
            ]
        ];
    }
    else if ($catalogueMeta['name'] == 'Chords & Scales') {
        $headerData['type'] = 'chordsandscales';
        $headerData['title'] = 'Chords & Scales';
        $headerData['iconName'] = 'guitar-tabs';
    }
    else if ($catalogueMeta['name'] == 'Archives') {
        $headerData['type'] = 'archives';
        $headerData['title'] = 'Archives';
        $headerData['iconName'] = 'archives';
    }
    else if ($catalogueMeta['name'] == 'New Content') {
        $headerData['type'] = 'newcontent';
        $headerData['title'] = 'New Content';
        $headerData['iconName'] = 'star';
    }
    else if ($catalogueMeta['name'] == 'Subscribed') {
        $headerData['type'] = 'subscribed';
        $headerData['title'] = 'Subscribed';
        $headerData['iconName'] = 'bell';
    }
    else if ($catalogueMeta['name'] == 'Song Tutorials') {
        $headerData['type'] = 'songtutorials';
        $headerData['title'] = 'Song Tutorials';
        $headerData['iconName'] = 'play-progress';
    }
    else if ($catalogueMeta['name'] == 'Rudiments') {
        $headerData['type'] = 'rudiments';
        $headerData['title'] = 'Rudiments';
        $headerData['iconName'] = 'drum';
        $headerData['description'] = "The 40 drum rudiments are essential for any drummer, no matter the style, genre, or scenario. You can use the videos below to help you learn, practice, and perfect every single one.";
    }
    else if ($lessonType === 'Recommendation') {
        $headerData['type'] = 'recommended';
        $headerData['title'] = 'Inspired By Your Activity';
        $headerData['iconName'] = 'recommendation';
        $headerData['description'] = "Here's a list of items we think you'd be interested in! New content will be available twice a week, taking into account your activity and the preferences of other students with similar interests.";
    }
    else {
        $headerData['type'] = 'generic';
        $headerData['title'] = $catalogueMeta['name'];
        $headerData['description'] = $catalogueMeta['description'];
    }


    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

    $recommendationLinks = new stdClass();
    $recommendationLinks->drumeo = 'https://www.musora.com/drumeo/forums/drumeo-website-feedback/6/16436/16436?page=1&sortby_val=published_on#post349083';
    $recommendationLinks->pianote = 'https://www.musora.com/pianote/forums/platform-update-feedback-discussion/5/5348/5348?page=1&sortby_val=published_on#post127612';
    $recommendationLinks->guitareo = 'https://www.musora.com/guitareo/forums/website-update-and-feedback-discussion/6/3185/3185?page=1&sortby_val=published_on#post45772';
    $recommendationLinks->singeo = 'https://www.musora.com/singeo/forums/platform-update-feedback-discussion/5/919/919?page=1&sortby_val=published_on#post48436';
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('review-modal-section')
    @if($lessonType === 'student-review' || $lessonType === 'student-focus')
        @include('partials._review-modal', ['brand' => $brand])
    @endif
@endsection

@section('content')

        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <breadcrumb :breadcrumbs="{{ json_encode($breadcrumbs) }}"></breadcrumb>
            <page-header
                page-type="{{ $headerDataObj->type }}"
                icon-name="{{ $headerDataObj->iconName }}"
                title="{{ $headerDataObj->title }}"
                description="{{ $headerDataObj->description }}"
                hero-img="{{ $headerDataObj->heroImg }}"
                progress="{{ $headerDataObj->progress }}"
                content-id="{{ $headerDataObj->contentId }}"
                :info-data="{{ json_encode($headerDataObj->infoData) }}"
                :ctas="{{ json_encode($headerDataObj->ctas) }}"
            ></page-header>
        </div>

    @if(session()->has('success-message'))
        <div class="form-success-message container mt-3">
            <div class="flex flex-column bg-success shadow corners-10 pa">
                <p class="body text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif

    @if($showInProgress)
        <section class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl dark:tw-text-white tw-px-4 md:tw-px-8">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mt-[30px] tw-mb-4 tw-w-full tw-justify-between">
                <a href="/{{ $brand }}/lesson-history/in-progress" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Continue</h2>
                </a>
                <a href="/{{ $brand }}/lesson-history/in-progress"
                    aria-label="See All Subscribed Lessons"
                    class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                >
                    See All
                </a>
            </div>
            <div>
                <transition appear name="fade">
                    <catalogue-card-container
                        theme-color="{{ $brand }}"
                        catalogue-type="grid"
                        no-results-message="Looks like you haven't started any lessons.
            Once you watch a video, it will show up here for you to access later."
                        :pre-loaded-content="{{ json_encode(json_decode($startedLessons)->data) }}"
                        :no-skeleton="{{ json_encode(true) }}"
                    >
                    </catalogue-card-container>
                </transition>
            </div>
        </section>
    @endif

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-[30px] dark:tw-text-white">
        @if( $catalogueMeta['name'] === "Play Alongs" && $brand === "drumeo" )
            <play-alongs
                ref="playAlongsVueInstance"
                content-endpoint="/railcontent/content"
                theme-color="{{ $brand }}"
                brand="{{ $brand }}"
                :pre-loaded-content="{{ $listLessons }}"
                :session-token="{{ json_encode(railtracker_session_token()) }}"
                @play="handlePlayAlongsPlay"
                @pause="handlePlayAlongsPause"
            ></play-alongs>
        @else
            <collection-wrapper
                :brand="{{ json_encode($brand) }}"
                :collection-type="{{ json_encode($lessonType) }}"
                :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
                :included-types="{{ json_encode(is_array($lessonType) ? $lessonType : explode(',', $lessonType) ) }}"
                :pre-loaded-content="{{ $listLessons }}"
                :statuses="{{ json_encode($statuses ?? ['published']) }}"
                :title="{{ json_encode($catalogueMeta['shortname'] ?? $catalogueMeta['name']) }}"
                :tabs="{{ json_encode($catalogueMeta['tabs'] ?? []) }}"
                :multiple-types="{{ json_encode($isAllContent ?? false) }}"
                :is-all-content="{{ json_encode($isAllContent ?? false) }}"
                :hide-filter-icon="{{ json_encode($lessonType === 'routine' ? true : false) }}"
                :hide-controls="{{ json_encode($lessonType === 'Recommendation' ? true : false) }}"
                @if($lessonType === 'Recommendation')
                    endpoint="/railcontent/recommended"
                    no-results-message="Start your learning journey to help us select the appropriate videos for you."
                @endif
            ></collection-wrapper>
        @endif
    </div>

    <div id="featureModal" class="modal">
        <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
            <p class="tw-my-2 dark:tw-text-white">Here's a list of items we think you'd be interested in! New content will be available twice a week, taking into account your activity and the preferences of other students with similar interests. </p>
            <a href="{{ $recommendationLinks->$brand }}" class="tw-font-bebas-neue tw-uppercase tw-flex tw-items-center dark:tw-text-white">
                Learn More <musora-icon icon-name="right-arrow" class="tw-w-7" ></musora-icon>
            </a>
        </div>
    </div>

@endsection
<script>
    const openModal = () => {
        window.openModal('featureModal');
    }
</script>
