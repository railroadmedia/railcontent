@extends('partials.layout')

@section('meta')
    <title>Packs | Musora</title>
@endsection

@section('content')
       <div v-cloak>

            @component('partials._header-banner')
                @slot('content')
                    <div class="tw-flex tw-flex-col tw-pr-1">
                        <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4 tw-mt-14">
                            <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                                <i class="icon-packs tw-text-singeo tw-mr-3 tw-text-3xl"></i>
                                <span class="tw-text-32">Packs</span>
                            </h1>
                            <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                                Here you can access Singeo training packs. If you've purchased access to these packs
                                individually you’ll have lifetime access to them. If you own a Singeo Membership
                                you'll have access to these packs as long as you're a member!
                            </p>
                        </div>
                    </div>
                @endslot
            @endcomponent

            <div class="tw-container tw-mx-auto mv-3">
                <div class="tw-flex tw-flex-col">
                    <div class="tw-flex tw-flex-row pv-3">
                        <h1 class="heading">Your Training Packs</h1>
                    </div>

                    @foreach($packs as $index => $pack)
                        @include('partials.bladesora.members.content.content-overview', [
                            "themeColor" => "{{ $brand }}",
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

        </div>
@endsection
