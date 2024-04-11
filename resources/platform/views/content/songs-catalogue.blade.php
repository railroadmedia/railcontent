@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('content')
    <songs
        continue-url="/{{$brand}}/lesson-history/in-progress"
        :all-artists-url="{{ json_encode($allArtistUrl) }}"
        :artists-number="{{ json_encode($artistsNumber) }}"
        :songs-number="{{ json_encode($songsNumber) }}"
        :started-content="{{ $startedLessons }}"
        :list-lessons="{{ $listLessons }}"
        :tabs="{{ json_encode($catalogueMeta['tabs'] ?? []) }}"
        :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
    >
    </songs>
@endsection
