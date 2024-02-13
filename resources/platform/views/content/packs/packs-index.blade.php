@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Packs | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', [
        'backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/' . $brand . '-header.jpg',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                        <musora-icon icon-name="box-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        <span class="tw-text-32 tw-font-bold">Packs</span>
                    </h1>
                    <p class="tw-text-white tw-max-w-4xl tw-pr-12 tw-text-base">
                        @if ($brand === 'drumeo')
                            Training packs help you dive deeper and build expertise in specific skills and genres, taking your
                            drumming to the next level in particular areas you want to focus on.
                        @elseif($brand === 'pianote')
                            Training packs help you dive deeper and build expertise in specific skills and genres, taking your piano
                            playing to the next level in particular areas you want to focus on.
                        @elseif($brand === 'guitareo')
                            Training packs help you dive deeper and build expertise in specific skills and genres, taking your
                            guitar playing to the next level in particular areas you want to focus on.
                        @else
                            Here you can access Musora training packs. If you've purchased access to these packs individually you’ll
                            have lifetime access to them. If you own a Musora Membership you'll have access to these packs as long
                            as you're a member!
                        @endif
                    </p>
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-mb-3 tw-mt-[30px] lg:tw-px-4">
        <collection-wrapper
            collection-type="pack"
            :infinite-scroll="false"
            without_enrollment="{{ user()->isPackOnlyOwner() }}"
            :pre-loaded-content="{{ $packs }}"
            title="Packs"
            :filterable-values="{{ json_encode($catalogueMeta['allowableFilters'] ?? []) }}"
            default-sorts="-progress"
            :hide-sort-icon="true"
            limit = -1
            search-placeholder="Search all packs..."
        ></collection-wrapper>
    </div>

{{--    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3">--}}
{{--        <div class="tw-flex tw-flex-col">--}}
{{--            <div class="tw-flex tw-flex-row tw-pt-4">--}}
{{--                <h1 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl dark:tw-text-white">--}}
{{--                    Your Training Packs</h1>--}}
{{--            </div>--}}

{{--            @foreach ($packs as $index => $pack)--}}
{{--                @include('partials.bladesora.members.content.content-overview', [--}}
{{--                    "themeColor" => $brand,--}}
{{--                    "hideBorder" => $index === 0,--}}
{{--                    "itemThumbnail" => $pack->fetch('data.thumbnail_url'),--}}
{{--                    'itemId' => $pack->fetch('id'),--}}
{{--                    "itemTitle" => $pack->fetch('fields.title'),--}}
{{--                    "itemDescription" => $pack->fetch('data.description'),--}}
{{--                    "itemProgress" => $pack->fetch('progress_state'),--}}
{{--                    "itemType" => $pack->fetch('type'),--}}
{{--                    "itemUrl" => $pack->fetch('next_lesson_url'),--}}
{{--                    "lessonsUrl" => $pack->fetch('url'),--}}
{{--                    "logoImage" => $pack->fetch('data.logo_image_url'),--}}
{{--                    "forceSquareThumb" => true,--}}
{{--                    "releaseDate" => $pack->fetch('published_on_in_timezone'),--}}
{{--                    "isOwned" => true,--}}
{{--                    "statusText" => $pack->fetch('status_text')--}}
{{--                ])--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection

@section('layout-scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButtons = document.querySelectorAll('#addToPlaylistBtn');

            addButtons.forEach(function(button, index) {
                button.addEventListener('click', function() {
                    const payload = addButtons[index].getAttribute('data-payload');

                    window.openplaylistmodal({
                        modalType: 'addItem',
                        content: JSON.parse(payload)
                    });
                });
            });
        });
    </script>
@endsection
