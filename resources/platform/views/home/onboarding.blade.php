@extends('partials.layout')

@section('meta')
    <title>Onboarding | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <onboarding
            :config-options="{{ json_encode(config('onboarding.options')) }}"
            :selected-gear="{{ json_encode(user()->onboardingGear) }}"
            :selected-topics="{{ json_encode(user()->onboardingTopics) }}"
            :selected-genres="{{ json_encode(user()->onboardingGenres) }}"
            :selected-experience="{{ json_encode(user()->onboardingExperience) }}"
        ></onboarding>
    </div>
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~onboarding.js') }}"></script>
@endsection
