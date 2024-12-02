@extends('partials.layout', ['forceHideSidebar' => false, 'trackingSectionName' => 'Workouts'])

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('inject-components')
    {{-- TODO: Investigate if this js file can be deleted --}}
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>
@endsection

@section('content')
    {{-- Session Token for Railtracker progress tracking --}}
    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">

    <lesson-playback
        :lesson-type="{{ json_encode($primaryPage) }}"
    >
    </lesson-playback>

@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
