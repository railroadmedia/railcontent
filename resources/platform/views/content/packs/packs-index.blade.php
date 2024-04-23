@extends('partials.layout', ['trackingSectionName' => 'packs'])

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

    <!-- <page-header
        page-type="pack"
        title="Packs"
        icon-name="box-filled"
        description="Training packs help you dive deeper and build expertise in specific skills and genres, taking your drumming to the next level in particular areas you want to focus on."
    ></page-header> -->

    <div class="tw-container tw-mx-auto tw-mb-3 tw-mt-[30px] tw-px-4 lg:tw-px-8">
        <collection-wrapper
            collection-type="pack"
            :infinite-scroll="false"
            without-enrollment="{{ user()->isPackOnlyOwner() }}"
            :pre-loaded-content="{{ $packs }}"
            title="Packs"
            :filterable-values="{{ json_encode($catalogueMeta['allowableFilters'] ?? []) }}"
            default-sorts="-progress"
            :limit="-1"
            :hide-filter-icon="{{ json_encode(true) }}"
            :sort-options="{{ json_encode([
                        [ 'value' => '-published_on', 'name' => 'Newest First', 'icon' => 'sort-down' ],
                        [ 'value' => 'published_on', 'name' => 'Oldest First', 'icon' => 'sort-up' ],
                        [ 'value' => 'title', 'name' => 'Name: A to Z', 'icon' => 'sort-name-asc' ],
                        [ 'value' => '-title', 'name' => 'Name: Z to A', 'icon' => 'sort-name-desc' ]
                    ]) }}"
        ></collection-wrapper>
    </div>

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
