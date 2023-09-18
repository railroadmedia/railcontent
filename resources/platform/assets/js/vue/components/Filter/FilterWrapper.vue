<template>
    <div>
        <filter-controls
            :search-term="searchTerm"
            :is-collapsed="isCollapsed"
            :selected-sort="selectedSort"
            :sort-option-data="sortOptions"
            :tab-options="tabOptions" :selected-tab="selectedTab"
            :hide-filter-icon="multiSelectColumns.length === 0"
            @on-toggle-collapse="handleToggleCollapse"
            @on-search-change="(value) => $emit('handleSearchChange', value)"
            @on-search-submit="$emit('handleSearchSubmit')"
            @on-content-sort="(value) => $emit('handleContentSort', value)"
            @on-filter-tab-click="(value) => $emit('onClickFilterTab', value)"
        >
            <slot name="viewToggleButton"></slot>
        </filter-controls>
        <filter-options
            v-if="!isCollapsed && isMobile"
            :multi-select-columns="multiSelectColumns"
            :single-select-columns="singleSelectColumns"
            :selected-filters="selectedFilters"
            @on-filter-click-handle="(selection) => $emit('on-filter-click', selection)"
        />
        <filter-options-modal
            v-if="!isCollapsed && !isMobile"
            :is-collapsed-mobile="isCollapsed"
            :selected-filters="selectedFilters"
            :multi-select-columns="multiSelectColumns"
            :single-select-columns="singleSelectColumns"
            @onClose="handleToggleCollapse"
            @handle-filter-click="(selection) => $emit('on-filter-click', selection)"
        />
    </div>
</template>

<script setup>
    import {onMounted, onUnmounted, ref} from 'vue';
    import FilterOptions from './FilterOptions.vue';
    import FilterOptionsModal from './FilterOptionsModal.vue';
    import FilterControls from './FilterControls.vue';

    const props = defineProps({
        tabOptions: {
            type: Array,
            default: [],
        },
        multiSelectColumns: {
            type: Array,
            default: [],
        },
        searchTerm:{
            type: String,
            default: '',
        },
        selectedFilters: {
            type: Object,
            default: {},
        },
        selectedSort: {
            type: String,
            default: '',
        },
        selectedTab: {
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
    });

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
</script>

<style scoped>

</style>
