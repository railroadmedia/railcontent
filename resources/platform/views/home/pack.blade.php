@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')

    <div class="tw-container tw-mx-auto tw-pt-[58px] tw-px-4 md:tw-px-8 dark:tw-text-white">

        {{-- Add Header Slide "Welcome Username" --}}

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

        {{-- Packs Section --}}
        @component('partials.bladesora.members.components.home._packs-section', [
            'brand' => brand(),
            'packsUrl' => '/'.$brand.'/packs',
            'hasPacks' => !empty($packs),
            'packs' => $packs,
            ])
        @endcomponent

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

@endsection



