<script setup>
    import { onBeforeMount, onMounted, onUpdated, watch, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import PlaylistCollectionControls from './PlaylistCollectionControls.vue';
    import PlaylistCollectionCard from './PlaylistCollectionCard.vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import Pagination from '../../../components/Pagination/Pagination.vue';

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
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
        }
    })

   //---------Computed Props---------//
    const hasPlaylists = computed(() => {
        return props.playlistCount ? true : false;
    })

    //---------Reactive Data---------//
    const state = reactive({
        isListView: false,
        showControls: true,
        searchTerm: '',
        sortValue: '',
    })

    //----------Methods----------//

    const handlePageChange = (pageNumber) => {
        //load playlists
        playlistsStore.loadingPlaylists = true;
        playlistsStore.getPlaylists({ brand: props.brand, page: pageNumber, term: state.searchTerm, sort: state.sortValue, limit: 10 }, token);
        //update current page number
        playlistsStore.resultsPage = pageNumber;
        //update url
        let url = new URL(window.location.href);
        url.searchParams.set('page', pageNumber)
        window.history.pushState({}, '', url);
    }

    //---------Lifecycle Methods---------//

    onMounted(()=> {
        //load Playlists
        if(props.playlistCount <= 10 && props.playlists.length <= 10) {
            playlistsStore.playlists = props.playlists;
        } else {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });

            playlistsStore.loadingPlaylists = true;
            playlistsStore.getPlaylists(
                {
                    brand: brand,
                    page: params.page || 1,
                    limit: null,
                    term: state.searchTerm,
                    sort: state.sortValue,
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
        state.sortValue = params.sortby_val || '-created_at';
    });

    onUpdated(()=> {
        //Get URL Params
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        state.searchTerm = params.search || '';
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
<template>
    <main class="tw-w-full">
        <!-- No Playlists -->
        <section v-if="playlistsStore.playlists.length === 0 && !playlistsStore.loadingPlaylists && !state.searchTerm.length"
                 class="tw-w-full tw-flex dark:tw-text-white tw-items-center "
                 :class="miniCatalog ? 'tw-mt-1' : 'tw-mt-[58px] tw-flex-col'"
        >
            <div class="tw-h-[84px] tw-w-[84px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-white dark:tw-text-[#9EC0DC] tw-transition-colors tw-bg-[#223F57] dark:tw-bg-[#445F74] "
                 :class="{'tw-mb-[30px]': !miniCatalog}"
            >
                <musora-icon icon-name="playlist" class="tw-w-[36px]" />
            </div>
            <div :class="{'tw-ml-4': miniCatalog}">
                <h1 class="tw-text-3xl tw-font-normal tw-font-open-sans tw-text-[16px]" :class="!miniCatalog ? 'tw-mb-[15px]' : 'tw-mb-2' ">
                    You haven't created any playlists yet.
                </h1>
            </div>
        </section>

        <!-- Catalog -->
        <div v-if="playlistsStore.playlists.length !== 0 || state.searchTerm.length" class="tw-w-full">
            <!-- Controls -->
            <PlaylistCollectionControls
                v-if="!props.miniCatalog || state.searchTerm.length"
                :brand="brand"
                :isListView="state.isListView"
                @onUpdateListView="(val) => state.isListView = val"
            />

            <!-- List View Header -->
            <header v-if="playlistsStore.playlists.length !== 0" class="tw-w-full tw-font-bold tw-items-center tw-transition-colors tw-bg-[#E6E7E9] dark:tw-bg-[#002039] tw-text-[#0D0D0D] dark:tw-text-white tw-mb-1 tw-rounded-t-md tw-py-4 tw-pl-[48px]"
                    :class="state.isListView && !miniCatalog ? 'tw-hidden md:tw-flex' : 'tw-hidden'"
            >
                <div class="tw-grid tw-grid-cols-10 tw-w-full">
                    <p class="tw-col-span-2 tw-relative">
                        <span class="tw-ml-[-24px] tw-inline-block">Name</span>
                    </p>
                    <p class="tw-col-span-5 tw-pl-2">
                        <span class="tw-hidden xl:tw-block">Description</span>
                    </p>
                    <div class="tw-col-span-3 tw-w-full tw-flex">
                        <p class="tw-w-1/2 tw-text-center">Category</p>
                        <p class="tw-w-1/2 tw-text-center">
                            Time
                        </p>
                    </div>
                </div>
                <div class="tw-inline-flex tw-px-4 xl:tw-px-8"><span class="tw-w-[24px] tw-h-[24px]"></span></div> <!-- Spacer for Pin Icon -->
                <p class="tw-pr-[22px] tw-w-[100px] tw-text-center">Options</p>
            </header>

            <!-- Cards -->
            <section v-if="!playlistsStore.loadingPlaylists" class="tw-w-full tw-relative tw-mb-5"
                :class="state.isListView && !miniCatalog ? 'tw-flex tw-flex-col' : 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 3xl:tw-grid-cols-6 tw-gap-4' "
            >
                <!-- Mini Catalog -->
                <template v-if="miniCatalog">
                    <playlist-collection-card
                        v-for="listElement in playlistsStore.playlists.slice(0,5)"
                        :key="listElement.id"
                        :listElement="listElement"
                        :isListView="false"
                        :token="token"
                        :brand="brand"
                    />
                </template>
                <!-- Full Catalog -->
                <template v-else>
                    <playlist-collection-card
                        v-for="listElement in playlistsStore.playlists"
                        :key="listElement.id"
                        :listElement="listElement"
                        :isListView="state.isListView"
                        :token="token"
                        :brand="brand"
                    />
                </template>
            </section>

            <!-- Pagination -->
            <Pagination
                v-if="!miniCatalog && !playlistsStore.loadingPlaylists && playlistsStore.playlistsQuantity > 10"
                :currentPage="playlistsStore.resultsPage"
                :pageQuantity="playlistsStore.playlistsQuantity"
                :limit="10"
                @pageChange="handlePageChange"
            />

            <!-- No Playlists -->
            <section v-if="playlistsStore.playlists.length === 0 && state.searchTerm" class="tw-w-full tw-flex tw-flex-col dark:tw-text-white tw-items-center tw-mt-[58px]">
                <h2 class="tw-text-3xl tw-font-bold tw-mb-[15px]">No results found for <span :class="`tw-text-${brand}`">{{ state.searchTerm }}</span></h2>
            </section>
        </div>

        <!-- Skeleton Loader -->
        <div v-if="playlistsStore.loadingPlaylists"
             class="tw-w-full tw-animate-pulse"
             :class="state.isListView && !miniCatalog ? 'tw-flex tw-flex-col' : 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 tw-gap-4 tw-mt-4' "
        >
            <div v-for="(n, index) in (playlistsStore.playlists.length)"
                :key="n"
                class="tw-flex tw-w-full "
                :class="state.isListView && !miniCatalog ? 'tw-h-[52px] tw-flex-row tw-items-center tw-transition-colors tw-py-0.5 even:tw-bg-[#E6E7E9] dark:even:tw-bg-[#081825]' : 'tw-flex-col'"
            >
                <template v-if="index <= 10">
                    <div class="tw-w-full tw-bg-[#E6E7E9] dark:tw-bg-[#081825] tw-aspect-square"
                         :class="state.isListView && !miniCatalog ? 'tw-hidden' : 'tw-rounded-lg'"
                    ></div>
                    <div :class="state.isListView && !miniCatalog ? 'tw-hidden' : 'tw-mt-2 tw-w-full tw-bg-[#E6E7E9] dark:tw-bg-[#081825] tw-aspect-square tw-h-[44px] tw-rounded-lg' "></div>
                </template>
            </div>
        </div>

    </main>
</template>
