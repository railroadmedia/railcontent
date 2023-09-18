<template>
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-justify-between tw-px-[12px] lg:tw-px-0">
        <div class="tw-flex tw-grow tw-relative tw-mb-[18px]">
            <filter-tabs :selected-tab="selectedTab" :tab-options="tabOptions" @onTabClick="handleTabClick" />
            <div class="tw-flex tw-grow tw-justify-end md:tw-hidden">
                <button @click="handleOpenDropdown"
                    class="tw-flex tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <musora-icon :icon-name="sortIcon()" class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')"
                    class="tw-flex tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <button v-else @click="() => emit('onToggleCollapse')"
                    class="tw-flex tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <AdjustmentsIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <slot></slot>
            </div>
        </div>
        <div class="tw-flex tw-grow tw-justify-end tw-relative">
            <filter-search @on-submit="handleSubmit" @on-text-change="handleSearchChange"></filter-search>
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
                <musora-icon :icon-name="sortIcon()" class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
            </button>
            <FilterSortDropdown v-if="showDropdown" :sortOptions="sortOptions" :selected-sort="selectedSort" @onClose="handleCloseDropdown"
                @onSort="handleSort" />
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
    import { AdjustmentsIcon, XIcon } from '@heroicons/vue/outline';
    import FilterTabs from './FilterTabs.vue';
    import FilterSearch from './FilterSearch.vue';
    import FilterSortDropdown from './FilterSortDropdown.vue';
    import MusoraIcon from "../MusoraIcons/MusoraIcon";

    const props = defineProps({
        selectedSort: {
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
        sortOptionData: {
            type: Array,
            default: [],
        },
    });

    const emit = defineEmits(['onToggleCollapse', 'onFilterTabClick', 'onSearchChange', 'onSearchSubmit', 'onContentSort']);

    const showDropdown = ref(false);
    const sortOptions = ref(props.sortOptionData);

    // the following refs will be replaced by pinia state
    const inputText = ref('');
    const selectedSort = ref('');

    const handleTabClick = (value) => {
        emit('onFilterTabClick', value)
    };

    const handleSearchChange = (text) => {
        inputText.value = text;
        emit('onSearchChange', text)
    };

    const handleSubmit = () => {
        emit('onSearchSubmit');
    };

    const handleCloseDropdown = () => {
        showDropdown.value = false;
    };

    const handleOpenDropdown = () => {
        showDropdown.value = true;
    };

    const handleSort = (key) => {
        selectedSort.value = key;
        emit('onContentSort', key);
    };

    const sortIcon = () => {
        return props.selectedSort ? props.sortOptions.find(option => option.key === props.selectedSort).icon : 'sort-down';
    };

    onMounted(()=>{
        if (props.sortOptionData.length === 0){
            sortOptions.value = [
                { key: '-published_on', name: 'Newest First', icon: 'sort-down', },
                { key: 'published_on', name: 'Oldest First', icon: 'sort-up', },
                { key: '-popularity', name: 'Most Popular', icon: 'sort-popularity', },
                { key: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
                { key: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
            ];
        }
        else {
            sortOptions.value = props.sortOptionData;
        }

        selectedSort.value = sortOptions.value[0].key;
    })
</script>

<style scoped></style>
