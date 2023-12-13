<template>
    <div>
        <FilterControls
            :showBackButton="showBackButton"
            :parentUrl="parentUrl"
            :hide-filter="hideFilter"
            :search-term="searchTerm"
            :is-collapsed="isCollapsed"
            :selected-sort="selectedSort"
            :tab-options="tabOptions"
            :active-tab="activeTab"
            :hide-filter-icon="multiSelectColumns.length === 0"
            @on-toggle-collapse="handleToggleCollapse"
            @on-search-submit="value => emit('onSearchChange', value)"
            @on-sort="item => emit('onSortChange', item)"
            @on-filter-tab-click="tab => emit('onTabChange', tab)"
        >
            <slot name="viewToggleButton"></slot>
        </FilterControls>
        <div>
            <FilterPills :multi-select-columns="multiSelectColumns" :selected-filters="selectedFilters" @cancel-filter="param => emit('onFilterChange', param)" @clear-filter="emit('OnClearFilter')" />
        </div>
        <div v-if="!hideFilter" :class="`tw-relative ${!isCollapsed ? 'tw-mb-20' : ''}`">
            <FilterOptions
                v-if="!isCollapsed && isMobile"
                :multi-select-columns="multiSelectColumns"
                :single-select-columns="singleSelectColumns"
                :selected-filters="selectedFilters"
                :selected-progress="selectedProgress"
                @on-filter-click-handle="param => emit('onFilterChange', param)"
                @on-progress-click="progress => emit('onProgressChange', progress)"
            />
            <FilterOptionsModal
                v-if="!isCollapsed && !isMobile"
                :is-collapsed-mobile="isCollapsed"
                :selected-filters="selectedFilters"
                :selected-progress="selectedProgress"
                :multi-select-columns="multiSelectColumns"
                :single-select-columns="singleSelectColumns"
                @onClose="handleToggleCollapse"
                @handle-filter-click="param => emit('onFilterChange', param)"
                @on-progress-click="progress => emit('onProgressChange', progress)"
            />

            <div v-if="loading" class="tw-absolute tw-inset-0 dark:tw-bg-[#000C17]/30 tw-bg-[#F9F9F9]/30 tw-z-50"></div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';
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
        hideFilter: {
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
        tabOptions: {
            type: Array,
            default: [],
        },
    });

    const emit = defineEmits(['onFilterChange', 'onSearchChange', 'onSortChange', 'onTabChange', 'onProgressChange', 'OnClearFilter']);

    const isMobile = ref(true);
    const isCollapsed = ref(true);

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

    onMounted(()=>{
        getScreenSize();
        window.addEventListener('resize', getScreenSize);
    })

    onUnmounted(()=>{
        window.addEventListener('resize', getScreenSize);
    })
</script>
