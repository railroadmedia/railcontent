<script setup>
import {onBeforeMount, watch, ref, inject, reactive, computed} from 'vue';
import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
import { XIcon } from "@heroicons/vue/solid";
import { usePlaylistsStore } from '../../../../stores/playlists';
import FilterSortDropdown from '../../Filter/FilterSortDropdown';

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
    showSortDropdown: false,
})

//---------Template Refs---------//
const playlistSearch = ref(null)

//---------Static Data---------//
const sortOptions =[
    { value: '-created_at', name: 'Newest First', icon: 'sort-down', },
    { value: 'name', name: 'Alphabetical', icon: 'sort-name-asc', },
    { value: '-last_progress', name: 'Most Recent', icon: '', },
    { value: 'pinned', name: 'Pinned', icon: 'tack', },
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

const listViewIcon = computed(() => {
    return props.isListView ? "list-view" : "grid-view";
})

const sortIcon = computed(() => {
    return sortOptions.find(option => option.value === state.sortValue).icon;
})

//----------Methods----------//
const loadPlaylists = () => {
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

const handleSort = (value) => {
    state.sortValue = value;
    state.showSortDropdown = false;
    loadPlaylists();
}

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
        <!-- Search -->
        <div class="tw-relative tw-w-full md:tw-max-w-[465px] tw-mb-[20px] md:tw-mb-0 tw-mr-auto tw-order-3 md:tw-order-none">
            <MusoraIcon
                v-if="!state.searchTerm"
                icon-name="search"
                class="tw-absolute tw-top-5 tw-right-0 dark:tw-text-white tw-z-0"
            />
            <input type="text"
                   class="tw-px-4 tw-w-full tw-h-[50px] focus:tw-ring-0 tw-text-[#000C17] dark:tw-text-white dark:focus:tw-bg-[#00101D] tw-bg-white dark:tw-bg-black tw-rounded-full dark:placeholder:tw-text-white focus:tw-ring-0 focus:tw-outline-none tw-border tw-border-[#D4D4D8] dark:tw-border-[#445F74]"
                   placeholder="Search"
                   ref="playlistSearch"
                   v-model="state.searchTerm"
                   @keyup.enter="loadPlaylists"
            >
            <button v-if="state.searchTerm.length" class="tw-absolute tw-top-4 tw-w-[18px] tw-right-[22px] dark:tw-text-white tw-z-0" @click="state.searchTerm = ''">
                <XIcon class="" />
            </button>
        </div>
        <!-- Category -->
        <div class="tw-w-full md:tw-max-w-[290px] tw-order-2 md:tw-order-1 form-group tw-mb-5 md:tw-mb-0 md:tw-ml-7">
            <select name="playlist-sort"
                    id="playlist-category"
                    class="tw-transition-colors tw-w-full tw-rounded-3xl tw-text-[#00101D] focus:tw-ring-0 dark:tw-text-[#9EC0DC] dark:tw-border-[#445F74] tw-bg-white dark:tw-bg-transparent tw-text-center sm:tw-text-left"
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

        <div class="tw-flex tw-justify-end tw-flex-shrink-0 tw-order-1 md:tw-order-3 tw-mb-5 md:tw-mb-0 tw-w-full md:tw-w-auto">
            <!-- Sort -->
            <div class="tw-relative">
                <button
                    class="tw-flex tw-items-center tw-justify-center tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border tw-border-[#CBCBCD] tw-bg-white dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full hover:tw-border-[#000C17] dark:tw-border-white tw-rounded-full tw-text-xs hover:tw-bg-[#000C17] hover:dark:tw-bg-white tw-text-[#000C17] dark:tw-text-white hover:tw-text-white hover:dark:tw-text-[#000C17]  tw-mr-[10px] md:tw-mx-[10px]"
                    @click="() => state.showSortDropdown = !state.showSortDropdown"
                >
                    <musora-icon :icon-name="sortIcon" class="tw-w-[25px] tw-h-[25px]" />
                </button>
                <FilterSortDropdown
                    v-if="state.showSortDropdown"
                    :sortOptions="sortOptions"
                    @onSort="handleSort"
                    @onClose="state.showSortDropdown = false"
                />
            </div>

            <!-- List/Grid Toggle -->
            <button
                class="tw-h-[50px] tw-w-[50px] tw-text-xs tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#CBCBCD] dark:tw-border-white tw-rounded-full tw-bg-white dark:tw-bg-transparent tw-flex tw-justify-center tw-items-center"
                @click="() => emit('onToggleListView')"
            >
                <musora-icon :icon-name="listViewIcon" class="tw-w-[25px] tw-h-[25px]"></musora-icon>
            </button>
        </div>
    </nav>
</template>
