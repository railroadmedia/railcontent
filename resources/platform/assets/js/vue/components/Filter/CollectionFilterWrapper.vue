<template>
    <div>
        <filter-controls
            :search-term="state.searchTerm"
            :is-collapsed="isCollapsed"
            :selected-sort="collectionStore.tabData[collectionStore.filter.activeTab] && collectionStore.tabData[collectionStore.filter.activeTab].sort"
            :tab-options="tabOptions"
            :active-tab="collectionStore.filter.activeTab"
            :hide-filter-icon="state.multiSelectColumns.length === 0"
            @on-toggle-collapse="handleToggleCollapse"
            @on-search-submit="handleSearch"
            @on-sort="handleSort"
            @on-filter-tab-click="(value) => tabClick(value)"
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
    import { onMounted, onUnmounted, reactive, ref } from 'vue';
    import { useCollectionStore } from "../../../stores/collection";
    import ContentHelpers from '../../vuesora/assets/js/helper-functions/content.js';
    import FilterOptions from './FilterOptions.vue';
    import FilterOptionsModal from './FilterOptionsModal.vue';
    import FilterControls from './FilterControls.vue';

    const props = defineProps({
        filterableValues: {
            type: Array,
            default: () => [],
        },
        preLoadedContent: {
            type: Object,
            default: () => ({}),
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
        tabOptions: {
            type: Array,
            default: [],
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

    const handleSort = (item) => {
        collectionStore.sortData(item);
    }

    const tabClick = (tab) => {
        collectionStore.switchTab(tab);
    }

    onMounted(()=>{
        getScreenSize();
        window.addEventListener('resize', getScreenSize);

        getFilterColumns();
    })

    onUnmounted(()=>{
        window.addEventListener('resize', getScreenSize);
    })
</script>
