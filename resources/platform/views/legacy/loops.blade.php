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
    {{-- Header --}}
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-4">
        <breadcrumb 
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Legacy Resources",
                    "url" => "/drumeo/legacy-resources",
                ],
                [
                    'title' => 'Loops'
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="loops"
            title="Loops"
            icon-name="metronome"
            description="Do you want to play-along to any style of music? Maybe you want to work on your speed or timing? Use the loops below to help you!"
        ></page-header>
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 mv-3">
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
