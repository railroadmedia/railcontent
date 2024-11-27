<script setup>
import { onBeforeMount, watch, ref, inject, reactive, computed } from 'vue';
import { storeToRefs } from "pinia";
import { ViewListIcon, ViewGridIcon } from '@heroicons/vue/solid';
import { usePlaylistsStore } from '@stores/playlists';
import CollectionFilterWrapper from '@collections/Filter/CollectionFilterWrapper.vue';
import { filter } from 'lodash';

//Inject
const token = inject('csrf_token');

//Pinia Stores
const playlistsStore = usePlaylistsStore();
const { filterOptions } = storeToRefs(playlistsStore);

//Emits
const emit = defineEmits(['onToggleListView']);

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    isListView: {
        type: Boolean,
        default: false,
    },
    initialFilterOptions: {
        type: [Object, Array],
        default: null
    }
});

//---------Reactive Data---------//
const state = reactive({
    searchTerm: '',
    sortValue: '-created_at', //Default
    showSortDropdown: false,
    selectedCategories: [],
});

function transformToMultiSelect(values) {
    if (!values || !values.categories || !Array.isArray(values.categories)) {
        console.error("Invalid filter options provided.");
        return {};
    }

    return [
        {
            category: "categories",
            items: values.categories.map(category => {
                // Extract the key (text) and value (number) from the string (e.g., "General (6)")
                const match = category.match(/^(.*) \((\d+)\)$/);
                const key = match ? match[1] : category; // Extracted text or fallback to full string
                const value = match ? parseInt(match[2], 10) : 0; // Extracted number or fallback to 0
                return { key, value };
            })
        }
    ];
}

//---------Computed Data---------//
const filterValues = computed(() => {
    return transformToMultiSelect(filterOptions.value);
});

//---------Static Data---------//
const sortOptions = [
    { value: '-created_at', name: 'Newest First', icon: 'sort-down', },
    { value: 'name', name: 'Alphabetical', icon: 'sort-name-asc', },
    { value: '-last_progress', name: 'Most Recent', icon: 'most-recent', },
    { value: 'pinned', name: 'Pinned', icon: 'tack', },
];

//----------Methods----------//
const formatSelectedCategories = (filters) => {
    return filters.map(f => f.split(',')[1]);
};

const loadPlaylists = () => {
    const payload = {
        brand: brand,
        page: 1,
        limit: 10,
        searchTerm: state.searchTerm,
        sort: state.sortValue,
        count_filter_items: 1,
        categories: formatSelectedCategories(state.selectedCategories),
    }
    //load Playlists
    playlistsStore.getPlaylists(payload, token);
    //Update URL w/ new params
    const url = new URL(window.location.href);
    url.searchParams.set('sortby_val', state.sortValue);
    url.searchParams.set('search', state.searchTerm);
    url.searchParams.set('page', 1);
    url.searchParams.set('count_filter_items', 1);
    if (state.selectedCategories.length) {
        url.searchParams.set('categories[]', formatSelectedCategories(state.selectedCategories));
    } else {
        url.searchParams.delete('categories[]');
    }

    playlistsStore.resultsPage = 1;
    window.history.pushState({}, '', url);
};

const handleSort = (value) => {
    state.sortValue = value;
    state.showSortDropdown = false;
    loadPlaylists();
}

const handleSearch = (value) => {
    state.searchTerm = value;
    loadPlaylists();
};

const handleFilterChange = (value) => {
    const itemIndex = state.selectedCategories.findIndex(f => f === value);

    if (itemIndex === -1) state.selectedCategories.push(value);
    else state.selectedCategories.splice(itemIndex, 1);

    loadPlaylists();
}

const handleClearFilters = () => {
    state.selectedCategories = [];
    loadPlaylists();
}

const handleViewToggle = () => {
    emit('onToggleListView');
}

//---------Lifecycle Methods---------//
onBeforeMount(() => {
    playlistsStore.updateFilterOptions({ filterOptions: props.initialFilterOptions });

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
    <CollectionFilterWrapper active-tab="All Playlists" :multi-select-columns="filterValues"
        :search-term="state.searchTerm" :selected-filters="state.selectedCategories" :selected-sort="state.sortValue"
        :single-select-columns="[]" :sort-options="sortOptions"
        :tab-options="[{ value: 'All Playlists', key: 'All Playlists' }]" @on-filter-change="handleFilterChange"
        @on-sort-change="handleSort" @on-search-change="handleSearch" @on-clear-filter="handleClearFilters">
        <template #extra-icon-right>
            <!-- List/Grid Toggle -->
            <button
                class="tw-ml-[15px] tw-h-[35px] tw-w-[35x] tw-text-[#00101D] dark:tw-text-white tw-flex tw-justify-center tw-items-center tw-shrink-0"
                @click="handleViewToggle">
                <ViewListIcon v-if="isListView" class="tw-w-[35px] tw-h-[35px]" />
                <ViewGridIcon v-else class="tw-w-[35px] tw-h-[35px]" />
            </button>
        </template>
    </CollectionFilterWrapper>
</template>