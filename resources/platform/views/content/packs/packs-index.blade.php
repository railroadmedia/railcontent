@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Packs | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner',
        ['backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg'])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">        
                        <musora-icon icon-name="box-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        <span class="tw-text-32 tw-font-bold">Packs</span>
                    </h1>
                    <p class="tw-text-white tw-max-w-4xl tw-pr-12 tw-text-base">
                        @if($brand === "drumeo")
                            Training packs help you dive deeper and build expertise in specific skills and genres, taking your drumming to the next level in particular areas you want to focus on.
                        @elseif($brand === "pianote")
                            Training packs help you dive deeper and build expertise in specific skills and genres, taking your piano playing to the next level in particular areas you want to focus on.
                        @elseif($brand === "guitareo")
                            Training packs help you dive deeper and build expertise in specific skills and genres, taking your guitar playing to the next level in particular areas you want to focus on.
                        @else
                            Here you can access Musora training packs. If you've purchased access to these packs individually you’ll have lifetime access to them. If you own a Musora Membership you'll have access to these packs as long as you're a member!
                        @endif
                    </p>
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3">
        <div class="tw-flex tw-flex-col">
            @if(empty(user()->membership_expiration_date) && user()->isPackOwner()) 
                <static-header
                    title="JOIN THE COMMUNITY"
                    cta-text="UPGRADE YOUR MEMBERSHIP"
                    description="Click here to upgrade your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
                    cta-url="{{ get_legacy_brand_base_url() . '/shop'  }}"
                    img="https://musora.com/cdn-cgi/image/width=720/https://cdn.musora.com/image/fetch/c_fill,w_1920,h_1080,q_auto:good/https://musora-web-platform.s3.amazonaws.com/carousel/pre-launch-header-image-jpg.jpg"
                ></static-header>
            @endif
            
            <div class="tw-flex tw-flex-row tw-pt-4">
                <h1 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl dark:tw-text-white">Your Training Packs</h1>
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
