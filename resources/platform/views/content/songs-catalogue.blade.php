@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('content')
    <songs
        :started-content="{{ $startedLessons }}"
        :list-lessons="{{ $listLessons }}"
        :show-upgrade-modal="{{ json_encode($showUpgradeModal) }}"
    >
    </songs>
@endsection
