@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Comments | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full container">
        <div class="flex flex-column tw-w-full">
            <comments-catalogue
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    user-id="{{ user()->id }}"
                    user-name="{{ user()->display_name }}"
                    user-avatar="{{ user()->profile_picture_url }}"
                    user-xp="{{user()->getBrandTotalXp()}}"
                    user-access-level="{{user()->access_level}}"
                    profile-base-route="/members/profile/"
                    :is-admin="true"></comments-catalogue>
        </div>
    </div>
@endsection
