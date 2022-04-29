@if($hasPacks)
<section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
    <div class="tw-flex tw-flex-col tw-grow">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-3 tw-w-full tw-justify-between">
            <a href="{{ $packsUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Your Training Packs</h2>
            </a>
            <a href="{{ $packsUrl }}"  
                aria-label="See All Packs"
                class="tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                See All
            </a>
        </div> 

        <div class="tw-flex tw-flex-row tw-flex-wrap">
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
                    "forceSquareThumb" => true,
                    "logoImage" => $pack->fetch('data.logo_image_url'),
                    "releaseDate" => $pack->fetch('published_on'),
                    "isOwned" => true,
                ])
            @endforeach
        </div>
        
    </div>
</section>
@endif