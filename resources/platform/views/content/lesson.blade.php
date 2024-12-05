@php
//   TODO: Won't fix for now, leaving in for future reference, not sure if workouts uses it (?)
//   https://musoraproduct.myjetbrains.com/youtrack/issue/BR-1258/Drumeo-QA-Buttons-Not-Connecting
//   $hasQAVideo = !empty($lessonContent['qna_video_playback_endpoints']);
@endphp

@extends('partials.layout', ['forceHideSidebar' => false])

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('inject-components')
    {{-- TODO: Investigate if this js file can be deleted --}}
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>
@endsection

@section('content')
    {{-- Session Token for Railtracker progress tracking --}}
    {{-- TODO: Investigate if we still need to add the railtracker_session_token since we generate a new one in the JS side --}}
    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">
    <lesson-playback
    ></lesson-playback>

@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
