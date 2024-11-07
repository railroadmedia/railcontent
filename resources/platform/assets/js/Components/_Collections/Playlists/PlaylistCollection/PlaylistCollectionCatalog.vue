<template>
    <main class="tw-w-full tw-pt-[16px]">

        <!-- No Playlists -->
        <section
            v-if="playlistsStore.playlists.length === 0 && !playlistsStore.loadingPlaylists && !state.searchTerm && !state.categories"
            class="tw-w-full tw-flex dark:tw-text-white tw-justify-center tw-flex-col"
            :class="miniCatalog ? 'tw-mt-1 tw-items-start' : 'tw-mt-[58px] tw-items-center'"
        >
            <musora-icon v-if="!miniCatalog" icon-name="playlist" width="57" height="57" class="tw-mb-2" />
            <h1 class=" tw-font-bold tw-text-center tw-mb-2"
                :class="miniCatalog ? 'tw-text-xl tw-mb-4' : 'tw-text-[30px] tw-leading-[48px]'"
            >
                No Playlists here yet
            </h1>
            <p v-if="!miniCatalog" class="tw-text-center tw-mb-4">
                Go ahead and create you first playlist!
            </p>
            <div class="tw-flex tw-items-center md:tw-block">
                <a :href="`/${brand}/create-playlist-window`"
                    class="tw-btn-primary tw-bg-[#000C17] tw-text-white dark:tw-bg-white dark:tw-text-[#000C17]">
                    <musora-icon icon-name="plus" class="tw-w-[30px] tw-mr-1" />
                    Create Playlist
                </a>
            </div>
        </section>

        <!-- Catalog -->
        <div v-else class="tw-w-full">
            <!-- Controls -->
            <PlaylistCollectionControls v-if="!props.miniCatalog || state.searchTerm.length" :brand="brand"
                :isListView="state.isListView" @onToggleListView="toggleListView" :initial-filter-options="filterOptions" />

            <!-- List View Header -->
            <header v-if="playlistsStore.playlists.length !== 0"
                class="tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-rounded-t-md tw-py-4 tw-px-6"
                :class="state.isListView && !miniCatalog ? 'tw-hidden md:tw-flex' : 'tw-hidden'">
                <div class="tw-w-full tw-flex">
                    <p class="tw-w-[72px] tw-flex-shrink-0">Name</p>
                    <div class="tw-grid tw-grid-cols-10 tw-w-full">
                        <div class="tw-col-span-3"></div>
                        <p class="tw-col-span-4 tw-pl-2">
                            <span class="tw-hidden xl:tw-block">Description</span>
                        </p>
                        <div class="tw-col-span-3 tw-w-full tw-flex">
                            <p class="tw-w-1/2">Category</p>
                            <p class="tw-w-1/2 tw-text-center">
                                Time
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tw-inline-flex tw-px-4 xl:tw-px-8"><span class="tw-w-[24px] tw-h-[24px]"></span></div>
                <!-- Spacer for Pin Icon -->
                <p class="tw-w-[100px] tw-text-center">Options</p>
            </header>

            <!-- Cards -->
            <section v-if="!playlistsStore.loadingPlaylists && !miniCatalog" class="tw-w-full tw-relative tw-mb-5"
                :class="state.isListView && !miniCatalog ? 'tw-flex tw-flex-col' : 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 3xl:tw-grid-cols-6 tw-gap-4'">
                <!-- Full Catalog -->
                <playlist-collection-card v-for="(listElement, i) in playlistsStore.playlists" :key="listElement.id"
                    :listElement="listElement" :isListView="state.isListView" :token="token" :brand="brand" :index="i" />
            </section>
            <section v-if="!playlistsStore.loadingPlaylists && miniCatalog && !state.isListView" class="tw-w-full tw-block tw-no-scrollbar tw-pt-4 tw--mt-4 tw-overflow-x-auto lg:tw-overflow-x-visible">
                <div
                    class="PlaylistMiniCatalogContainer tw-w-full tw-gap-[6px] tw-relative tw-grid tw-auto-cols-min lg:tw-auto-cols-auto tw-grid-cols-6 lg:tw-grid-cols-5 2xl:tw-grid-cols-6 xl:tw-gap-[12px] 2xl:tw-gap-[16px] tw-min-w-max lg:tw-min-w-full tw-pt-4 tw--mt-4 tw-overflow-x-auto lg:tw-overflow-x-visible"
                    :class="miniViewRowStyles"
                >
                    <!-- Mini Catalog -->
                    <playlist-collection-card v-for="(listElement, i) in playlists" :key="listElement.id"
                        :listElement="listElement" :isListView="false" :isMiniCatalog="true" :token="token" :index="i"
                        :brand="brand" :trackingSection="trackingSection" />
                </div>
            </section>

            <!-- Pagination -->
            <Pagination v-if="!miniCatalog && !playlistsStore.loadingPlaylists && playlistsStore.playlistsQuantity > 10"
                :currentPage="playlistsStore.resultsPage" :pageQuantity="playlistsStore.playlistsQuantity" :limit="10"
                @pageChange="handlePageChange" />

            <!-- No Playlists -->
            <section v-if="playlistsStore.playlists.length === 0 && (state.categories || state.searchTerm)"
                class="tw-w-full tw-flex tw-flex-col dark:tw-text-white tw-items-center tw-mt-[58px]">
                <h2 class="tw-text-3xl tw-font-bold tw-mb-[15px]">No results found for <span
                        v-if="state.categories">category <span :class="`tw-text-${brand}`">{{ state.categories
                        }}</span></span> <span v-if="state.categories && state.searchTerm">and</span> <span
                        v-if="state.searchTerm">keyword <span :class="`tw-text-${brand}`">{{ state.searchTerm
                        }}</span></span></h2>
            </section>
        </div>

        <!-- Skeleton Loader -->
        <div v-if="playlistsStore.loadingPlaylists" class="tw-w-full tw-animate-pulse"
            :class="state.isListView && !miniCatalog ? 'tw-flex tw-flex-col' : 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 tw-gap-4 tw-mt-4'">
            <div v-for="(n, index) in (playlistsStore.playlists.length)" :key="n" class="tw-flex tw-w-full "
                :class="state.isListView && !miniCatalog ? 'tw-h-[52px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]' : 'tw-flex-col'">
                <template v-if="index <= 10">
                    <div class="tw-w-full tw-bg-[#E6E7E9] dark:tw-bg-[#081825] tw-aspect-square"
                        :class="state.isListView && !miniCatalog ? 'tw-hidden' : 'tw-rounded-lg'"></div>
                    <div
                        :class="state.isListView && !miniCatalog ? 'tw-hidden' : 'tw-mt-2 tw-w-full tw-bg-[#E6E7E9] dark:tw-bg-[#081825] tw-aspect-square tw-h-[44px] tw-rounded-lg'">
                    </div>
                </template>
            </div>
        </div>

    </main>
</template>

<script setup>
import { onBeforeMount, onMounted, onUpdated, watch, inject, reactive, computed } from 'vue';
import { usePlaylistsStore } from '@stores/playlists';
import PlaylistCollectionControls from './PlaylistCollectionControls.vue';
import PlaylistCollectionCard from './PlaylistCollectionCard.vue';
import Pagination from '@collections/Pagination/Pagination.vue';
import { useUserStore } from "@stores/user";
import {storeToRefs} from "pinia/dist/pinia";

//Inject
const token = inject('csrf_token');

//Pinia Stores
const playlistsStore = usePlaylistsStore();
const userStore = useUserStore();

const { brand } = storeToRefs(userStore)

//-----------Props-----------//
const props = defineProps({
    playlists: {
        type: Array,
        default: []
    },
    playlistCount: {
        type: Number,
        default: 0
    },
    miniCatalog: {
        type: Boolean,
        default: false,
    },
    filterOptions: {
        type: [Object, Array],
        default: null
    },
    trackingSection: {
        type: String,
        default: ''
    },
    miniViewPage: {
        type: Number,
        default: 1
    },
    miniViewCardNum: {
        type: Number,
        default: 1
    }
})

//---------Computed Props---------//
const hasPlaylists = computed(() => {
    return props.playlistCount ? true : false;
})

const miniViewRowStyles = computed(() => {
    if(props.miniViewPage > 1){
        return 'tw-grid-rows-2 ';
    }
})

//---------Reactive Data---------//
const state = reactive({
    isListView: false,
    showControls: true,
    searchTerm: '',
    sortValue: '',
    categories: '',
})

//----------Methods----------//

const handlePageChange = (pageNumber) => {
    //load playlists
    playlistsStore.loadingPlaylists = true;
    playlistsStore.getPlaylists({ brand: brand.value, page: pageNumber, term: state.searchTerm, sort: state.sortValue, categories: state.categories ? [state.categories] : [], limit: 10 }, token);
    //update current page number
    playlistsStore.resultsPage = pageNumber;
    //update url
    let url = new URL(window.location.href);
    url.searchParams.set('page', pageNumber)
    window.history.pushState({}, '', url);
}

const toggleListView = () => {
    state.isListView = !state.isListView;
}

//---------Lifecycle Methods---------//

onMounted(()=> {
    if(!props.miniCatalog) {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });

        playlistsStore.loadingPlaylists = true;
        playlistsStore.getPlaylists(
            {
                brand: brand.value,
                page: params.page || 1,
                limit: null,
                term: state.searchTerm,
                sort: state.sortValue,
                categories: state.categories ? [state.categories] : [],
            }, token);
    }
    //For Create Modal to reload Playlists
    playlistsStore.pageHasPlaylistCatalog = true;
})

onBeforeMount(() => {
    // console.log(props.playlists)
    //Get Local Storage Value
    if (!props.miniCatalog) {
        if(localStorage.getItem('playlistIsListView')) {
            state.isListView = JSON.parse(localStorage.getItem('playlistIsListView'));
        }
    }

    //Get URL Params
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    //Set resultsPage
    playlistsStore.resultsPage = Number(params.page || 1);
    state.searchTerm = params.search || '';
    state.categories = params['categories[]'] || '';
    state.sortValue = params.sortby_val || '-created_at';
});

onUpdated(()=> {
    //Get URL Params
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    state.searchTerm = params.search || '';
    state.categories = params['categories[]'] || '';
    state.sortValue = params.sortby_val || '-created_at';
})

//-----------Watchers-----------//

//Store ListView to Local Storage
watch(state, async () => {
    if (!props.miniCatalog) {
        localStorage.setItem('playlistIsListView', state.isListView);
    }
})

</script>
