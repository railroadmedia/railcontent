@extends('partials.layout')

@section('meta')
    <title>{{ $contentTitle }} | Musora</title>
@endsection

@section('content')
    <child-collection-page
        :content-title="{{ json_encode($contentTitle) }}"
        :content-subtitle="{{ json_encode($contentSubtitle) }}"
        :collection-name="{{ json_encode($collectionName) }}"
        :collection-avatar="{{ json_encode($thumbnail_url) }}"
        :content-type="{{ json_encode($contentType) }}"
        :included-types="{{ json_encode($allowedTypes ?? $contentType) }}"
        :plural-content-type="{{ json_encode($pluralContentType) }}"
        :content-name="{{ json_encode($contentName) }}"
        :go-back-url="{{ json_encode($goBackUrl) }}"
        :pre-loaded-content="{{ $initialContent }}"
        :filterable-values="{{ json_encode($filterableValues) }}"
        :limit="{{ 12 }}"
        :required-fields="{{ json_encode($requiredFields) }}"
    >
    </child-collection-page>
@endsection
