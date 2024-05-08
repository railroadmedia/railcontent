@extends('partials.layout')

@section('meta')
    <title>Lesson History | Musora</title>
@endsection

@section('content')

    <lesson-history
        collection-type="history"
        :pre-loaded-content="{{ $listLessons }}"
        :included-types="{{ json_encode($allowedTypes) }}"
        :hide-search="false"
        :hide-sort-icon="false"
        :tab-options="{{ json_encode([
                        [ 'key' => 'inProgress', 'value' => 'In Progress' ],
                        [ 'key' => 'complete', 'value' => 'Complete' ]
                    ]) }}"
        @if($resetProgress)
            :show-reset-progress="{{ json_encode(true) }}"
        @endif
    ></lesson-history>
@endsection
