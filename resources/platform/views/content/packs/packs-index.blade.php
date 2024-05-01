@php
    $headerDescription = "";
    if ($brand === "drumeo") {
        $headerDescription = "Training packs help you dive deeper and build expertise in specific skills and genres, taking your drumming to the next level in particular areas you want to focus on.";
    } elseif ($brand === "pianote") {
        $headerDescription = "Training packs help you dive deeper and build expertise in specific skills and genres, taking your piano playing to the next level in particular areas you want to focus on.";
    } elseif ($brand === "guitareo") {
        $headerDescription = "Training packs help you dive deeper and build expertise in specific skills and genres, taking your guitar playing to the next level in particular areas you want to focus on.";
    } else {
        $headerDescription = "Here you can access Musora training packs. If you've purchased access to these packs individually you’ll have lifetime access to them. If you own a Musora Membership you'll have access to these packs as long as you're a member!";
    }
@endphp

@extends('partials.layout', ['trackingSectionName' => 'packs'])

@section('meta')
    <title>{{ ucfirst($brand) }} Packs | Musora</title>
@endsection

@section('content')

    <page-header
        page-type="packs"
        title="Packs"
        icon-name="box"
        description="{{ $headerDescription }}"
    ></page-header>

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
