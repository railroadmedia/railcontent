@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Comments | Musora</title>
@endsection

@section('content')
    <div class="container">
        <div class="flex flex-column bg-white shadows corners-10 mv-3">
            <comments-catalogue
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    user-id="{{ user()->id }}"
                    user-name="{{ user()->display_name }}"
                    user-avatar="{{ user()->profile_picture_url }}"
                    user-xp="123"
                    user-access-level="team"
                    profile-base-route="/members/profile/"
                    :is-admin="true"></comments-catalogue>
        </div>
    </div>
@endsection
