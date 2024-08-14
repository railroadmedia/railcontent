<template>
    <div class="tw-flex tw-flex-col lg:tw-flex-row tw-w-full tw-justify-between" :class="{ 'tw-mb-5': !hasPills}">
        <div class="tw-flex tw-grow tw-relative tw-items-center tw-mb-3 xl:tw-mb-0">
            <!-- Filter Tabs -->
            <FilterTabs v-if="tabOptions.length > 0" :active-tab="activeTab" :tab-options="tabOptions" @onTabClick="handleTabClick" />
        </div>
        <div v-if="!hideControls" class="tw-flex tw-grow tw-items-start">
            <div class="tw-flex tw-grow tw-justify-end tw-items-center tw-relative">
                <FilterSearch v-if="!hideSearch" :placeholder="searchPlaceholder" :search-term="searchTerm" :active-tab="activeTab" :tab-options="tabOptions" @on-submit="handleSubmit" />
                <slot name="extra-icon-left"></slot>
                <template v-if="!hideFilterIcon">
                    <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')"
                            class="tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-border tw-border-black tw-bg-[#000C17] dark:tw-bg-white dark:tw-border-white tw-rounded-full">
                        <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-white dark:tw-text-[#000C17]" />
                    </button>
                    <button v-else @click="() => emit('onToggleCollapse')"
                            class="tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-border tw-border-[#CBCBCD] hover:tw-border-[#000C17] dark:tw-border-white tw-rounded-full hover:tw-bg-[#000C17] hover:dark:tw-bg-white tw-text-[#000C17] dark:tw-text-white hover:tw-text-white hover:dark:tw-text-[#000C17] tw-bg-white dark:tw-bg-transparent">
                        <AdjustmentsIcon class="tw-w-[22px] tw-h-[22px] tw-rotate-90" />
                    </button>
                </template>
                <template v-if="!hideSortIcon">
                    <button @click="handleOpenDropdown"
                        class="tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-border tw-border-[#CBCBCD] tw-bg-white dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full hover:tw-border-[#000C17] dark:tw-border-white tw-rounded-full hover:tw-bg-[#000C17] hover:dark:tw-bg-white tw-text-[#000C17] dark:tw-text-white hover:tw-text-white hover:dark:tw-text-[#000C17]">
                        <musora-icon :icon-name="sortIcon()" class="tw-w-[22px] tw-h-[22px]" />
                    </button>
                    <FilterSortDropdown v-if="showDropdown" :sortOptions="sortOptions" :selected-sort="selectedSort" @onClose="handleCloseDropdown"
                        @onSort="value => $emit('onSort', value)" />
                </template>
                <slot name="extra-icon-right"></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from 'vue';
import { AdjustmentsIcon, XIcon } from '@heroicons/vue/outline';
import FilterTabs from './FilterTabs.vue';
import FilterSearch from './FilterSearch.vue';
import FilterSortDropdown from './FilterSortDropdown.vue';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";

const props = defineProps({
    parentUrl: {
        type: String,
        default: () => "/",
    },
    activeTab: {
        type: String,
        default: '',
    },
    hideControls: {
        type: Boolean,
        default: false,
    },
    searchTerm: {
        type: String,
        default: '',
    },
    searchPlaceholder: {
        type: String,
        default: '',
    },
    selectedSort: {
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
    sortOptions: {
        type: Array,
        default: [],
    },
    hideSearch: {
        type: Boolean,
        default: false,
    },
    hideSortIcon: {
        type: Boolean,
        default: false,
    },
    hideFilterIcon: {
        type: Boolean,
        default: false,
    },
    selectedFilters: {
        type: Object,
        default: () => ([]),
    },
});

const emit = defineEmits(['onToggleCollapse', 'onFilterTabClick', 'onSearchSubmit']);
const showDropdown = ref(false);

// the following refs will be replaced by pinia state
const selectedSort = ref('');

const handleTabClick = (value) => {
    emit('onFilterTabClick', value)
};

const handleSubmit = (value) => {
    emit('onSearchSubmit', value);
};

const handleCloseDropdown = () => {
    showDropdown.value = false;
};

const handleOpenDropdown = () => {
    showDropdown.value = true;
};

const sortIcon = () => {
    return props.sortOptions.length > 0 && props.sortOptions.find(option => option.value === props.selectedSort)?.icon || '';
}

const hasPills = computed(() => {
    return props.selectedFilters && Object.keys(props.selectedFilters).length > 0;
})
</script>

<style scoped></style>
