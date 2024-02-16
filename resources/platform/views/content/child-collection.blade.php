@extends('partials.layout')

@php
//dd($goBackUrl);
$collectionAvatar = 'https://picsum.photos/300/300';
@endphp

@section('meta')
    <title>{{ $contentTitle }} | Musora</title>
@endsection

@section('content')
    <child-collection-page
        :content-title="{{ json_encode($contentTitle) }}"
        :content-subtitle="{{ json_encode($contentSubtitle) }}"
        :collection-name="{{ json_encode($collectionName) }}"
        :collection-avatar="{{ json_encode($collectionAvatar) }}"
        :content-type="{{ json_encode($contentType) }}"
        :plural-content-type="{{ json_encode($pluralContentType) }}"
        :content-name="{{ json_encode($contentName) }}"
        :go-back-url="{{ json_encode($goBackUrl) }}"
        header-background="{{ $thumbnail_url }}"
        :pre-loaded-content="{{ $initialContent }}"
        :filterable-values="{{ json_encode($filterableValues) }}"
        :limit="{{ 12 }}"
        :required-fields="{{ json_encode($requiredFields) }}"
    >
    </child-collection-page>
@endsection
