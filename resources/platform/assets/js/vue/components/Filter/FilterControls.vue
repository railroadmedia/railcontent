<template>
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-pt-8 tw-justify-between tw-px-[12px] lg:tw-px-0">
        <div class="tw-flex tw-grow tw-relative tw-mb-[18px]">
            <filter-tabs :selected-tab="selectedTab" :tab-options="tabOptions" @onTabClick="(value) => $emit('onFilterTabClick', value)" />
            <div class="tw-flex tw-grow tw-justify-end">
                <button @click="handleOpenDropdown"
                    class="tw-flex md:tw-hidden tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <SortDescendingIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')"
                    class="tw-flex md:tw-hidden tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <button v-else @click="() => emit('onToggleCollapse')"
                    class="tw-flex md:tw-hidden tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <AdjustmentsIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
            </div>
        </div>
        <div class="tw-flex tw-grow tw-justify-end tw-relative">
            <filter-search @on-submit="(value) => $emit('onTermSearch', value)" @on-text-change="handleSearchChange" :search-term="searchTerm" ></filter-search>
            <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')"
                class="tw-hidden md:tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-white dark:tw-border-white tw-rounded-full">
                <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-black" />
            </button>
            <button v-else @click="() => emit('onToggleCollapse')"
                class="tw-hidden md:tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-black dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full">
                <AdjustmentsIcon class="tw-w-[18px] tw-h-[18px] tw-text-white" />
            </button>
            <button @click="handleOpenDropdown"
                class="tw-hidden md:tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-white dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full">
                <SortDescendingIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
            </button>
            <FilterSortDropdown v-if="showDropdown" :sortOptions="sortOptions" @onClose="handleCloseDropdown"
                @onSort="handleSort" />
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { SortDescendingIcon, AdjustmentsIcon, XIcon } from '@heroicons/vue/outline';
    import FilterTabs from './FilterTabs.vue';
    import FilterSearch from './FilterSearch.vue';
    import FilterSortDropdown from './FilterSortDropdown.vue';

    const props = defineProps({
        searchTerm: {
            type: String,
            default: '',
        },
        selectedTab: {
            type: String,
            default: '',
        },
        isCollapsed: {
            type: Boolean,
            default: true,
        },
        tabOptions: {
          type: Array,
          default: [],
        },
    });

    const emit = defineEmits(['onToggleCollapse', 'onFilterTabClick', 'onTermSearch', 'onContentSort']);

    const sortOptions = [
        { key: '-popularity', name: 'Most Popular' },
        { key: '-published_on', name: 'Newest First' },
        { key: 'published_on', name: 'Oldest First' },
        { key: 'slug', name: 'Name: A to Z' },
        { key: '-slug', name: 'Name: Z to A' },
    ];

    const showDropdown = ref(false);

    // the following refs will be replaced by pinia state
    const inputText = ref('');
    const selectedSort = ref(sortOptions[0].key);

    const handleTabClick = (key) => {
        selectedTab.value = key;
    };

    const handleSearchChange = (text) => {
        inputText.value = text;
    };

    const handleSubmit = () => {
        console.log('submit');
    };

    const handleCloseDropdown = () => {
        showDropdown.value = false;
    };

    const handleOpenDropdown = () => {
        showDropdown.value = true;
    };

    const handleSort = (key) => {
        selectedSort.value = key;
        emit('onContentSort', { target: { value: key } } );
    };
</script>

<style scoped></style>
