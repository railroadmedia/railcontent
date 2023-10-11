<template>
    <div>
        <filter-controls
            :title="title"
            :search-term="state.searchTerm"
            :is-collapsed="isCollapsed"
            :selected-sort="collectionStore.filter.sort"
            :sort-option-data="sortOptions"
            :tab-options="tabOptions"
            :active-tab="collectionStore.filter.activeTab"
            :hide-filter-icon="state.multiSelectColumns.length === 0"
            @on-toggle-collapse="handleToggleCollapse"
            @on-search-submit="handleSearch"
            @on-sort="handleSort"
        >
            <slot name="viewToggleButton"></slot>
        </filter-controls>
        <filter-options
            v-if="!isCollapsed && isMobile"
            :multi-select-columns="state.multiSelectColumns"
            :single-select-columns="singleSelectColumns"
            :selected-filters="state.selectedFilters"
            @on-filter-click-handle="(selection) => handleFilterChange(selection)"
        />
        <filter-options-modal
            v-if="!isCollapsed && !isMobile"
            :is-collapsed-mobile="isCollapsed"
            :selected-filters="state.selectedFilters"
            :multi-select-columns="state.multiSelectColumns"
            :single-select-columns="singleSelectColumns"
            @onClose="handleToggleCollapse"
            @handle-filter-click="(selection) => handleFilterChange(selection)"
        />
    </div>
</template>

<script setup>
    import {onMounted, reactive, ref} from 'vue';
    import { useCollectionStore } from "../../../stores/collection";
    import ContentHelpers from '../../vuesora/assets/js/helper-functions/content.js';
    import FilterOptions from './FilterOptions.vue';
    import FilterOptionsModal from './FilterOptionsModal.vue';
    import FilterControls from './FilterControls.vue';

    const props = defineProps({
        brand:{
            type: String,
            default: () => "drumeo",
        },
        contentEndpoint: {
            type: String,
            default: () => "/railcontent/content",
        },
        contentType: {
            type: String,
            default: () => '',
        },
        filterableValues: {
            type: Array,
            default: () => [],
        },
        includedFields: {
            type: Array,
            default: () => [],
        },
        includedTypes: {
            type: Array,
            default: () => [],
        },
        includeFutureScheduledContentOnly: {
            type: Boolean,
            default: () => false,
        },
        infiniteScroll: {
            type: Boolean,
            default: () => false,
        },
        limit: {
            type: String,
            default: () => "10",
        },
        preLoadedContent: {
            type: Object,
            default: () => ({}),
        },
        selectedSort: {
            type: String,
            default: '',
        },
        singleSelectColumns: {
            type: Array,
            default: [
                {
                    category: 'Progress',
                    items: [
                        {
                            key: 'All',
                            value: 'all',
                        },
                        {
                            key: 'In Progress',
                            value: 'in_progress',
                        },
                        {
                            key: 'Complete',
                            value: 'complete',
                        },
                    ],
                },
            ],
        },
        sortOptions: {
            type: Array,
            default: [],
        },
        statuses: {
            type: Array,
            default: () => ["published"],
        },
        tabOptions: {
            type: Array,
            default: [],
        },
        title: {
            type: String,
            default: '',
        },
        totalResults: {
            type: [String, Number],
            default: () => 0,
        },
        requiredFields: {
            type: Array,
            default: () => [],
        },
        requiredUserStates: {
            type: Array,
            default: () => [],
        },
    });

    const collectionStore = useCollectionStore();

    const isMobile = ref(true);
    const isCollapsed = ref(true);
    const state = reactive({
        filters: props.preLoadedContent ? ContentHelpers.flattenFilters( props.preLoadedContent?.meta?.filterOptions || [] ) : {},
        multiSelectColumns: [],
    })

    const handleToggleCollapse = () => {
        isCollapsed.value = !isCollapsed.value;
    };

    const getScreenSize = () => {
        if (window.innerWidth > 767){
            isMobile.value = true;
        }
        else {
            isMobile.value = false;
        }
    }

    const handleSearch = (value) => {
        collectionStore.setSearchTerm(value);
        collectionStore.getData();
    }

    const handleFilterChange = (selection) => {
        state.selectedFilters = selection;
        state.page = 1;
    }

    const getFilterColumns = () => {
        let filters = [];
        for (const value of props.filterableValues){
            filters.push({
                category: value,
                items: state.filters[value]
            });
        }
        state.multiSelectColumns = filters;
    }

    const request_params = () => {
        return {
            required_fields: props.requiredFields,
            statuses: props.statuses,
            required_user_states: props.requiredUserStates,
            [props.contentType === 'coach' ? 'term' : 'title']: state.searchTerm,
            included_types: props.includedTypes,
            include_future_scheduled_content_only: props.includeFutureScheduledContentOnly,
            included_fields: props.included_fields || [],
            limit: props.limit,
        };
    }

    const handleSort = (item) => {
        collectionStore.sortData(item);
    }

    onMounted(()=>{
        getScreenSize();
        window.addEventListener('resize', getScreenSize);

        getFilterColumns();

        collectionStore.setDefaults({
            brand: props.brand,
            data: props.preLoadedContent?.data || [],
            filter: {
                activeTab: props.tabOptions ? props.tabOptions[0].value : '',
                params: {...request_params()},
                term: '',
            },
            totalPages: props.preLoadedContent ? Math.ceil(props.preLoadedContent.meta.totalResults / props.limit) : 0,
        })
    })

</script>
