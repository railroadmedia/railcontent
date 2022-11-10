@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')

    <div class="tw-container tw-mx-auto tw-pt-[32px] tw-px-4 md:tw-px-8 dark:tw-text-white">

        {{-- Add Header Slide "Welcome Username" --}}
        @if(empty(user()->membership_expiration_date) && user()->isPackOwner())
        <div class="tw-w-full tw-pb-[36px]">
            <static-header
                title="JOIN THE COMMUNITY"
                cta-text="UPGRADE YOUR MEMBERSHIP"
                description="Click here to upgrade your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
                cta-url="{{ get_legacy_brand_base_url() . '/shop'  }}"
                img="https://musora.com/cdn-cgi/image/width=720/https://cdn.musora.com/image/fetch/c_fill,w_1920,h_1080,q_auto:good/https://musora-web-platform.s3.amazonaws.com/carousel/pre-launch-header-image-jpg.jpg"
            ></static-header>
        </div>
        @endif

        {{-- Continue Section --}}
        @if($startedContentCount > 0)
            @component('partials.bladesora.members.components.home._continue-section', [
                'brand' => brand(),
                'hasStartedContent' => $startedContentCount > 0,
                'contentEndpoint' => '/railcontent/content',
                'continueUrl' => '', // todo: need url
                'seeAllUrl' => '', // todo: need url
                'startedContentJson' => $startedContentJson,
                ])
            @endcomponent
        @endif

        @if (!empty($courses) && brand() == 'singeo')
            @include(
                'partials.bladesora.members.components.home._courses-section',
                [
                    'brand' => brand(),
                    'contentEndpoint' => '/railcontent/content',
                    'courseContentJson' => $courses,
                    'allCoursesUrl' => '/'.$brand.'/courses',
                ]
            )
        @else
            {{-- Packs Section --}}
            @component('partials.bladesora.members.components.home._packs-section', [
                'brand' => brand(),
                'packsUrl' => '/'.$brand.'/packs',
                'hasPacks' => !empty($packs),
                'packs' => $packs,
                ])
            @endcomponent
        @endif

        {{-- Popular Conversations --}}
        @if(count($hotForumTopics) > 0)
            @component('partials.bladesora.members.components.home._conversations-section', [
                'brand' => brand(),
                'forumUrl' => brand() . '/forums',
                'forumPosts' => $hotForumTopics,
                ])
            @endcomponent
        @endif

        {{--        --}}{{-- My Stats --}}
        {{--        <stats-section--}}
        {{--            brand="{{ $brand }}"--}}
        {{--            account-url="{{ user()->getDashboardUrl() }}"--}}
        {{--            :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent ?? 0 }}"--}}
        {{--            next-learning-path-level="{{ $nextLearningPathLevel ?? '1.1' }}"--}}
        {{--            :userMetrics="{{ json_encode($userMetrics) }}"--}}
        {{--        ></stats-section>--}}

    </div>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection



