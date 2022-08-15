@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

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

@section('scripts')
    @parent

@stop()

@section('content')
    @include('members.partials._drumeo-sidebar')

    <header id="pageHeader" class="container fluid pv-4" style="background-image:url({{ cdn('headers/members-header-background-image.jpg') }});">
        <div class="container text-center">
            <h1 class="heading text-white mb-2">
                <i class="icon-loops text-drumeo"></i> Loops
            </h1>
            <p class="body text-white">Do you want to play-along to any style of music?</p>
            <p class="body text-white">Maybe you want to work on your speed or timing?</p>
            <p class="body text-white">Use the loops below to help you!</p>
        </div>
    </header>

    <div class="container">
        <div class="flex flex-column mb-3">
            <div class="flex flex-row ph-1 pv-3">
                <h1 class="heading">Bass Loops</h1>
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
                <h1 class="heading">Speed Accelerator Trainers</h1>
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
                <h1 class="heading">Click Track Trainers</h1>
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
                <h1 class="heading">Percussion Loops</h1>
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