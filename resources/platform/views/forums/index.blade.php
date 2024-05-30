@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Forums | Musora</title>
@endsection

@section('content')
    <forums :user-access-level="{{ json_encode($user['access_level']) }}"
        :pinned-threads="{{ json_encode($pinnedThreads) }}" :threads="{{ json_encode($threads) }}"
        :forums="{{ json_encode($discussions) }}" :thread-count="{{ $threadCount }}"
        create-category-form-url="{{ url()->route('forums.show-create-category-form') }}"
        community-guidelines-url="{{ \App\Modules\Brand\Services\BrandService::getForumsUrl() }}"
        latest-threads-url="{{ url()->route('forums.show-all-latest-threads') }}"
        search-json-results-endpoint-url="{{ url()->route('forums.get-search-results-json') }}"></forums>
@endsection
