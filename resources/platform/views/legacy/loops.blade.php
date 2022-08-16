@extends('partials.layout')

@section('meta')
    <title>Loops | Drumeo</title>
@endsection

@section('styles')
    <style>
        .loops-audio-player {
            position:sticky;
            bottom:0;
            background-color:#fff;
        }
    </style>
@endsection

@section('content')
    @include('members.partials._drumeo-sidebar')

    @component('partials._header-banner', [
        'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <i class="icon-loops  tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32 tw-font-bold">Loops</span>
                </h1>
                <p class="tw-text-white tw-max-w-4xl tw-pr-12 tw-text-base">
                    Do you want to play-along to any style of music?
                </p>
                <p class="tw-text-white tw-max-w-4xl tw-pr-12 tw-text-base">
                    Maybe you want to work on your speed or timing?
                </p>
                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    Use the loops below to help you!
                </p>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
        <div class="flex flex-column mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading dark:tw-text-white">Bass Loops</h1>
            </div>

            <div class="flex flex-row">
                <legacy-loops
                    :loops="{{ json_encode($bassLoops) }}"
                    audio-player-id="bassLoops"
                ></legacy-loops>
            </div>
        </div>

        <div class="flex flex-column mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading dark:tw-text-white">Speed Accelerator Trainers</h1>
            </div>

            <div class="flex flex-row">
                <legacy-loops
                    :loops="{{ json_encode($speedTrainers) }}"
                    audio-player-id="speedTrainers"
                    :click-track="false"
                ></legacy-loops>
            </div>
        </div>

        <div class="flex flex-column mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading dark:tw-text-white">Click Track Trainers</h1>
            </div>

            <div class="flex flex-row">
                <legacy-loops
                    :loops="{{ json_encode($clickTrackTrainers) }}"
                    audio-player-id="clickTrackTrainers"
                    :click-track="false"
                ></legacy-loops>
            </div>
        </div>

        <div class="flex flex-column mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading dark:tw-text-white">Percussion Loops</h1>
            </div>

            <div class="flex flex-row">
                <legacy-loops
                    :loops="{{ json_encode($percussionLoops) }}"
                    audio-player-id="percussionLoops"
                    :click-track="false"
                ></legacy-loops>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent

@stop()