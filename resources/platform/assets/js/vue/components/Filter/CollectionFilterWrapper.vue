<template>
    <div>
        <FilterControls
            :hide-filter="hideFilter"
            :search-term="searchTerm"
            :is-collapsed="isCollapsed"
            :selected-sort="selectedSort"
            :tab-options="tabOptions"
            :active-tab="activeTab"
            :hide-filter-icon="state.multiSelectColumns.length === 0"
            @on-toggle-collapse="handleToggleCollapse"
            @on-search-submit="value => emit('onSearchChange', value)"
            @on-sort="item => emit('onSortChange', item)"
            @on-filter-tab-click="tab => emit('onTabChange', tab)"
        >
            <slot name="viewToggleButton"></slot>
        </FilterControls>
        <div>
            <FilterPills :multi-select-columns="state.multiSelectColumns" :selected-filters="selectedFilters" @cancel-filter="param => emit('onFilterChange', param)" @clear-filter="emit('OnClearFilter')" />
        </div>
        <div v-if="!hideFilter" :class="`tw-relative ${!isCollapsed ? 'tw-mb-20' : ''}`">
            <FilterOptions
                v-if="!isCollapsed && isMobile"
                :multi-select-columns="state.multiSelectColumns"
                :single-select-columns="singleSelectColumns"
                :selected-filters="selectedFilters"
                @on-filter-click-handle="param => emit('onFilterChange', param)"
            />
            <FilterOptionsModal
                v-if="!isCollapsed && !isMobile"
                :is-collapsed-mobile="isCollapsed"
                :selected-filters="selectedFilters"
                :multi-select-columns="state.multiSelectColumns"
                :single-select-columns="singleSelectColumns"
                @onClose="handleToggleCollapse"
                @handle-filter-click="param => emit('onFilterChange', param)"
            />

            <div v-if="loading" class="tw-absolute tw-inset-0 dark:tw-bg-[#000C17]/30 tw-bg-[#F9F9F9]/30 tw-z-50"></div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, onUnmounted, reactive, ref } from 'vue';
    import ContentHelpers from '../../vuesora/assets/js/helper-functions/content.js';
    import FilterOptions from './FilterOptions.vue';
    import FilterOptionsModal from './FilterOptionsModal.vue';
    import FilterControls from './FilterControls.vue';
    import FilterPills from './FilterPills.vue';

    const props = defineProps({
        activeTab: {
            type: String,
            default: '',
        },
        filterableValues: {
            type: Array,
            default: () => [],
        },
        hideFilter: {
            type: Boolean,
            default: false,
        },
        loading: {
            type: Boolean,
            default: false,
        },
        preLoadedContent: {
            type: Object,
            default: () => ({}),
        },
        selectedFilters: {
            type: Object,
            default: () => ({}),
        },
        selectedSort: {
            type: String,
            default: '',
        },
        searchTerm: {
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
        tabOptions: {
            type: Array,
            default: [],
        },
    });

    const emit = defineEmits(['onFilterChange', 'onSearchChange', 'onSortChange', 'onTabChange'])

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

    onMounted(()=>{
        getScreenSize();
        window.addEventListener('resize', getScreenSize);

        getFilterColumns();
    })

    onUnmounted(()=>{
        window.addEventListener('resize', getScreenSize);
    })
</script>
