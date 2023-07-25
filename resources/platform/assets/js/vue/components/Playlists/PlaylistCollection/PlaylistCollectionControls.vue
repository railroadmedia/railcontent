<script setup>
    import { onBeforeMount, watch, ref, inject, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import { XIcon } from "@heroicons/vue/solid";
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //Emits
    const emit = defineEmits(['onUpdateListView']);

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        isListView: {
            type: Boolean,
            default: false,
        }
    });

    //---------Reactive Data---------//
    const state = reactive({
        searchTerm: '',
        sortValue: '-created_at', //Default
        categories: '',
    })

    //---------Template Refs---------//
    const playlistSearch = ref(null)

    //---------Static Data---------//
    const sortOptions =[
        { text: 'Newest First', value: '-created_at' },
        { text: 'Alphabetical', value: 'name' },
        { text: 'Most Recent', value: '-last_progress' },
        { text: 'Pinned', value: 'pinned' }
    ]

    const categories = [
        {
            text: 'Watch-Later',
            value: 'Watch Later',
        },
        {
            text: 'Favorites',
            value: 'Favorites',
        },
        {
            text: 'General',
            value: 'General',
        },
        {
            text: 'Practice',
            value: 'Practice',
        },
        {
            text: 'Learning',
            value: 'Learning',
        },
        {
            text: 'Entertainment',
            value: 'Entertainment',
        },
        {
            text: 'Warm-Up',
            value: 'Warm Up',
        },
        {
            text: 'Songs',
            value: 'Songs',
        }
    ];

    //----------Methods----------//
    const loadPlaylists = ()=> {
        const payload = {
            brand: brand,
            page: 1,
            limit: 10,
            term: state.searchTerm,
            sort: state.sortValue,
            categories: state.categories ? [state.categories] : '',
        }
        //load Playlists
        playlistsStore.getPlaylists(payload, token);
        //Update URL w/ new params
        const url = new URL(window.location.href);
        url.searchParams.set('sortby_val', state.sortValue);
        url.searchParams.set('search', state.searchTerm);
        url.searchParams.set('page', 1);
        if(state.categories) url.searchParams.set('categories[]', state.categories);
        else url.searchParams.delete('categories[]');

        playlistsStore.resultsPage = 1;
        window.history.pushState({}, '', url);
        //Blur Input
        playlistSearch.value.blur();
    };

    const cancelCategoryFilter = ()=> {
        state.categories = '';
        loadPlaylists();
    }

    //---------Lifecycle Methods---------//
    onBeforeMount(()=> {
        //get url params
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        //Set state props
        state.searchTerm = params.search || '';
        state.categories = params['categories[]'] || '';
        state.sortValue = params.sortby_val || '-created_at';
    })
