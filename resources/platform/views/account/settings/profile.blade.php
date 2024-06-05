@extends('partials.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('content')
    {{-- Profile Page Component --}}
    <profile
        user-forum-signature="{{ $signature }}"
        :country-list="{{ json_encode(\Railroad\Location\Services\CountryListService::allWithCommonDuplicatedAtTop()) }}"
    ></profile>
@endsection