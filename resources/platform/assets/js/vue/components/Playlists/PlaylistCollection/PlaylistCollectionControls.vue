<script setup>
    import { onBeforeMount, watch, ref, inject, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import FilterWrapper from '../../Filter/FilterWrapper.vue';

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
        selectedFilters: {},
    })

    //---------Static Data---------//
    const sortOptions =[
        { name: 'Newest First', key: '-created_at', icon: 'sort-down', },
        { name: 'Alphabetical', key: 'name', icon: 'sort-name-asc', },
        { name: 'Most Recent', key: '-last_progress',  },
        { name: 'Pinned', key: 'pinned', icon: 'tack' }
    ]

    const categories = [
        {
            category: 'Category',
            items: [
                {
                    value: 'Watch-Later',
                    key: 'Watch Later',
                },
                {
                    value: 'Favorites',
                    key: 'Favorites',
                },
                {
                    value: 'General',
                    key: 'General',
                },
                {
                    value: 'Practice',
                    key: 'Practice',
                },
                {
                    value: 'Learning',
                    key: 'Learning',
                },
                {
                    value: 'Entertainment',
                    key: 'Entertainment',
                },
                {
                    value: 'Warm-Up',
                    key: 'Warm Up',
                },
                {
                    value: 'Songs',
                    key: 'Songs',
                }
            ]
        },
    ];

    //----------Methods----------//
    const loadPlaylists = ()=> {
        const payload = {
            brand: brand,
            page: 1,
            limit: 10,
            term: state.searchTerm,
            sort: state.sortValue,
            categories: state.selectedFilters.Category || '',
        }
        //load Playlists
        playlistsStore.getPlaylists(payload, token);
        //Update URL w/ new params
        const url = new URL(window.location.origin + window.location.pathname);
        url.searchParams.set('sortby_val', state.sortValue);
        url.searchParams.set('search', state.searchTerm);
        url.searchParams.set('page', 1);
        if (state.selectedFilters.Category){
            state.selectedFilters.Category.forEach((category)=> {
                url.searchParams.append('categories[]', category);
            });
        }

        playlistsStore.resultsPage = 1;
        window.history.pushState({}, '', url);
    };

    const cancelCategoryFilter = ()=> {
        loadPlaylists();
    }

    const handleSortChange = (key) => {
        state.sortValue = key;
        loadPlaylists();
    }

    const handleFilterChange = (selection) => {
        state.selectedFilters = selection;
        loadPlaylists();
    }

    const handleSearchChange = (value) => {
        state.searchTerm = value;
    }

    const handleSearchSubmit = () => {
        loadPlaylists();
    }

    //---------Lifecycle Methods---------//
    onBeforeMount(()=> {
        //get url params
        const params = new URLSearchParams(window.location.search);

        //Set state props
        state.searchTerm = params.get('search') || '';
        state.selectedFilters.Category = params.getAll('categories[]');
        state.sortValue = params.get('sortby_val') || '-created_at';
    });
</script>
<template>
    <nav class="tw-flex tw-my-4 tw-w-full tw-flex-wrap md:tw-flex-nowrap">
        <div class="tw-w-full">
            <FilterWrapper
                title="All Playlists"
                :search-term="state.searchTerm"
                :sort-options="sortOptions"
                :multi-select-columns="categories"
                :selected-filters="state.selectedFilters"
                @on-filter-click="handleFilterChange"
                @handle-content-sort="handleSortChange"
                @handle-search-change="handleSearchChange"
                @handle-search-submit="handleSearchSubmit"
            >
                <template #viewToggleButton>
                    <button
                        class="tw-h-[40px] tw-text-xs tw-uppercase tw-font-bebas-neue tw-px-0.5 tw-text-[#000C17] dark:tw-text-white tw-ml-4"
                        @click="() => emit('onUpdateListView', !isListView)"
                        title="Toggle List/Grid View"
                    >
                        <musora-icon class="tw-w-[24px]" :icon-name="isListView ? 'list-view' : 'grid-view'" />
                    </button>
                </template>
            </FilterWrapper>
        </div>
        <!-- List/Grid Toggle -->
        <div class="tw-hidden md:tw-block lg:tw-ml-2">
            <button
                class="tw-h-[50px] tw-text-xs tw-uppercase tw-font-bebas-neue tw-px-0.5 tw-text-[#000C17] dark:tw-text-white"
                @click="() => emit('onUpdateListView', !isListView)"
                title="Toggle List/Grid View"
            >
                <musora-icon class="tw-w-[40px]" :icon-name="isListView ? 'list-view' : 'grid-view'" />
            </button>
        </div>
    </nav>
</template>