</script>
<template>
    <nav class="tw-flex tw-my-4 tw-w-full tw-items-center tw-flex-wrap md:tw-flex-nowrap">
        <!--Sort -->
        <div class="tw-w-full tw-max-w-[calc(100%-68px)] tw-pr-3 md:tw-pr-0 md:tw-max-w-[290px] tw-mr-auto tw-order-3 md:tw-order-1 form-group md:tw-mr-1">
            <select name="playlist-sort"
                    id="playlist-sort"
                    class="tw-transition-colors tw-w-full tw-rounded-3xl tw-text-[#00101D] focus:tw-ring-0 dark:tw-text-[#9EC0DC] dark:tw-border-[#445F74] tw-bg-white dark:tw-bg-transparent"
                    v-model="state.sortValue"
                    @change="loadPlaylists"
            >
                <option v-for="(option, i) in sortOptions" :key="i" :value="option.value" class="tw-text-[#00101D]">
                    {{ option.text }}
                </option>
            </select>
        </div>
        <div class="tw-w-full tw-pr-3 md:tw-pr-0 md:tw-max-w-[290px] tw-mr-auto tw-order-2 md:tw-order-1 form-group tw-mb-5 md:tw-mb-0">
            <select name="playlist-sort"
                    id="playlist-category"
                    class="tw-transition-colors tw-w-full tw-rounded-3xl tw-text-[#00101D] focus:tw-ring-0 dark:tw-text-[#9EC0DC] dark:tw-border-[#445F74] tw-bg-white dark:tw-bg-transparent"
                    v-model="state.categories"
                    @change="loadPlaylists"
            >
                <option class="tw-text-[#00101D]" value="" disabled>Filter by Category</option>
                <option v-for="(category, i) in categories" :key="i" :value="category.value" class="tw-text-[#00101D]">
                    {{ category.text }}
                </option>
            </select>
            <span
                v-if="state.categories"
                class="cancel-filter"
            >
                <i
                    class="fas fa-times tw-absolute tw-right-0 tw-top-0 tw-bottom-0 tw-w-[50px] tw-cursor-pointer tw-bg-white tw-flex tw-justify-center tw-items-center tw-border tw-border-[#D1D1D1] tw-rounded-[25px] tw-text-xl"
                    :class="'text-' + brand"
                    @click="cancelCategoryFilter"
                ></i>
            </span>
        </div>

        <!-- Search -->
        <div class="tw-relative tw-w-full md:tw-max-w-[465px] md:tw-mx-4 tw-mb-[20px] md:tw-mb-0 xl:tw-ml-[30px] xl:tw-mr-[26px] tw-order-1 md:tw-order-2">
            <MusoraIcon
                icon-name="search"
                class="tw-absolute tw-top-5 tw-left-[26px] dark:tw-text-[#9EC0DC] tw-z-0"
            />
            <input type="text"
                   class="tw-px-[50px] tw-w-full tw-h-[50px] focus:tw-ring-0 tw-text-[#00101D] dark:tw-text-white dark:focus:tw-bg-[#00101D] dark:placeholder:tw-text-[#9EC0DC] dark:tw-border-[#445F74] tw-bg-white dark:tw-bg-transparent tw-rounded-full focus:tw-ring-0 focus:tw-outline-none tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#D4D4D8]"
                   placeholder="Search"
                   ref="playlistSearch"
                   v-model="state.searchTerm"
                   @keyup.enter="loadPlaylists"
            >
            <button v-if="state.searchTerm.length" class="tw-absolute tw-top-4 tw-w-[18px] tw-right-[22px] dark:tw-text-white tw-z-0" @click="state.searchTerm = ''">
                <XIcon class="" />
            </button>

        </div>
        <!-- List/Grid Toggle -->
        <div class="tw-flex-shrink-0 tw-order-3">
            <button class="tw-h-[42px] tw-text-xs tw-uppercase tw-font-bebas-neue tw-px-0.5"
                    :class="[isListView ? 'dark:tw-text-white' : 'tw-text-[#8C8C90] dark:tw-text-[#7E9AB1]']"
                    @click="() => emit('onUpdateListView', true)"
            >
                <svg class="tw-w-[30px]" width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 6.5625C5.5 5.69956 6.19956 5 7.0625 5H9.14583C10.0088 5 10.7083 5.69956 10.7083 6.5625C10.7083 7.42544 10.0088 8.125 9.14583 8.125H7.0625C6.19956 8.125 5.5 7.42544 5.5 6.5625Z" fill="currentColor"/>
                    <path d="M12.7917 6.5625C12.7917 5.69956 13.4912 5 14.3542 5H28.9375C29.8004 5 30.5 5.69956 30.5 6.5625C30.5 7.42544 29.8004 8.125 28.9375 8.125H14.3542C13.4912 8.125 12.7917 7.42544 12.7917 6.5625Z" fill="currentColor"/>
                    <path d="M12.7917 28.4375C12.7917 27.5746 13.4912 26.875 14.3542 26.875H28.9375C29.8004 26.875 30.5 27.5746 30.5 28.4375C30.5 29.3004 29.8004 30 28.9375 30H14.3542C13.4912 30 12.7917 29.3004 12.7917 28.4375Z" fill="currentColor"/>
                    <path d="M12.7917 21.1458C12.7917 20.2829 13.4912 19.5833 14.3542 19.5833H28.9375C29.8004 19.5833 30.5 20.2829 30.5 21.1458C30.5 22.0088 29.8004 22.7083 28.9375 22.7083H14.3542C13.4912 22.7083 12.7917 22.0088 12.7917 21.1458Z" fill="currentColor"/>
                    <path d="M12.7917 13.8542C12.7917 12.9912 13.4912 12.2917 14.3542 12.2917H28.9375C29.8004 12.2917 30.5 12.9912 30.5 13.8542C30.5 14.7171 29.8004 15.4167 28.9375 15.4167H14.3542C13.4912 15.4167 12.7917 14.7171 12.7917 13.8542Z" fill="currentColor"/>
                    <path d="M5.5 28.4375C5.5 27.5746 6.19956 26.875 7.0625 26.875H9.14583C10.0088 26.875 10.7083 27.5746 10.7083 28.4375C10.7083 29.3004 10.0088 30 9.14583 30H7.0625C6.19956 30 5.5 29.3004 5.5 28.4375Z" fill="currentColor"/>
                    <path d="M5.5 21.1458C5.5 20.2829 6.19956 19.5833 7.0625 19.5833H9.14583C10.0088 19.5833 10.7083 20.2829 10.7083 21.1458C10.7083 22.0088 10.0088 22.7083 9.14583 22.7083H7.0625C6.19956 22.7083 5.5 22.0088 5.5 21.1458Z" fill="currentColor"/>
                    <path d="M5.5 13.8542C5.5 12.9912 6.19956 12.2917 7.0625 12.2917H9.14583C10.0088 12.2917 10.7083 12.9912 10.7083 13.8542C10.7083 14.7171 10.0088 15.4167 9.14583 15.4167H7.0625C6.19956 15.4167 5.5 14.7171 5.5 13.8542Z" fill="currentColor"/>
                </svg>
                <span>List</span>
            </button>
            <button class="tw-h-[42px] tw-text-xs tw-uppercase tw-font-bebas-neue tw-px-0.5"
                    :class="[isListView ? 'tw-text-[#8C8C90] dark:tw-text-[#7E9AB1]' : 'dark:tw-text-white']"
                    @click="() => emit('onUpdateListView', false)"
            >
                <svg class="tw-w-[30px]" width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.25 5.25C7.317 5.25 5.75 6.817 5.75 8.75V12.25C5.75 14.183 7.317 15.75 9.25 15.75H12.75C14.683 15.75 16.25 14.183 16.25 12.25V8.75C16.25 6.817 14.683 5.25 12.75 5.25H9.25Z" fill="currentColor"/>
                    <path d="M9.25 19.25C7.317 19.25 5.75 20.817 5.75 22.75V26.25C5.75 28.183 7.317 29.75 9.25 29.75H12.75C14.683 29.75 16.25 28.183 16.25 26.25V22.75C16.25 20.817 14.683 19.25 12.75 19.25H9.25Z" fill="currentColor"/>
                    <path d="M19.75 8.75C19.75 6.817 21.317 5.25 23.25 5.25H26.75C28.683 5.25 30.25 6.817 30.25 8.75V12.25C30.25 14.183 28.683 15.75 26.75 15.75H23.25C21.317 15.75 19.75 14.183 19.75 12.25V8.75Z" fill="currentColor"/>
                    <path d="M19.75 22.75C19.75 20.817 21.317 19.25 23.25 19.25H26.75C28.683 19.25 30.25 20.817 30.25 22.75V26.25C30.25 28.183 28.683 29.75 26.75 29.75H23.25C21.317 29.75 19.75 28.183 19.75 26.25V22.75Z" fill="currentColor"/>
                </svg>
                <span>Grid</span>
            </button>
        </div>
    </nav>
</template>
