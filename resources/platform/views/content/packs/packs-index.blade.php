@extends('partials.layout')

@section('meta')
    <title>Packs | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner',
        ['backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg'])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                        <i class="icon-packs tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                        <span class="tw-text-32 tw-font-bold">Packs</span>
                    </h1>
                    <p class="tw-text-white tw-max-w-4xl tw-pr-12 tw-text-base">
                        Here you can access Musora training packs. If you've purchased access to these packs
                        individually you’ll have lifetime access to them. If you own a Musora Membership
                        you'll have access to these packs as long as you're a member!
                    </p>
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3">
        <div class="tw-flex tw-flex-col">
            
            <div class="tw-flex tw-flex-row tw-pt-2">
                <h1 class="tw-text-[30px] tw-font-bold dark:tw-text-white">Your Training Packs</h1>
            </div>

            @foreach($packs as $index => $pack)
                @include('partials.bladesora.members.content.content-overview', [
                    "themeColor" => $brand,
                    "hideBorder" => $index === 0,
                    "itemThumbnail" => $pack->fetch('data.thumbnail_url'),
                    "itemTitle" => $pack->fetch('fields.title'),
                    "itemDescription" => $pack->fetch('data.description'),
                    "itemProgress" => $pack->fetch('progress_state'),
                    "itemType" => $pack->fetch('type'),
                    "itemUrl" => $pack->fetch('next_lesson_url'),
                    "lessonsUrl" => $pack->fetch('url'),
                    "logoImage" => $pack->fetch('data.logo_image_url'),
                    "forceSquareThumb" => true,
                    "releaseDate" => $pack->fetch('published_on_in_timezone'),
                    "isOwned" => true,
                ])
            @endforeach
        </div>
    </div>

@endsection
