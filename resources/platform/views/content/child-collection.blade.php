@extends('partials.layout', ['trackingSectionName' => 'Songs'])

@section('meta')
    <title>{{ $contentTitle }} | Musora</title>
@endsection

@section('content')
    <child-collection-page
        :content-title="{{ json_encode($contentTitle) }}"
        :collection-name="{{ json_encode($collectionName) }}"
        :collection-avatar="{{ json_encode($thumbnail_url) }}"
        :content-type="{{ json_encode($contentType) }}"
        :content-name="{{ json_encode($contentName) }}"
        :go-back-url="{{ json_encode($goBackUrl) }}"
    >
    </child-collection-page>
@endsection
