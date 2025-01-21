@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')
        <home
            :is-pack-only="{{ $isPackOnly }}"
            :is-challenge-only="{{ $isChallengeOnly }}"
            account-url="{{ user()->getDashboardUrl() }}"
            content-endpoint="/railcontent/content"
            :is-a-member="{{ user()->isAMember() ? 'true' : 'false' }}"
            :user-metrics="{{ json_encode($userMetrics) }}"
            upgrade-membership-url="{{ get_legacy_brand_base_url() . '/#customize-anchor'  }}"
            @if(!empty($packs)) :pack-data="{{ json_encode($packs) }}" @endif
            @if(count($hotForumTopics) > 0) :conversation-data="{{ json_encode($hotForumTopics) }}" @endif
            :course-data="{{ json_encode($courses) }}"
            @if($startedContentCount > 0)
                continue-url="{{ url()->route('platform.lesson-history.in-progress') }}"
                :started-content="{{ $startedContentJson }}"
            @endif
        ></home>
    @include('partials._railanalytics-brand-tracking-iframe')
@endsection

