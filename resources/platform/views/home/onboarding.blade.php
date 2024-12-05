@php
    $drumeo = new StdClass();
    $singeo = new StdClass();
    $pianote = new StdClass();
    $guitareo = new StdClass();

    $drumeo->brand = 'drumeo';
    $singeo->brand = 'singeo';
    $pianote->brand = 'pianote';
    $guitareo->brand = 'guitareo';
    $selectedGoals = array($drumeo, $guitareo, $singeo, $pianote);
@endphp

@extends('partials.layout', ['hideHelpscoutInMobile' => true])

@section('meta')
    <title>Onboarding | Musora</title>
@endsection

@section('content')
        <onboarding
            :selected-brand="{{ json_encode(request()->get('brand')) }}"
            @if(request()->get('update') !== null)
                :start-on-step="{{ json_encode(intval(request()->get('update'))) }}"
            @endif
            :new-user="{{ $newUser }}"
            :primary-brand="{{ json_encode(user()->primary_brand) }}"
            :config-options="{{ json_encode(config('onboarding.options')) }}"
            :selected-gear="{{ json_encode(user()->onboardingGear) }}"
            :selected-topics="{{ json_encode(user()->onboardingTopics) }}"
            :selected-genres="{{ json_encode(user()->onboardingGenres) }}"
            :selected-experience="{{ json_encode(user()->onboardingExperience) }}"
            :selected-goals="{{ json_encode(user()->onboardingGoals)}}"
        ></onboarding>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
