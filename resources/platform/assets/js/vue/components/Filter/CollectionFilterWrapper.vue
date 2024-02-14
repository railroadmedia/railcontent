<template>
    <FilterControls :showBackButton="showBackButton" :parentUrl="parentUrl" :search-term="searchTerm" :hide-search="hideSearch" :search-placeholder="searchPlaceholder" :is-collapsed="isCollapsed" :selected-sort="selectedSort" :tab-options="tabOptions" :active-tab="activeTab" :hide-filter-icon="!hasFilterOptions" :hide-sort-icon="hideSortIcon" :selected-filters="selectedFilters" :sort-options="sortOptions"
        @on-toggle-collapse="handleToggleCollapse" @on-search-submit="value => emit('onSearchChange', value)"
        @on-sort="item => emit('onSortChange', item)" @on-filter-tab-click="tab => emit('onTabChange', tab)">
        <slot name="viewToggleButton"></slot>
    </FilterControls>
    <FilterPills :multi-select-columns="multiSelectColumns" :selected-filters="selectedFilters" @cancel-filter="param => emit('onFilterChange', param)" @clear-filter="emit('OnClearFilter')" />
    <div class="tw-px-4 lg:tw-px-0" v-if="hasFilterOptions" :class="`tw-relative ${!isCollapsed ? 'tw-mb-5' : ''}`">
        <FilterOptions v-if="!isCollapsed && !isTablet" :multi-select-columns="multiSelectColumns"
            :single-select-columns="singleSelectColumns" :selected-filters="selectedFilters"
            :selected-progress="selectedProgress" @on-filter-click-handle="param => emit('onFilterChange', param)"
            @on-progress-click="progress => emit('onProgressChange', progress)" />
        <FilterOptionsModal v-if="!isCollapsed && isTablet" :is-collapsed-mobile="isCollapsed"
            :selected-filters="selectedFilters" :selected-progress="selectedProgress"
            :multi-select-columns="multiSelectColumns" :single-select-columns="singleSelectColumns"
            @onClose="handleToggleCollapse" @handle-filter-click="param => emit('onFilterChange', param)"
            @on-progress-click="progress => emit('onProgressChange', progress)" />

        <div v-if="loading" class="tw-absolute tw-inset-0 dark:tw-bg-[#000C17]/30 tw-bg-[#F9F9F9]/30 tw-z-50"></div>
    </div>

</template>

<script setup>
import {computed, onMounted, onUnmounted, ref} from 'vue';
import FilterOptions from './FilterOptions.vue';
import FilterOptionsModal from './FilterOptionsModal.vue';
import FilterControls from './FilterControls.vue';
import FilterPills from './FilterPills.vue';

const props = defineProps({
    showBackButton: {
        type: Boolean,
        default: () => false,
    },
    parentUrl: {
        type: String,
        default: () => "/",
    },
    activeTab: {
        type: String,
        default: '',
    },
    hideSortIcon: {
        type: Boolean,
        default: false,
    },
    hideSearch: {
        type: Boolean,
        default: false,
    },
    loading: {
        type: Boolean,
        default: false,
    },
    multiSelectColumns: {
        type: Array,
        default: () => [],
    },
    preLoadedContent: {
        type: Object,
        default: () => ({}),
    },
    selectedFilters: {
        type: Object,
        default: () => ({}),
    },
    selectedProgress: {
        type: String,
        default: '',
    },
    selectedSort: {
        type: String,
        default: '',
    },
    searchTerm: {
        type: String,
        default: '',
    },
    searchPlaceholder: {
        type: String,
        default: 'Search',
    },
    singleSelectColumns: {
        type: Array,
        default: [
            {
                category: 'Progress',
                items: [
                    {
                        key: 'All',
                        value: '',
                    },
                    {
                        key: 'In Progress',
                        value: 'started',
                    },
                    {
                        key: 'Complete',
                        value: 'completed',
                    },
                ],
            },
        ],
    },
    sortOptions: {
        type: Array,
        default: [],
    },
    tabOptions: {
        type: Array,
        default: [],
    },
});

const emit = defineEmits(['onFilterChange', 'onSearchChange', 'onSortChange', 'onTabChange', 'onProgressChange', 'OnClearFilter']);

const isTablet = ref(false);
const isCollapsed = ref(true);

const hasFilterOptions = computed(() => {
    return props.multiSelectColumns.length > 0;
})

const handleToggleCollapse = () => {
    isCollapsed.value = !isCollapsed.value;
};

const getScreenSize = () => {
    if (window.innerWidth > 1023) {
        isTablet.value = false;
    }
    else {
        isTablet.value = true;
    }
}

onMounted(() => {
    getScreenSize();
    window.addEventListener('resize', getScreenSize);
})

onUnmounted(() => {
    window.addEventListener('resize', getScreenSize);
})
</script>
