@component('partials.bladesora.members.components.header-banner', [
    'hideUser' => true,
    'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
])
    @slot('content')
        <div class="flex flex-column pr-1 align-v-bottom align-h-center">
            <img
                    alt="{{ $pack->fetch('title') }} Logo"
                    src="{{ $pack->fetch('data.logo_image_url') }}"
                    class="mb-2"
                    style="width: 100%;max-width:480px;"
            >

            @if($pack['slug'] !== 'learn-songs-faster')
                <h1 class="heading text-white mb-2">
                    {{ $parentContent->fetch('fields.title') }}
                </h1>
            @endif

            @if($parentContent->fetch('type') === 'pack-bundle' && $pack->fetch('bundle_count') > 1)
                <a href="{{ url()->route('packs.bundles', ["packSlug" => $pack->fetch('slug')]) }}"
                   class="btn collapse-200 bg-white inverted short text-white">
                    Back to All Lessons
                </a>
            @endif
        </div>
    @endslot
@endcomponent