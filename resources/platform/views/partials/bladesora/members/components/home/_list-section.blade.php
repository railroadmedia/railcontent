<section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
    <div class="tw-flex tw-flex-col tw-grow">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
            <a href="{{ $myListUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Playlists</h2>
            </a>
            <a href="{{ $myListUrl }}"
                aria-label="See All Lessons In My List"
                class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                See All
            </a>
        </div>
                    
        {{-- Playlist Catalog --}}
        <playlist-collection-catalog
            brand="{{ $brand }}"
            :mini-catalog="true"
            :playlist-count="{{ $usersList->totalResults() }}"
            :playlists="{{ json_encode($usersList->results()) }}"
        ></playlist-collection-catalog>

    </div>
</section>
