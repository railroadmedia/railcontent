<template>
    <div>
        <filter-controls
            :is-collapsed="isCollapsed"
            :selected-sort="selectedSort"
            :sort-option-data="sortOptions"
            :tab-options="tabOptions" :selected-tab="selectedTab"
            @on-toggle-collapse="handleToggleCollapse"
            @on-search-change="(value) => $emit('handleSearchChange', value)"
            @on-search-submit="$emit('handleSearchSubmit')"
            @on-content-sort="(value) => $emit('handleContentSort', value)"
            @on-filter-tab-click="(value) => $emit('onClickFilterTab', value)"
        />
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
            default: [
                {
                    category: 'Skill level',
                    items: [
                        {
                            value: 'Level 1',
                            key: 'level_1',
                        },
                        {
                            value: 'Level 2',
                            key: 'level_2',
                        },
                        {
                            value: 'Level 3',
                            key: 'level_3',
                        },
                        {
                            value: 'Level 4',
                            key: 'level_4',
                        },
                        {
                            value: 'Level 5',
                            key: 'level_5',
                        },
                    ],
                },
                {
                    category: 'Genre',
                    items: [
                        {
                            value: 'item 1',
                            key: 'item_1',
                        },
                        {
                            value: 'item 2',
                            key: 'item_2',
                        },
                        {
                            value: 'item 3',
                            key: 'item_3',
                        },
                        {
                            value: 'item 4',
                            key: 'item_4',
                        },
                        {
                            value: 'item 5',
                            key: 'item_5',
                        },
                    ],
                },
            ],
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
