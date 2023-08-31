<template>
    <div class="tw-flex tw-w-full tw-pt-8 tw-justify-between">
        <filter-tabs :selected-tab="selectedTab" :tab-options="tabOptions" @onTabClick="handleTabClick" />
        <div class="tw-flex tw-grow tw-justify-end">
            <filter-search @on-submit="handleSubmit" @on-text-change="handleSearchChange"></filter-search>
            <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')" class="tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-white dark:tw-border-white tw-rounded-full tw-flex tw-items-center tw-justify-center">
                <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-black" />
            </button>
            <button v-if="isCollapsed" @click="() => emit('onToggleCollapse')"  class="tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-black dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full tw-flex tw-items-center tw-justify-center">
                <AdjustmentsIcon class="tw-w-[18px] tw-h-[18px] tw-text-white" />
            </button>
            <button @click="showSortDropdown"  class="tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-white dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full tw-flex tw-items-center tw-justify-center">
                <SortDescendingIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
            </button>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import FilterTabs from './FilterTabs.vue';
    import FilterSearch from './FilterSearch.vue';
    import { SortDescendingIcon, AdjustmentsIcon, XIcon } from '@heroicons/vue/outline';


    const props = defineProps({
        isCollapsed: {
            type: Boolean,
            default: true,
        },
    });

    const emit = defineEmits(['onToggleCollapse']);

    const tabOptions = [{ key: 'songs', name: 'Songs' }, { key: 'artist', name: 'Artist' }, { key: 'genre', name: 'Genre' }];

    // the following refs will be replaced by pinia state
    const selectedTab = ref(tabOptions[0].key);
    const inputText = ref('');
    
    const handleTabClick = (key) => {
        selectedTab.value = key;
    };

    const handleSearchChange = (text) => {
        inputText.value = text;
    };

    const handleSubmit = () => {
        console.log('submit');
    };
</script>

<style scoped>
</style>
